<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    protected $fillable = [
        'titulo', 'descripcion', 'fecha_creacion',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * get the users associate by id
     */
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
