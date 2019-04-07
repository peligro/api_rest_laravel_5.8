<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Categoria;
use App\Post;
class RestController extends Controller
{
    private $jwtAuth;
    public function __construct()
    {
         $this->jwtAuth=new \Helpers();
    }
   
    public function login(Request $request)
    {
       $validar=Validator::make($request->all(),
        [
            'email'=>'required|email',
            'password'=>'required'
        ]
       );
       if($validar->fails())
       {
            $data=array
            (
              'status'=>'error',
              'mensaje'=>'Las credenciales ingresadas son inválidas',
              'token'=>null
            );
            return $data;
       }else
       {
           
            return $this->jwtAuth->login($request->input('email'), $request->input('password'));
       }
    }
    public function token(Request $request)
    {
       if($this->jwtAuth->checkToken($request->header('Authorization'))==false)
        {
            abort(401);
        }
       $datos= $this->jwtAuth->traducirToken($request->header('Authorization'));
       return response()->json( $datos[0],200);
    }
}