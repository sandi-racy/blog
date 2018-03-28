<?php

namespace App;

use DB;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use Sluggable;

    protected $fillable = [
        'title', 'image', 'summary', 'content', 'slug', 'user_id'
    ];

    public function getCreatedAtAttribute ($value)
    {
        return Carbon::parse($value)->format('M d');
    }

    public function scopeGetArchive ($query)
    {
        return $query->select(DB::raw('MONTH(created_at) AS month'), DB::raw('YEAR(created_at) AS year'))->groupBy('month', 'year')->orderBy('created_at', 'desc');
    }

    public function scopeLists ($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function sluggable ()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function tags ()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function user ()
    {
        return $this->belongsTo('App\User');
    }
}
