<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_creacion',
        'fecha_inicio',
        'fecha_fin',
        'tipo',
        'estado',
        'provincia',
        'poblacion',
        'direccion',
        'hora_inicio',
        'hora_fin',
        'max_participantes'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * get the users associate by id
     */
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
