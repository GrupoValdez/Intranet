<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as facedesrequest;
use Illuminate\Support\Facades\Redirect;
use Session;
use Auth;

use App\User;
use App\Post;
use App\TiposPosts;
use App\HistorialActividadesRecientes;
use App\DatosPersonales;
use App\NotificacionesEventos;

class PostController extends Controller
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
    
   public function StorePost(Request $request)
   {
      $data = facedesrequest::all();

      // dd($data);
      $fileDocuments = $request->file('fileInputDocuemnt');  
      $fileImages = $request->file('fileInputImage');  
      $arrayDocuments = array();
      $arrayImages = array();
      $TipoDocumento = '';

      // Validad Subbida de archivos
      if($fileDocuments != ''){
        $cantidadDocument = count($fileDocuments);

        for ($i=0; $i < $cantidadDocument ; $i++) { 
         $nombreFoto = $fileDocuments[$i]->getClientOriginalName();
         $fileNameFoto = rand(11,99999);
         $imageName = $fileNameFoto.'.'.$fileDocuments[$i]->getClientOriginalExtension();
         $TipoDocumento = $fileDocuments[$i]->getClientMimeType();

         $SaveFile = \Storage::disk('ubUploadsChange')->put('documents/'.$imageName,  \File::get($fileDocuments[$i]));

         array_push($arrayDocuments, $imageName);
        }

      }elseif($fileImages != ''){
        $cantidadImages = count($fileImages);

        for ($i=0; $i < $cantidadImages ; $i++) { 
         $nombreFoto = $fileImages[$i]->getClientOriginalName();
         $fileNameFoto = rand(11,99999);
         $imageName = $fileNameFoto.'.'.$fileImages[$i]->getClientOriginalExtension();
         $TipoDocumento = $fileImages[$i]->getClientMimeType();

         $SaveFile = \Storage::disk('ubUploadsChange')->put('documents/'.$imageName,  \File::get($fileImages[$i]));
         array_push($arrayImages, $imageName);
        }
      }

      // Descomponiendo images y uniendolas
      if($arrayImages != ''){
        $uniedo_images = implode(",", $arrayImages);
      }else{
        $uniedo_images = '';
      }

      // Descomponiendo documentos y uniendolos
      if($arrayDocuments != ''){
        $uniedo_document = implode(",", $arrayDocuments);
      }else{
        $uniedo_document = '';
      }

      if($request->post_perso == '' && $request->post_purgent == '' && $request->post_evento == ''){
        $idPOst = '1';
      }else if($request->post_perso != ''){
        $idPOst = '3';
      }else if($request->post_purgent != ''){
        $idPOst = '2';
      }else if($request->post_evento != ''){
        $idPOst = '6';
      }


      $dataPublicPost = array(
        'descripcion' => $request->descrip_posts,
        'imagen' => $uniedo_images,
        'mime' => $TipoDocumento,
        'documentos' => $uniedo_document,
        'id_tipo_publicacion' => $idPOst,
        'id_tipo_evento' => $request->id_tipo_evento,
        'id_usuario' => $request->id_user,
      ); 

      $DataStorePosy = new Post($dataPublicPost);  
      $DataStorePosy->save();

      // CREATE ACTIVIDADES
      $usuarioPublic = $DataStorePosy->id_usuario;
      $idPostPublicado = $DataStorePosy->id;
      $tipoActividad = '0';

      if($idPOst == '1'){
        $tipoActividad  = '4';
      }elseif($idPOst == '2'){
        $tipoActividad  = '5';
      }elseif($idPOst == '6'){
        $tipoActividad  = '1';
      }

      $Usuarios = DatosPersonales::where('id_usuario', '=', $usuarioPublic)->get();

      foreach ($Usuarios as $keyUsuarios) {
        $nameUser = $keyUsuarios->nombre.' '.$keyUsuarios->apellidos;
        if($idPOst != '2' && $request->descrip_posts != ''){
          $DescriptActiviti = 'tienen una nueva';
        }elseif($idPOst != '2' && $idPOst != '6' && $request->descrip_posts == '' && $uniedo_images != ''){
          $DescriptActiviti = 'Ha publicado nuevas';
        }elseif($idPOst != '2' && $idPOst != '6' && $request->descrip_posts == '' && $uniedo_document != ''){
          $DescriptActiviti = 'Ha publicado un nuevo';
        }elseif($idPOst == '2'){
          $DescriptActiviti = 'Tiene una publicación';
        }elseif($idPOst == '6' ){
          $DescriptActiviti = 'evento';
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

      return back()->withInput();
   }


}
