<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['title', 'parent_id'];

    public function childs()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function($model){
            $model->products()->detach();
            /**
             * Remove parent from this category's child
             */
            foreach ($model->childs as $child) {
                $child->parent_id = '';
                $child->save();
            }
        });
    }

    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

}
