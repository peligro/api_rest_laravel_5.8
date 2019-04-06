<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $guarded =[];
    public $timestamps = false;
    protected $table = 'post_categoria';
   
}