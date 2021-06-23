<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable =[
     'title',
     'slug',
     'category_id',
     'content'
    ];
    // RELAZIONE TRA POST E CATEGORIES
    
    // UN POST PUò AVERE SOLO UNA CATEGORIA, PER QUESTO IL METODO PRENDE IL NOME DELLA TABELLA AL SINGOLARE, PER RAFFORZARE L'1
    
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
