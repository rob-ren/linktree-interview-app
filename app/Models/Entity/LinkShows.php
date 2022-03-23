<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Model;

class LinkShows extends Model
{
    const STATUS_SOLD_OUT = 'sold_out';
    const STATUS_ON_SALE  = 'on_sale';
    const STATUS_NORMAL   = 'normal';
    // TODO:
    // more status options

    const STATUS_OPTIONS = [
        self::STATUS_SOLD_OUT,
        self::STATUS_ON_SALE,
        self::STATUS_NORMAL,
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'link_shows';

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

    public function link()
    {
        return $this->belongsTo('App\Models\Entity\Link', 'link_id', 'id');
    }

    public function getIdAttribute()
    {
        return $this->attributes['id'];
    }

    public function setLinkIdAttribute($value)
    {
        $this->attributes['link_id'] = $value;
    }

    public function getLinkIdAttribute()
    {
        return $this->getAttributeFromArray('link_id');
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value;
    }

    public function getDateAttribute()
    {
        return $this->getAttributeFromArray('date');
    }

    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = $value;
    }

    public function getAddressAttribute()
    {
        return $this->getAttributeFromArray('address');
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value;
    }

    public function getStatusAttribute()
    {
        return $this->getAttributeFromArray('status');
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
