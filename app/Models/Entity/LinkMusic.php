<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Model;

class LinkMusic extends Model
{
    const CREATED_AT  = 'created_time';
    const UPDATED_AT  = 'updated_time';
    
    const PLATORM_SPOTIFY = 'spotify';
    const PLATORM_YOUTUBE = 'youtube';
    // TODO:
    // more platform options

    const PLATFORM_OPTIONS = [
        self::PLATORM_SPOTIFY,
        self::PLATORM_YOUTUBE
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'link_music';

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
        parent::boot();
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

    public function setPlatformAttribute($value)
    {
        $this->attributes['platform'] = $value;
    }

    public function getPlatformAttribute()
    {
        return $this->getAttributeFromArray('platform');
    }

    public function setPlatformUrlAttribute($value)
    {
        $this->attributes['platform_url'] = $value;
    }

    public function getPlatformUrlAttribute()
    {
        return $this->getAttributeFromArray('platform_url');
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
