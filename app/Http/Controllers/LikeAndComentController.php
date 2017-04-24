<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Post;
use App\LikesPosts;
use App\ComentariosPost;
use App\PostPersonalizados;
use App\DatosPersonales;
use App\HistorialActividadesRecientes;

class LikeAndComentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function StoreLikeUserPost(Request $request){
      if($request->ajax()) {
        $idUserLike = $request->idLikeUser;
        $idPostLike = $request->idLikePost;
        $idPostDisLike = $request->idDislikePost;
        $idUserPublicoPost = $request->idUserPublicPost;

        $allLikes = LikesPosts::where('id_publicacion','=', $idPostLike)->get();

        if(count($allLikes)==0) { 
          $dataLikePost = array(
            'id_publicacion' => $idPostLike,
            'id_usuarios_likes' => $idUserLike,
            'total_likes' => '1',
          );
          $createNewLikePost = new LikesPosts($dataLikePost);
          $createNewLikePost->save();
          $totalLikes = $createNewLikePost->total_likes;

          // CREATE NOTIFICACIONES
          $usuarioPublic = $idUserPublicoPost;
          $idPostPublicado = $idPostLike;
          $tipoActividad = '11';

          $Usuarios = DatosPersonales::where('id_usuario', '=', $usuarioPublic)->get();
          foreach ($Usuarios as $keyUsuarios) {
            if($usuarioPublic == $keyUsuarios->id_usuario){
              $nameUser = $keyUsuarios->nombre.' '.$keyUsuarios->apellidos;
              $DescriptActiviti = 'a '.$totalLikes;
            }
            
            $dataPublicActiviti = array(
              'id_usuario' => $usuarioPublic,
              'nonbre_user' => $nameUser,
              'tipo_actividad' => $tipoActividad,
              'id_post' => $idPostPublicado,
              'descripcion_actividad' => $DescriptActiviti,
            );

            $DataStoreActivity = new HistorialActividadesRecientes($dataPublicActiviti);  
            $DataStoreActivity->save();
          }


          echo json_encode($totalLikes);
         
        }else{ 

          if($idPostDisLike != ''){

            $UpdateLikePost = LikesPosts::where('id_publicacion', '=',$idPostLike)->get();

            foreach ($UpdateLikePost as $keyUpdateLikePost) {
              $updateLikes = $keyUpdateLikePost->total_likes -1;            
              $updateUsersLikes = $keyUpdateLikePost->id_usuarios_likes;   
              $DescomponerUserLikes = explode(",", $keyUpdateLikePost->id_usuarios_likes);
              $contador;
              $posicion = -1;
              // Busco la pociion del usuario que quito el like a la publicacion
              for( $contador=0; $contador < count($DescomponerUserLikes); $contador++ )
              {
                 if( $DescomponerUserLikes[$contador] == $idPostDisLike ) {
                     $posicion = $contador;
                     break;
                }
              }
              // Eliminando pocion encontrada
              unset($DescomponerUserLikes[$posicion]);
              $gurdadndoLikeSeparadoPorCOma = implode(",", $DescomponerUserLikes);

              $UpdateLikePost = \DB::table('likes_posts')
                ->where('id_publicacion', '=', $idPostLike)
                ->update(['id_usuarios_likes' => $gurdadndoLikeSeparadoPorCOma, 'total_likes' => $updateLikes]);

              $totalLikes = $keyUpdateLikePost->total_likes-1;
              echo json_encode($totalLikes);
            }

          }else{            
            $UpdateLikePost = LikesPosts::where('id_publicacion', '=',$idPostLike)->get();

            foreach ($UpdateLikePost as $keyUpdateLikePost) {
              $updateLikes = $keyUpdateLikePost->total_likes +1;            
              $updateUsersLikes = $keyUpdateLikePost->id_usuarios_likes;   

              $UnionAllUsersLikes =   $updateUsersLikes.','.$idUserLike; 

              $UpdateLikePost = \DB::table('likes_posts')
                ->where('id_publicacion', '=', $idPostLike)
                ->update(['id_usuarios_likes' => $UnionAllUsersLikes, 'total_likes' => $updateLikes]);

              $totalLikes = $keyUpdateLikePost->total_likes+1;

              // CREATE NOTIFICACIONES
              $usuarioPublic = $idUserPublicoPost;
              $idPostPublicado = $idPostLike;
              $tipoActividad = '11';

              $Usuarios = DatosPersonales::where('id_usuario', '=', $usuarioPublic)->get();
              foreach ($Usuarios as $keyUsuarios) {
                if($usuarioPublic == $keyUsuarios->id_usuario){
                  $nameUser = $keyUsuarios->nombre.' '.$keyUsuarios->apellidos;
                  $DescriptActiviti = 'a '.$totalLikes;
                }
                
                $dataPublicActiviti = array(
                  'id_usuario' => $usuarioPublic,
                  'nonbre_user' => $nameUser,
                  'tipo_actividad' => $tipoActividad,
                  'id_post' => $idPostPublicado,
                  'descripcion_actividad' => $DescriptActiviti,
                );

                $DataStoreActivity = new HistorialActividadesRecientes($dataPublicActiviti);  
                $DataStoreActivity->save();
              }

              echo json_encode($totalLikes);
            }
          }

          
        }

      }
    }



    public function ComentariosPosts(Request $request){

      if($request->ajax()){
        $idComentarioUser = $request->idComentUser;
        $ComentarioUser = $request->ComentPost;
        $IdPost = $request->idDtasPost;
        $idUserPublicoPost = $request->idPostComent;

        $NewComents = array();

        $dataComentPost = array(
          'comentarios' => $ComentarioUser,
          'id_usuario' => $idComentarioUser,
          'id_publicacion' => $IdPost,
        );

        $createNewComentPost = new ComentariosPost($dataComentPost);
        $createNewComentPost->save();
        $UserPotComent = $createNewComentPost->comentarios;

        // CREATE NOTIFICACIONES
        $usuarioPublic = $idUserPublicoPost;
        $idPostPublicado = $IdPost;
        $tipoActividad = '12';

        $Usuarios = DatosPersonales::where('id_usuario', '=', $idComentarioUser)->get();
        foreach ($Usuarios as $keyUsuarios) {
          if($idComentarioUser == $keyUsuarios->id_usuario){
            $nameUser = $keyUsuarios->nombre.' '.$keyUsuarios->apellidos;
            $DescriptActiviti = 'comentó tu publicación';

            $dataPublicActiviti = array(
              'id_usuario' => $usuarioPublic,
              'nonbre_user' => $nameUser,
              'tipo_actividad' => $tipoActividad,
              'id_post' => $idPostPublicado,
              'descripcion_actividad' => $DescriptActiviti,
            );

            $DataStoreActivity = new HistorialActividadesRecientes($dataPublicActiviti);  
            $DataStoreActivity->save();
          }
         
        }

        $JoinTableUserPostsComents =  \DB::table('users')
        ->join('datos_personales', 'users.id', '=', 'datos_personales.id_usuario')
        ->select('*')
        ->where('users.id', '=',$idComentarioUser)
        ->get();

        foreach ($JoinTableUserPostsComents as $UserPostsComents) {
          $nommbre = $UserPostsComents->name;
          $GetImage  = \Storage::disk('ubUploadsChange')->get('/profiles/'.$UserPostsComents->foto.'');
          $DataImgae = base64_encode($GetImage);
          $foto = 'background-image: url("data:'.$UserPostsComents->mime.';base64,'.$DataImgae.'")';
          // dd($foto);
          $tipeFoto = $UserPostsComents->mime;
          $id_usuario = $UserPostsComents->id_usuario;
          $comentarios = $ComentarioUser;
          $id_publicacion = $IdPost;

          $crateComent = "<div class='ui feed uifeedComnetUser'><div class='event'><div class='label dataPrubeIm' style='$foto')'></div><div class='content'><div class='summary'><a href='profile-users/$id_usuario' class='user colorGrisMediumSuave fontMiriamProSemiBold'>$nommbre</a><div class='date fontMiriamProRegular colorGrisMediumSuave comentUser'>$comentarios</div></div></div></div></div>";

          echo $crateComent;
        }

      }


    }


    public function PostPersonalizadoUser(Request $request){
      if($request->ajax()){

        $idUserPostPersonalizado = $request->idPostPersonalizadoUser;
        $idUPostPersonalizado = $request->idDataPostpersona;

        $dataPostPersonalizado = array(
          'id_posts' => $idUPostPersonalizado,
          'id_usuario' => $idUserPostPersonalizado,
        );

        $createNewPostPersonalizado = new PostPersonalizados($dataPostPersonalizado);
        $createNewPostPersonalizado->save();

        echo json_encode('Creado');

      }
    }

    public function getComentsPost(Request $request){
      if($request->ajax()) {
        $idPost = $request->idpostComents;
        $ArrayComentarios = array();

        $JoinTableUserPostsComents =  \DB::table('users')
        ->join('datos_personales', 'users.id', '=', 'datos_personales.id_usuario')
        ->join('comentarios_post', 'users.id', '=', 'comentarios_post.id_usuario')
        ->select('users.name','datos_personales.foto','datos_personales.mime','datos_personales.id_usuario','comentarios_post.comentarios','comentarios_post.id_publicacion')
        ->where('id_publicacion', '=', $idPost)
        ->get();

        foreach ($JoinTableUserPostsComents as $keyComents) {
          $nommbre = $keyComents->name;
          $GetImage  = \Storage::disk('ubUploadsChange')->get('/profiles/'.$keyComents->foto.'');
          $DataImgae = base64_encode($GetImage);
          $foto = 'background-image: url("data:'.$keyComents->mime.';base64,'.$DataImgae.'")';
          // dd($foto);
          $tipeFoto = $keyComents->mime;
          $id_usuario = $keyComents->id_usuario;
          $comentarios = $keyComents->comentarios;
          $id_publicacion = $keyComents->id_publicacion;

          $crateComent = "<div class='ui feed uifeedComnetUser'><div class='event'><div class='label dataPrubeIm' style='$foto')'></div><div class='content'><div class='summary'><a href='profile-users/$id_usuario' class='user colorGrisMediumSuave fontMiriamProSemiBold'>$nommbre</a><div class='date fontMiriamProRegular colorGrisMediumSuave comentUser'>$comentarios</div></div></div></div></div>";

          echo $crateComent;

          // $DataComentario = array('Comentario' => $crateComent);

          // array_push($ArrayComentarios, $DataComentario);
          # code...
        }


        // $GetComentarios = ComentariosPost::where('id_publicacion', '=', $idPost)->get();
       // echo ($ArrayComentarios);

     }
    }


}
