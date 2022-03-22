<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class BaseService
{
    /**
     * The user entity accessing the services
     *
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Call the getData method on class inside the "Classes" folder of a service
     *
     * @param object $parentClass The dictionary class
     * @param object $subClass The class to be created
     * @param array $args The function arguments sent to the parent class
     * @return void
     */
    protected function getClassData($parentClass, $subClass, $args = [])
    {
        return $this->getClass($parentClass, $subClass, $args)->getData();
    }

    /**
     * Call the getPaginatedData method on class inside the "Classes" folder of a service
     *
     * @param object $parentClass The dictionary class
     * @param object $subClass The class to be created
     * @param array $args The function arguments sent to the parent class
     * @param Paginate $paginate The pagination object
     * @return void
     */
    protected function getPaginatedClassData($parentClass, $subClass, $args, Paginate $paginate)
    {
        return $this->getClass($parentClass, $subClass, $args)->getPaginatedData($paginate);
    }

    /**
     * Call the validate method on class inside the "Classes" folder of a service
     *
     * @param object $parentClass The dictionary class
     * @param object $subClass The class to be created
     * @param array $args The function arguments sent to the parent class
     * @return void
     */
    protected function validateClassData($parentClass, $subClass, $args = [])
    {
        return $this->getClass($parentClass, $subClass, $args)->validate();
    }

    /**
     * Call the save method on class inside the "Classes" folder of a service
     *
     * @param object $parentClass The dictionary class
     * @param object $subClass The class to be created
     * @param array $args The function arguments sent to the parent class
     * @return void
     */
    protected function saveClassData($parentClass, $subClass, $args = [])
    {
        return $this->getClass($parentClass, $subClass, $args)->save();
    }

    /**
     * Creates an instance of a class inside the "Classes" folder of a service
     *
     * @param object $parentClass The dictionary class
     * @param object $subClass The class to be created
     * @param array $args The function arguments sent to the parent class
     * @return void
     */
    private function getClass($parentClass, $subClass, $args = [])
    {
        $reflection = new \ReflectionClass($parentClass);
        $namespace = $reflection->getNamespaceName() . '\\' . 'Classes' . '\\' . $subClass;
        $params = [$this->user];
        if (count($args) > 0) {
            $params = array_merge($params, $args);
        }
        $class = new $namespace(...$params);
        return $class;
    }

    protected function enableQueryLog()
    {
        DB::enableQueryLog();
    }

    protected function getQueryLog()
    {
        $queries = DB::getQueryLog();
        return $queries;
    }

    /**
     * Saves on ORM entity
     *
     * @param Model $entity
     * @return bool|MessageBag True when successful or Validator::errors on failure
     */
    private function saveEntity($entity = null)
    {

        $response = null;

        if (is_object($entity)) {
            try {
                $response = $entity->save();
            } catch (\Exception $e) {
                $validator = Validator::make([], []);
                $validator->errors()->add('error', $e->getMessage());
                $response = $validator->errors();
            }
        }

        return $response;
    }

    /**
     * Create an ORM entity
     * Log all create actions
     *
     * @param Model $entity
     * @return bool|MessageBag True when successful or Validator::errors on failure
     */
    protected function createEntity($entity = null)
    {
        return $this->saveEntity($entity);
    }

    /**
     * Update an ORM entity
     * Log all update actions
     *
     * @param Model $entity
     * @return bool|MessageBag True when successful or Validator::errors on failure
     */
    protected function updateEntity($entity = null)
    {
        return $this->saveEntity($entity);
    }

    /**
     * Delete an ORM entity
     * Log all delete actions
     *
     * @param Model $entity
     * @return bool|MessageBag True when successful or Validator::errors on failure
     */
    protected function deleteEntity($entity = null)
    {
        // log delete action
        return $this->saveEntity($entity);
    }

    /**
     * Hard delete an ORM entity
     * This should not be used!!!!
     *
     * @param Model $entity
     * @return bool|Collection True when successful or MessageBag::errors on failure
     */
    protected function hardDeleteEntity($entity = null)
    {
        $errors = new MessageBag();

        // hard deletes can only be done by super users
        if (!$this->user->isSuperAdmin) {
            $errors->add('unauthorized_action', __('auth.unauthorized_action'));
            return $errors;
        }

        // variables to log information about the entity
        $table_name = '';
        $primary_key_value = '';
        $row_data = '';

        $response = null;

        if (is_object($entity)) {
            try {
                // gather data before the delete
                $table_name = $entity->getTable();
                $row_data = json_encode($entity->toArray());
                $primary_key_value = $entity->getKey();

                // hard delete the row
                $response = $entity->delete();
            } catch (\Exception $e) {
                $errors->add('error', $e->getMessage());
                return $errors;
            }
        }

        Log::info(sprintf("%s hard deleted from table %s with primary key %s. %s", $this->user->full_name, $table_name, $primary_key_value, $row_data));
        return $response;
    }
}
