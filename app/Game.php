<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_white',  'id_black', 'tournament', 'result', 'movements',
    ];

    public function jugadorBlancas()
    {
        return $this->belongsToMany('App\Player', 'players', 'id_white', 'id');
    }

    public function jugadorNegras()
    {
        return $this->belongsToMany('App\Player', 'players', 'id_black', 'id');
    }
}