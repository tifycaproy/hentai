<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\usuario;
use Illuminate\Http\Request;
use App\Mail\RegistroMail;
use Mail;
@session_start();

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
// Versión 1
    public function registro(Request $request)
    {
     try {

      $errors = [];
      if (!isset($request["email"])) $errors[] = "Email is required";
      if (!isset($request["name"])) $errors[] = "Name is required";
      if (!isset($request["password"])) $errors[] = "Password is required";

      if (count($errors) > 0) {
        return ["status" => "fallo", "error" => $errors];
      }
      $email = $request["email"];
      $name  = $request["name"];   
      $pass = password_hash($request["password"], PASSWORD_DEFAULT);
      $pin   = rand(1000, 9999);
      $_SESSION["pin"] = $pin;
      $_SESSION["mensaje"] = "PIN de Validación";
      if (Usuario::where('email', $email)->first()) {
        $error = "Email already registered";
        return ["status" => "fallo", "error" => $error];
      }
      $request["password"] = bcrypt($request->password);
      $nuevo           = new Usuario($request->all());
      $nuevo->pin      = $pin;
      $nuevo->name     = $name;
      $nuevo->email    = $email;
      $nuevo->password = $pass;
      $nuevo->pin      = $pin;
      $nuevo->created_at     = date("Y-m-d H:i:s");
      $nuevo->updated_at     = date("Y-m-d H:i:s");            
      $nuevo->save();
      $idusuario       = $nuevo->id;
      $data= [
        "email"         => $email,
        "pin"           => $pin

      ];
      Mail::to($email)->send(new RegistroMail($data));
      return ["status" => "exito", "data" => ["token" => crea_token($idusuario), "idusuario" => $idusuario, "codigo" => codifica($idusuario)]];
    } catch (Exception $e) {
      return ['status' => 'fallo', 'error' => ["An error has occurred, try again"]];
    }
  }

  public function validar_pin(Request $request)
  {

   $errors = [];
   if (!isset($request["email"])) $errors[] = "Email is required";
   if (!isset($request["pin"])) $errors[] = "Pin is required";
   if (count($errors) > 0) {
    $result = ["status" => "fallo", "error" => $errors];
    return $result;
  }
            //fin validaciones
  $email = $request["email"];
  $pin   = $request["pin"];
  $usuario = Usuario::where('email', $email)->where('pin', $pin)->first();
  if ($usuario) {
    $usuario->estatus = 1;
    $usuario->save(); 
    $result = ["status" => "exito", "data" => ["token" => crea_token($usuario->id), "codigo" => codifica($usuario->id), "idusuario" => $usuario->id] ];
        //$usuario->update(['estatus' => '1']);
    return $result;
  }  else {
    $errors ="Excuse, PIN Incorrect";
    $result = ["status" => "fallo", "error" => $errors];
    return $result;
  }

}


public function cambiar(Request $request)
{
     try {
       $errors = [];
       if (!isset($request["email"])) $errors[] = "Email is required";
       if (!isset($request["pass_old"])) $errors[] = "Old Password is required";
       if (!isset($request["pass_new"])) $errors[] = "New Password is required";
       if (count($errors) > 0) {
        $result = ["status" => "fallo", "error" => $errors];
        return $result;
      }
                //fin validaciones
      $email      = $request["email"];
      $pass  = $request["pass_old"];
      $passn = password_hash($request["pass_new"], PASSWORD_DEFAULT);
      
      $usuario = Usuario::where('email', $email)->first();
      if($usuario) {
        $resultado= password_verify($pass, $usuario->password);
        if(!$resultado)
        {
          $errors[] = "Old Password is invalid";

          if (count($errors) > 0) {
            $result = ["status" => "fallo", "error" => $errors];
            return $result;
          }
        }else{
          $usuario->password = $passn;  
          $usuario->save(); 
          $result = ["status" => "exito", "data" => ["token" => crea_token($usuario->id), "codigo" => codifica($usuario->id), "idusuario" => $usuario->id] ];
            //$usuario->update(['estatus' => '1']);
          return $result;
        }  
      }else{
        $errors[] = "Email is invalid";
        if (count($errors) > 0) {
          $result = ["status" => "fallo", "error" => $errors];
          return $result;
        }
      }

    } catch (Exception $e) {
      return ['status' => 'fallo', 'error' => ["An error has occurred, try again"]];
    }
}





public function reenviar_pin(Request $request)
{
  $errors = [];
  if (!isset($request["email"])) $errors[] = "Email is required";
  if (count($errors) > 0) {
    return ["status" => "fallo", "error" => $errors];
  }
  $pin   = rand(1000, 9999);
  $email = $request["email"];
  $_SESSION["pin"] = $pin;
  $_SESSION["mensaje"] = "Reenviar PIN de Validación";
  $usuario = Usuario::where('email', $email)->where('estatus',NULL)->first();
  $usuario->pin = $pin;
  $usuario->save();
  $idusuario = $usuario->id;
  $data= [
    "email"         => $email,
    "pin"           => $pin

  ];        
  Mail::to($email)->send(new RegistroMail($data));
  return ["status" => "exito", "data" => ["token" => crea_token($idusuario), "idusuario" => $idusuario, "codigo" => codifica($idusuario)]];

}

public function iniciar(Request $request){

  try {
            //Validaciones
    $errors = [];
    if (!isset($request["email"])) $errors[] = "Email is required";
    if (!isset($request["password"])) $errors[] = "Password is required";
    if (count($errors) > 0) {
      return ["status" => "fallo", "error" => $errors];
    }
            //fin validaciones
    $email = $request["email"];
    $usuario = Usuario::where('email', $email)->where('estatus',1)->first();

    $pass    = $request->password;

      //dd($pass);
    if ($usuario) {
      $idusuario = $usuario->id;
      $resultado= password_verify($pass, $usuario->password);
      if ($resultado) {
        return ["status" => "exito", "data" => ["token" => crea_token($idusuario), "idusuario" => $idusuario, "codigo" => codifica($idusuario)]];
      } else {
        return ["status" => "fallo", "error" => ["Password incorrect"]];
      }
    } else {
      return ["status" => "fallo", "error" => ["User or password incorrect"]];
    }
  } catch (Exception $e) {
    return ['status' => 'fallo', 'error' => ["An error has occurred, try again"]];
  }

}

public function perfil(Request $request)
{
 $errors = [];

 if (!isset($request["token"])) $errors[] = "Token is required";
 if (count($errors) > 0) {
  return ["status" => "fallo", "error" => $errors];
}
$idusuario = decodifica_token($request->token);
$usuario = usuario::where('id',$idusuario)->first();
$email   = $usuario->email;
$name    = $usuario->name;
return ["status" => "exito", "data" => ["email" => $email, "name" => $name]];
}

public function recuperar(Request $request)
{
     try {
       $errors = [];
       if (!isset($request["email"])) $errors[] = "Email is required";
       if (!isset($request["pass_new"])) $errors[] = "New Password is required";
       if (count($errors) > 0) {
        $result = ["status" => "fallo", "error" => $errors];
        return $result;
      }
                //fin validaciones
      $email      = $request["email"];
      $passn = password_hash($request["pass_new"], PASSWORD_DEFAULT);
      
      $usuario = Usuario::where('email', $email)->first();
      if($usuario) {
          $usuario->password = $passn;  
          $usuario->save(); 
          $result = ["status" => "exito", "data" => ["token" => crea_token($usuario->id), "codigo" => codifica($usuario->id), "idusuario" => $usuario->id] ];
            //$usuario->update(['estatus' => '1']);
          return $result;
        }  
      else{
        $errors[] = "Email is invalid";
        if (count($errors) > 0) {
          $result = ["status" => "fallo", "error" => $errors];
          return $result;
        }
      }

    } catch (Exception $e) {
      return ['status' => 'fallo', 'error' => ["An error has occurred, try again"]];
    }
}

}