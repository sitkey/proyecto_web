<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    public function pokemons()
    {
        return $this->hasOne('App\Pokemons');
    }
}
