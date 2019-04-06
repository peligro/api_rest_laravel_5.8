<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
class PostController extends Controller
{
    private $jwtAuth;
    public function __construct()
    {
        
        $this->middleware('acceso');
        $this->jwtAuth=new \Helpers();
    }
   
    public function index()
    {
        $datos=Post::all();
        $array=array();
        foreach($datos as $dato)
            {
                $array[]=array
                (
                        'id'=>$dato->id,
                        'post_categoria_id'=>$dato->post_categoria_id,
                        'categoria'=>$dato->post_categoria->nombre,
                        'categoria_slug'=>$dato->post_categoria->slug,
                        'titulo'=>$dato->titulo,
                        'slug'=>$dato->slug,
                        'detalle'=>$dato->detalle,
                        'foto'=>$this->jwtAuth->base_path().'public/uploads/'.$dato->foto,
                        'fecha'=>$this->jwtAuth->fecha($dato->fecha)
                );
            }
        return response()->json( $array,200);
    }
    public function show($id)
    {
        $datos=Post::find($id);
        if(is_object($datos))
        {
            $array[]=array
                (
                        'id'=>$datos->id,
                        'post_categoria_id'=>$datos->post_categoria_id,
                        'categoria'=>$datos->post_categoria->nombre,
                        'categoria_slug'=>$datos->post_categoria->slug,
                        'titulo'=>$datos->titulo,
                        'slug'=>$datos->slug,
                        'detalle'=>$datos->detalle,
                        'foto'=>$this->jwtAuth->base_path().'public/uploads/'.$datos->foto,
                        'fecha'=>$this->jwtAuth->fecha($datos->fecha)
                );
            return response()->json( $array,200);
        }else
        {
            abort(404);
        }
    }
}