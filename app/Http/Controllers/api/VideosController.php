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


class VideosController extends Controller
{
  public function consulta_video()
  {

    try{
      $zzvideos= DB::table('wp_postmeta as a')
      ->join('wp_posts as b','a.post_id','=','b.ID') 
      ->select('a.meta_id','a.post_id','a.meta_key','a.meta_value','b.post_title','b.post_status','b.post_name','b.post_content','b.id')
      ->where('a.meta_key', 'like', 'player_0_embed_player')
      ->whereIn('b.id',['16275','19736','19767','19677','18514','18489',' 18490','18500','18503','18022'])
      ->whereIn('b.post_status',['publish','inherit'])
      ->orderby('a.post_id')
      //->take('50')
      ->get();         

      $data=[];
      foreach ($zzvideos as $video) {
           //obtener la imagen 
        $imagen = DB::table('wp_postmeta')
        ->where('meta_key','like','poster_url')->where('post_id',$video->post_id)->first();

        if($imagen) $img = $imagen->meta_value;
        else $img="";
            //obtener capitulo
        $episodio = DB::table('wp_postmeta')
        ->where('meta_key','like','wpk_episode')->where('post_id',$video->post_id)->first();


        if($episodio) $capitulo = $episodio->meta_value;
        else $capitulo="";
        
        //segundo url
        $zurl = DB::table('wp_postmeta')->where('post_id',$video->post_id)
        ->where('meta_key','like','player_1_embed_player')->first();
        if($zurl)  
          { $url2 = $zurl->meta_value;}
        else{
          $url2="";
        } 
            //obtener categoria

        $categoria =db::table('wp_term_relationships as a')
        ->join('wp_terms as b','a.term_taxonomy_id','=','b.term_id')
        ->select('b.term_id as idc', 'b.name as nombre')
        ->where('a.object_id',$video->id)
        ->get();

            //preg_match('/src="([^"]+)"/', $video->meta_value, $match);
        $salida = $video->meta_value;
        preg_match_all('/<iframe[^>]+src="([^"]+)"/', $salida, $match);
        $url = $match[1];

        if($url2){
          $salida = $url2;
        preg_match_all('/<iframe[^>]+src="([^"]+)"/', $salida, $match2);
          $url2 = $match2[1];
        }

                   //dd($categoria);
        $data[]=[
          'id' => $video->post_id,
          'titulo' => $video->post_title,
          'descripcion' => $video->post_content,
          'url' => $url,
          'url2' => $url2,
          'img' => $img,
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



}
