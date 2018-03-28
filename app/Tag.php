<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Sluggable;

    protected $fillable = [
        'name', 'slug'
    ];

    public function blogs ()
    {
        return $this->belongsToMany('App\Blog');
    }

    public function scopeGetBySlug ($query, $slug)
    {
        return $query->select('id')->whereSlug($slug);
    }

    public function scopeLists ($query)
    {
        return $query->select('id', 'name', 'slug')->orderBy('name');
    }

    public function sluggable ()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
