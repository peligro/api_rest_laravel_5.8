<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Categoria;
class Post extends Model
{
    protected $guarded =[];
    public $timestamps = false;
    protected $table = 'post';
    public function post_categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}