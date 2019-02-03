<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable; //used on version 4.0
//use Cviebrock\EloquentSluggable\SluggableInterface; //used on version 3.0
//use Cviebrock\EloquentSluggable\SluggableTrait; //used on version 3.0
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


class Post extends Model //implements SluggableInterface //userd for version 4.2
{

        //run
    //composer require cviebrock/eloquent-sluggable:3.0.*

    //see https://github.com/cviebrock/eloquent-sluggable/blob/master/UPGRADING.md
    
   // use SluggableTrait; //used in version 3.0
   use Sluggable; //version 4.0
   use SluggableScopeHelpers;

   
    protected $fillable = [
        'category_id', 
        'photo_id',
        'title',
        'slug',
        'body',
        'user_id'
    ];

    

    
    //version 3.0:
    // protected $sluggable = [
    //     'build_from' => 'title',
    //     'save_to' => 'slug',
    //     // 'separator'       => '-',
    //     'on_update' => true
    // ];

    public function sluggable() {
        return [
            'slug' => [
                'source'         => 'title'//,
                // 'separator'      => '-',
                // 'includeTrashed' => true,
            ]
        ];
    }



    public function user(){

		  return $this->belongsTo('App\User');
    }
    
    public function photo(){

		  return $this->belongsTo('App\Photo');
    }
    
    public function category(){

		  return $this->belongsTo('App\Category');
    }
    
    public function comments(){

        return $this->hasMany('App\Comment');
      
    }

    public function photoPlaceholder(){

        return "http://placehold.it/700x250";
    }



}
