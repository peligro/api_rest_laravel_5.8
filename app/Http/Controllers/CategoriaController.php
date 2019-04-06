<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categoria;
class CategoriaController extends Controller
{
    
    public function __construct()
    {
         $this->middleware('acceso');
    }
   
    public function index()
    {
        $datos=Categoria::all();
        return response()->json( $datos,200);
    }
    public function show($id)
    {
        $datos=Categoria::find($id);
        if(is_object($datos))
        {
            return response()->json( $datos,200);
        }else
        {
            abort(404);
        }
        
    }
}