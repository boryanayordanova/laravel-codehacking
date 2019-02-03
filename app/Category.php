<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable; //used on version 4.0
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;



class Category extends Model
{

    use Sluggable; //version 4.0
    use SluggableScopeHelpers;

    
    //
    protected $fillable = ['name','slug',];



    public function sluggable() {
        return [
            'slug' => [
                'source'         => 'name'//,
                // 'separator'      => '-',
                // 'includeTrashed' => true,
            ]
        ];
    }
}
