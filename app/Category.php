<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //RELAZIONE TRA CATEGORIES E POSTS

    // UNA CATEGORIA PUò ESSERE IN PIù POST QUINDI IL METODO PRENDERà IL NOME DELLA TABELLA AL PLURALE PER RAFFORZARE IL CONCETTO DI *

    public function posts(){
        return $this->hasMany('App\Post');
    }


}
