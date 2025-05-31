<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'country', 'ranking', 'title', 
    ];

    public function titles()
    {
        return $this->belongsToMany('App\Title', 'titles', 'title', 'title');
    }
}
