<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    const TYPE_CLASSIC = 'classic';
    const TYPE_MUSIC   = 'music';
    const TYPE_SHOW    = 'show';
    const TYPE_OPTIONS = [
        self::TYPE_CLASSIC,
        self::TYPE_MUSIC,
        self::TYPE_SHOW,
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'link';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes to be exported as part of the ExportDb service.
     *
     * @var array
     */
    protected $exportable_attributes = [];

    protected static function boot()
    {
    }

    /**
     * Get the associated LinkMusic
     */
    public function link_music()
    {
        return $this->hasMany('App\Models\Entity\LinkMusic', 'link_id');
    }

    /**
     * Get associated LinkShows
     */
    public function link_shows()
    {
        return $this->hasMany('App\Models\Entity\LinkShows', 'link_id');
    }

    public function getIdAttribute()
    {
        return $this->attributes['id'];
    }

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = $value;
    }

    public function getUserIdAttribute()
    {
        return $this->getAttributeFromArray('user_id');
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
    }

    public function getTitleAttribute()
    {
        return $this->getAttributeFromArray('title');
    }

    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = $value;
    }

    public function getTypeAttribute()
    {
        return $this->getAttributeFromArray('type');
    }

    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = $value;
    }

    public function getUrlAttribute()
    {
        return $this->getAttributeFromArray('url');
    }

    public function setCreatedTimeAttribute($value)
    {
        $this->attributes['created_time'] = $value;
    }

    public function getCreatedTimeAttribute()
    {
        return $this->getAttributeFromArray('created_time');
    }

    public function setUpdatedTimeAttribute($value)
    {
        $this->attributes['updated_time'] = $value;
    }

    public function getUpdatedTimeAttribute()
    {
        return $this->getAttributeFromArray('updated_time');
    }
}
