<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\videos;
use App\categoria;
use App\entradas;

use DB;
use App\relacion;
use App\favorite;
use App\dowl;
use App\tarde;

class VideosController extends Controller
{
 
   public function buscar($idpost)
   {

    try{
      $errors = [];
      if (!isset($idpost)) $errors[] = "Id is required";
      if (count($errors) > 0) {
        return ["status" => "fallo", "error" => $errors];
      }
        //$idusuario = $request["codigo"];
        //$idpost    = $request["idpost"];
        $videos =DB::table('wp_postmeta as a')
                     ->select('a.meta_id','a.post_id','a.meta_key','a.meta_value')
                     ->where('a.post_id',$idpost)
                     ->where('a.meta_key', 'like', 'player_1_embed_player')->first();
                     
        if($videos) $url = $videos->meta_value;
        else $url="";

        $zvideos =DB::table('wp_postmeta as a')
                     ->select('a.meta_id','a.post_id','a.meta_key','a.meta_value')
                     ->where('a.post_id',$idpost)
                     ->where('a.meta_key', 'like', 'player_0_embed_player')->first();
                     
        if($zvideos) $zurl = $zvideos->meta_value;
        else $zurl="";


        return view('videos.layout')->with('url',$url)->with('zurl',$zurl);

    } catch (Exception $e) {
      return ['status' => 'fallo','error'=>["An error has occurred, try again"]];
    }

  }

  public function consulta_video()
  {
    try{
      $fecha = '2017-12-31';
      $zzvideos= DB::table('wp_postmeta as a')
      ->join('wp_posts as b','a.post_id','=','b.ID') 
      ->select('a.meta_id','a.post_id','a.meta_key','a.meta_value','b.post_title','b.post_status','b.post_name','b.post_content','b.id','b.post_date','b.guid')
      ->where('a.meta_key', 'like', 'player_0_embed_player')
      ->where('b.post_date','>',$fecha)
      ->whereIn('b.post_status',['publish','inherit'])
      ->orderby('b.post_date','DESC')
      //->take('50')
      ->get();         

      $data=[];
      foreach ($zzvideos as $video){
           //obtener la imagen 
        $imagen = DB::table('wp_postmeta')
        ->where('meta_key','like','poster_url')->where('post_id',$video->post_id)->first();

        if($imagen) $img = $imagen->meta_value;
        else $img="";
        if($img==""){
          $timagen = db::table('wp_posts')->where('post_parent',$video->post_id)->where('post_mime_type','like','image/jpeg%')->first();
          if($timagen) $img = $timagen->guid;
        } 
            //obtener capitulo
        $episodio = DB::table('wp_postmeta')
        ->where('meta_key','like','wpk_episode')->where('post_id',$video->post_id)->first();


        if($episodio) $capitulo = $episodio->meta_value;
        else $capitulo="";
        
        //segundo url
        $zurl = DB::table('wp_postmeta')->where('post_id',$video->post_id)
        ->where('meta_key','like','player_1_embed_player')->first();
        if($zurl)  
          { $url2 = $zurl->meta_value;
            $zzurl2 = $url2;
          }
        else{
          $url2="";
          $zzurl2 = "";

        } 
            //obtener categoria

        $categoria =db::table('wp_term_relationships as a')
        ->join('wp_terms as b','a.term_taxonomy_id','=','b.term_id')
        ->select('b.term_id as idc', 'b.name as nombre')
        ->where('a.object_id',$video->id)
        ->get();
        $url = $video->meta_value;
        $purl = $url;
        $descarga = "";
        //preg_match('/src="([^"]+)"/', $video->meta_value, $match);
        
        //$salida = $video->meta_value;
        //preg_match_all('/<iframe[^>]+src="([^"]+)"/', $salida, $match);
        //$url = $match[1];
        //if($url2){
          //$salida = $url2;
        //preg_match_all('/<iframe[^>]+src="([^"]+)"/', $salida, $match2);
          //$url2 = $match2[1];
        //}
        //if(isset($url[0])) $zurl= $url[0];

        //$buscar = 'animeidhentai.com';
        //if($zurl)
        //{
          //$pos = strpos($zurl, $buscar);
        //}
        //if($pos) $descarga = $zurl;
        //else
        //{
          //if(isset($url2[0])){ $zurl= $url2[0]; }      
          //$pos = strpos($zurl, $buscar);
          //if($pos) $descarga = $zurl;  
          //else $descarga='';          
        //}
                   //dd($categoria);
        $data[]=[
          'id' => $video->post_id,
          'titulo' => $video->post_title,
          'descripcion' => $video->post_content,
          'url' => $purl,
          'url2' => $zzurl2,
          'img' => $img,
          'descarga' => $descarga,
          'capitulo' => $capitulo,
          'categorias' => $categoria
        ];
      }
    //                    'video' => config('app.url') . 'videosvr/' . $video->video,
      return ["status"=>'exito', 'data' => $data];

    } catch (Exception $e) {
      return ['status' => 'fallo','error'=>["An error has occurred, try again"]];
    }


  }

  public function add_favorito(Request $request)
  {
    try{
      $errors = [];
      if (!isset($request["codigo"])) $errors[] = "Codigo is required";
      if (!isset($request["id"])) $errors[] = "Id is required";


      if (count($errors) > 0) {
        return ["status" => "fallo", "error" => $errors];
      }
      $idusuario = $request["codigo"];
      $idpost    = $request["id"];
      $favorite = favorite::where("wp_user_id",$idusuario)->where("wp_post_id",$idpost)->first();
      if($favorite)
      {
       $errors[] = "Already registered";
       return ["status" => "fallo", "error" => $error];
     }else{
      $nuevo             = new favorite($request->all());
      $nuevo->wp_user_id =  $idusuario;
      $nuevo->wp_post_id =  $idpost;
      $nuevo->save();
      return ["status" => "exito", "data" => ["token" => crea_token($idusuario), "id" => $idpost, "codigo" => ($idusuario)]];
    }

  }catch(Exception $e){
    return ['estatus' => 'fallo','error'=>["An error has occurred, try again"]];
  }
}


public function cons_favorito(Request $request)
{
  try{
    $errors = [];
    if (!isset($request["codigo"])) $errors[] = "Codigo is required";


    if (count($errors) > 0) {
      return ["status" => "fallo", "error" => $errors];
    }
    $idusuario = ($request["codigo"]);

    $favorite = favorite::where("wp_user_id",$idusuario)->get();

    if($favorite)
    {

      $data=[];
      foreach ($favorite as $video) {

       $entrada = DB::table('wp_posts')
       ->where('id',$video->wp_post_id)->first();         
       $data[]=[
        'id' => $video->wp_post_id,
        'titulo' => $entrada->post_title,
        'idusuario' => $video->wp_user_id
      ];
    }
    return ["status"=>'exito', 'data' => $data];

  }else{
   $errors[] = "Not registered";
   return ["status" => "fallo", "error" => $error];

 }

}catch(Exception $e){
  return ['estatus' => 'fallo','error'=>["An error has occurred, try again"]];
}
}


public function del_favorito(Request $request)
{
  try{
    $errors = [];
    if (!isset($request["codigo"])) $errors[] = "Codigo is required";
    if (!isset($request["id"])) $errors[] = "Id is required";
    $idusuario = ($request["codigo"]);

    if($idusuario==0){
      $errors[] = "Codigo is required";
    }

    if (count($errors) > 0) {
      return ["status" => "fallo", "error" => $errors];
    }


    $idpost    = $request["id"];
    $favorite = favorite::where("wp_user_id",$idusuario)->where("wp_post_id",$idpost)->first();
    if($favorite)
    {
     $favorite->delete();
     return ["status" => "exito,", "data" => ["token" => crea_token($idusuario), "id" => $idpost, "codigo" => $idusuario]];
   }

 }catch(Exception $e){
  return ['estatus' => 'fallo','error'=>["An error has occurred, try again"]];
}
}

public function add_dowl(Request $request)
{
  try{
    $errors = [];
    if (!isset($request["codigo"])) $errors[] = "Codigo is required";
    if (!isset($request["id"])) $errors[] = "Id is required";


    if (count($errors) > 0) {
      return ["status" => "fallo", "error" => $errors];
    }
    $idusuario = ($request["codigo"]);
    $idpost    = $request["id"];
    $dowl = dowl::where("wp_user_id",$idusuario)->where("wp_post_id",$idpost)->first();
    if($dowl)
    {
     $errors[] = "Already registered";
     return ["status" => "fallo", "error" => $error];
   }else{
    $nuevo     = new dowl($request->all());
    $nuevo->wp_user_id = $idusuario;
    $nuevo->wp_post_id = $idpost;
    $nuevo->save();
    return ["status" => "exito", "data" => ["token" => crea_token($idusuario), "id" => $idpost, "codigo" => ($idusuario)]];
  }

}catch(Exception $e){
  return ['estatus' => 'fallo','error'=>["An error has occurred, try again"]];
}
}


public function cons_dowl(Request $request)
{
  try{
    $errors = [];
    if (!isset($request["codigo"])) $errors[] = "Codigo is required";


    if (count($errors) > 0) {
      return ["status" => "fallo", "error" => $errors];
    }
    $idusuario = $request["codigo"];

    $dowl = dowl::where("wp_user_id",$idusuario)->get();
    if($dowl)
    {

      $data=[];
      foreach ($dowl as $video) {
       $entrada = DB::table('wp_posts')
       ->where('id',$video->wp_post_id)->first();   
       $data[]=[
        'id' => $video->wp_post_id,
        'titulo' => $entrada->post_title,
        'idusuario' => $video->wp_user_id
      ];
    }
    return ["status"=>'exito', 'data' => $data];

  }else{
   $errors[] = "Not registered";
   return ["status" => "fallo", "error" => $error];

 }

}catch(Exception $e){
  return ['estatus' => 'fallo','error'=>["An error has occurred, try again"]];
}


}

 public function add_tarde(Request $request)
  {
    try{
      $errors = [];
      if (!isset($request["codigo"])) $errors[] = "Codigo is required";
      if (!isset($request["id"])) $errors[] = "Id is required";


      if (count($errors) > 0) {
        return ["status" => "fallo", "error" => $errors];
      }
      $idusuario = $request["codigo"];
      $idpost    = $request["id"];
      $tarde = tarde::where("wp_user_id",$idusuario)->where("wp_post_id",$idpost)->first();
      if($tarde)
      {
       $errors[] = "Already registered";
       return ["status" => "fallo", "error" => $error];
     }else{
      $nuevo             = new tarde($request->all());
      $nuevo->wp_user_id =  $idusuario;
      $nuevo->wp_post_id =  $idpost;
      $nuevo->save();
      return ["status" => "exito", "data" => ["token" => crea_token($idusuario), "id" => $idpost, "codigo" => ($idusuario)]];
    }

  }catch(Exception $e){
    return ['estatus' => 'fallo','error'=>["An error has occurred, try again"]];
  }
}


public function cons_tarde(Request $request)
{
  try{
    $errors = [];
    if (!isset($request["codigo"])) $errors[] = "Codigo is required";


    if (count($errors) > 0) {
      return ["status" => "fallo", "error" => $errors];
    }
    $idusuario = ($request["codigo"]);

    $tarde = tarde::where("wp_user_id",$idusuario)->get();

    if($tarde)
    {

      $data=[];
      foreach ($tarde as $video) {

       $entrada = DB::table('wp_posts')
       ->where('id',$video->wp_post_id)->first();         
       $data[]=[
        'id' => $video->wp_post_id,
        'titulo' => $entrada->post_title,
        'idusuario' => $video->wp_user_id
      ];
    }
    return ["status"=>'exito', 'data' => $data];

  }else{
   $errors[] = "Not registered";
   return ["status" => "fallo", "error" => $error];

 }

}catch(Exception $e){
  return ['estatus' => 'fallo','error'=>["An error has occurred, try again"]];
}
}


public function del_tarde(Request $request)
{
  try{
    $errors = [];
    if (!isset($request["codigo"])) $errors[] = "Codigo is required";
    if (!isset($request["id"])) $errors[] = "Id is required";
    $idusuario = ($request["codigo"]);

    if($idusuario==0){
      $errors[] = "Codigo is required";
    }

    if (count($errors) > 0) {
      return ["status" => "fallo", "error" => $errors];
    }


    $idpost    = $request["id"];
    $tarde = tarde::where("wp_user_id",$idusuario)->where("wp_post_id",$idpost)->first();
    if($tarde)
    {
     $tarde->delete();
     return ["status" => "exito,", "data" => ["token" => crea_token($idusuario), "id" => $idpost, "codigo" => $idusuario]];
   }

 }catch(Exception $e){
  return ['estatus' => 'fallo','error'=>["An error has occurred, try again"]];
}
}







public function bloqueo(Request $request)
{
   try{
      $errors = [];
      if (!isset($request["codigo"])) $errors[] = "Codigo is required";
      if (!isset($request["pin_bloqueo"])) $errors[] = "Pin Locked is required";
      if (count($errors) > 0) {
        return ["status" => "fallo", "error" => $errors];
      }     
      $pinb      = $request["pin_bloqueo"];
      $idusuario = $request["codigo"];
      $usuario = user::where('id',$idusuario)->first();
      if($usuario){
          $usuario->pin_bloqueo = $pinb;
          $usuario->save();

      return ["status" => "exito", "data" => ["token" => crea_token($idusuario), "pin_bloqueo" => $pinb, "codigo" => ($idusuario)]];

      }else{
     return ['estatus' => 'fallo','error'=>["An error has occurred, try again"]];

      }
  }catch(Exception $e){
    return ['estatus' => 'fallo','error'=>["An error has occurred, try again"]];
  }

}

}
