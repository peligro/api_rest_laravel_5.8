<?php
namespace App\Helpers;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;
use App\User;
class Helpers {
   
  private $key;
  public function __construct()
  {
    $this->key='*z4]P{sFhUeEsdec{RPR';
  } 
  public function login($email, $password)
  {
     if (Auth::attempt(['email' => $email, 'password' => $password, 'estado' => '1']))
     {
      $datos = array(
          [
            'id' => Auth::id(),
            'email' => Auth::user()->email,
            'name'=>Auth::user()->name,
            'iat'=>time(),
            'exp' => time() + (60 * 60), //una hora
            ]
        );
        $token = JWT::encode($datos, $this->getKey(), 'HS256');
        $data=array
        (
          'status'=>'success',
          'mensaje'=>'login correcto',
          'token'=>$token
        );
      }else
      {
        $data=array
        (
          'status'=>'error',
          'mensaje'=>'Las credenciales ingresadas son inválidas',
          'token'=>null
        );
      }
    return $data;
  }
  private function getKey()
  {
    return $this->key;
  }
  public function checkToken($token)
  {
      
      $auth=false;
      if(empty($token))
      {
        $auth=false;
      }else
      {
        try {
        $explode=explode(' ', $token);
        $decode=JWT::decode($explode[1], $this->getKey(), ['HS256']);
        $auth=true;
        } catch (\UnexpectedValueException $e) {
          $auth=false;
        }catch(\DomainException $e)
        {
          $auth=false;
        }
      }
      
     
      return $auth;
  }
  public function fecha($fechaBruto, $tipo='') 
    {
        $fechaArray=explode(' ', $fechaBruto);
        $fecha=explode('-', $fechaArray[0]);
        switch ($fecha[1]){
          case '01':
          $mes="Enero";
          break;
          case '02':
          $mes="Febrero";
          break;
          case '03':
          $mes="Marzo";
          break;
          case '04':
          $mes="Abril";
          break;
          case '05':
          $mes="Mayo";
          break;
          case '06':
          $mes="Junio";
          break;
          case '07':
          $mes="Julio";
          break;
          case '08':
          $mes="Agosto";
          break;
          case '09':
          $mes="Septiembre";
          break;
          case '10':
          $mes="Octubre";
          break;
          case '11':
          $mes="Noviembre";
          break;
          case '12':
          $mes="Diciembre";
          break;
        }
        switch($tipo)
        {
          case 'datetime':
            $hora=explode(':', $fechaArray[1]);
            return $fecha[2].' de '.$mes.' de '.$fecha[0].' a las '.$hora[0].':'.$hora[1].':'.$hora[2].' ';
          break;
          case 'dte':
            return $fecha[0].''.$fecha[1].''.$fecha[2];
          break;
          default:
            return $fecha[2].' de '.$mes.' de '.$fecha[0]; 
          break;
        }
        
    }
    public function base_path()
    {
      //return Helpers::base_domain().'/tamila/cencosud/dad_2_mn1/';
      return "http://".dirname($_SERVER['SERVER_NAME']."".$_SERVER['PHP_SELF'])."/";
    }
}