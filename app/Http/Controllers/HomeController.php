<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as facedesrequest;

use Auth;
use Session;
use App\User;
use App\Chats;
use App\GetOnline;
use App\Post;
use App\LikesPosts;
use App\ComentariosPost;
use App\PostPersonalizados;
use App\EventosCalendario;
use App\FormacionAcademica;
use App\Horarios;
use App\DetallesSolicitudes;
use App\TiposDescuentos;
use App\AsistenciaUsers;
use App\ComentariosSolicitudes;
use App\DatosPersonales;
use App\VacacionesUsers;
use App\EncargadosAreas;
use App\HistorialEvaluaciones;
use App\HistorialActividadesRecientes;
use App\Adps;
use App\HistorialAdps;
use App\NotificacionesEventos;
use App\RecordatoriosAdmin;


class HomeController extends Controller
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

    public function AllUsers(){
      // $Users = User::all();

      $Users =  \DB::table('users')
      ->join('datos_personales', 'users.id', '=', 'datos_personales.id_usuario')
      ->select('*')
      ->get();

      return $Users;
    }

    public function CreateGetOnlineUser($idUserLogin){

      $getDataOnline = GetOnline::where('id_user_login','=',$idUserLogin)->get();  
      if(!$getDataOnline->isEmpty()){
      }else{
        $dataGetOnline = array(
         'id_user_login' => $idUserLogin
        );
        $OnlineUserAdd = new GetOnline($dataGetOnline);  
        $OnlineUserAdd->save();
      }

      return;
    }

    public function UsersOnline(){

      $OnlineUser = GetOnline::all();
      $allUsers = DatosPersonales::all();
      $arrayUsersOnline = array();

      foreach ($OnlineUser as $keyOnlineUser) {
        foreach ($allUsers as $keyallUsers) {
          if($keyOnlineUser->id_user_login == $keyallUsers->id_usuario){
            $GetImage  = \Storage::disk('ubUploadsChange')->get('/profiles/'.$keyallUsers->foto.'');
            $DataImgae = base64_encode($GetImage);
            $foto = 'url("data:'.$keyallUsers->mime.';base64,'.$DataImgae.'")';

            $getArrayUser = array('id_user' => $keyallUsers->id_usuario, 'nombre_user' => $keyallUsers->nombre, 'foto' => $foto);
            array_push($arrayUsersOnline,$getArrayUser);
          }
        }       
      }

      return $arrayUsersOnline;
   }

    public function UsersOnlineAjax(){
      # get all users online
      $AllOnlineUser = $this->UsersOnline();      
      echo json_encode($AllOnlineUser);
   }


   public function getDaysMoth()
   {

    $totalMesesYear = 12;
    $carbon = new \Carbon\Carbon();
    $fechaActual = $carbon->now()->format('Y-m-d');
    $YearActual =  date("Y", strtotime($fechaActual));

    # Obteniendo los dias que tiene cada mes
    $enero = cal_days_in_month(CAL_GREGORIAN, 1, $YearActual); 
    $febrero = cal_days_in_month(CAL_GREGORIAN, 2, $YearActual); 
    $marzo = cal_days_in_month(CAL_GREGORIAN, 3, $YearActual); 
    $abril = cal_days_in_month(CAL_GREGORIAN, 4, $YearActual); 
    $mayo = cal_days_in_month(CAL_GREGORIAN, 5, $YearActual); 
    $junio = cal_days_in_month(CAL_GREGORIAN, 6, $YearActual); 
    $julio = cal_days_in_month(CAL_GREGORIAN, 7, $YearActual); 
    $agosto = cal_days_in_month(CAL_GREGORIAN, 8, $YearActual); 
    $septiembre = cal_days_in_month(CAL_GREGORIAN, 9, $YearActual); 
    $octubre = cal_days_in_month(CAL_GREGORIAN, 10, $YearActual); 
    $noviembre = cal_days_in_month(CAL_GREGORIAN, 11, $YearActual); 
    $diciembre = cal_days_in_month(CAL_GREGORIAN, 12, $YearActual); 

    # Guardando todos los dias de los meses en un array
    $dataDays = array($enero,$febrero,$marzo,$abril,$mayo,$junio,$julio,$agosto,$septiembre,$octubre,$noviembre,$diciembre);

    return $dataDays;

   }

   public function getCalendar()
   {

    $EventsCalendar = EventosCalendario::all();
    $arrayEvenEnero = array();
    $arrayEvenFebrero = array();
    $arrayEvenMarzo = array();
    $arrayEvenAbril = array();
    $arrayEvenMayo = array();
    $arrayEvenJunio = array();
    $arrayEvenJulio = array();
    $arrayEvenAgosto = array();
    $arrayEvenSeptiembre = array();
    $arrayEvenOctubre = array();
    $arrayEvenNoviembre = array();
    $arrayEvenDiciembre = array();

    # Obteniendo los eventos creados y alamcenandos segun el mes que correspondan
    foreach ($EventsCalendar as $keyEventsCalendar) {
      $crateEvent = array();
      $FechaMesEvento = date("m", strtotime($keyEventsCalendar->fecha_evento));

      if($FechaMesEvento == '01'){
        $DiaEventoEnero = date("d", strtotime($keyEventsCalendar->fecha_evento));
        $crateEvent = array('dia'=>$DiaEventoEnero, 'id_evento'=>$keyEventsCalendar->id, 'descripcion_evento'=>$keyEventsCalendar->descripcion_evento);
        array_push($arrayEvenEnero, $crateEvent);
      }elseif($FechaMesEvento == '02'){
        $DiaEventoFebrero = date("d", strtotime($keyEventsCalendar->fecha_evento));
        $crateEvent = array('dia'=>$DiaEventoFebrero, 'id_evento'=>$keyEventsCalendar->id, 'descripcion_evento'=>$keyEventsCalendar->descripcion_evento);
        array_push($arrayEvenFebrero, $crateEvent);
      }elseif($FechaMesEvento == '03'){
        $DiaEventoMarzo = date("d", strtotime($keyEventsCalendar->fecha_evento));
        $crateEvent = array('dia'=>$DiaEventoMarzo, 'id_evento'=>$keyEventsCalendar->id, 'descripcion_evento'=>$keyEventsCalendar->descripcion_evento);
        array_push($arrayEvenMarzo, $crateEvent);
      }elseif($FechaMesEvento == '04'){
        $DiaEventoAbril = date("d", strtotime($keyEventsCalendar->fecha_evento));
        $crateEvent = array('dia'=>$DiaEventoAbril, 'id_evento'=>$keyEventsCalendar->id, 'descripcion_evento'=>$keyEventsCalendar->descripcion_evento);
        array_push($arrayEvenAbril, $crateEvent);
      }elseif($FechaMesEvento == '05'){
        $DiaEventoMayo = date("d", strtotime($keyEventsCalendar->fecha_evento));
        $crateEvent = array('dia'=>$DiaEventoMayo, 'id_evento'=>$keyEventsCalendar->id, 'descripcion_evento'=>$keyEventsCalendar->descripcion_evento);
        array_push($arrayEvenMayo, $crateEvent);
      }elseif($FechaMesEvento == '06'){
        $DiaEventoJunio = date("d", strtotime($keyEventsCalendar->fecha_evento));
        $crateEvent = array('dia'=>$DiaEventoJunio, 'id_evento'=>$keyEventsCalendar->id, 'descripcion_evento'=>$keyEventsCalendar->descripcion_evento);
        array_push($arrayEvenJunio, $crateEvent);
      }elseif($FechaMesEvento == '07'){
        $DiaEventoJulio = date("d", strtotime($keyEventsCalendar->fecha_evento));
        $crateEvent = array('dia'=>$DiaEventoJulio, 'id_evento'=>$keyEventsCalendar->id, 'descripcion_evento'=>$keyEventsCalendar->descripcion_evento);
        array_push($arrayEvenJulio, $crateEvent);
      }elseif($FechaMesEvento == '08'){
        $DiaEventoAgosto = date("d", strtotime($keyEventsCalendar->fecha_evento));
        $crateEvent = array('dia'=>$DiaEventoAgosto, 'id_evento'=>$keyEventsCalendar->id, 'descripcion_evento'=>$keyEventsCalendar->descripcion_evento);
        array_push($arrayEvenAgosto, $crateEvent);
      }elseif($FechaMesEvento == '09'){
        $DiaEventoSeptiembre = date("d", strtotime($keyEventsCalendar->fecha_evento));
        $crateEvent = array('dia'=>$DiaEventoSeptiembre, 'id_evento'=>$keyEventsCalendar->id, 'descripcion_evento'=>$keyEventsCalendar->descripcion_evento);
        array_push($arrayEvenSeptiembre, $crateEvent);
      }elseif($FechaMesEvento == '10'){
        $DiaEventoOctubre = date("d", strtotime($keyEventsCalendar->fecha_evento));
        $crateEvent = array('dia'=>$DiaEventoOctubre, 'id_evento'=>$keyEventsCalendar->id, 'descripcion_evento'=>$keyEventsCalendar->descripcion_evento);
        array_push($arrayEvenOctubre, $crateEvent);
      }elseif($FechaMesEvento == '11'){
        $DiaEventoNoviembre = date("d", strtotime($keyEventsCalendar->fecha_evento));
        $crateEvent = array('dia'=>$DiaEventoNoviembre, 'id_evento'=>$keyEventsCalendar->id, 'descripcion_evento'=>$keyEventsCalendar->descripcion_evento);
        array_push($arrayEvenNoviembre, $crateEvent);
      }elseif($FechaMesEvento == '12'){
        $DiaEventoDiciembre = date("d", strtotime($keyEventsCalendar->fecha_evento));
        $crateEvent = array('dia'=>$DiaEventoDiciembre, 'id_evento'=>$keyEventsCalendar->id, 'descripcion_evento'=>$keyEventsCalendar->descripcion_evento);
        array_push($arrayEvenDiciembre, $crateEvent);
      }

    }

    $arrayMothn = array($arrayEvenEnero,$arrayEvenFebrero,$arrayEvenMarzo,$arrayEvenAbril,$arrayEvenMayo,$arrayEvenJunio,$arrayEvenJulio,$arrayEvenAgosto,$arrayEvenSeptiembre,$arrayEvenOctubre,$arrayEvenNoviembre,$arrayEvenDiciembre);
    // dd($arrayMothn);
    return $arrayMothn;

   }

   public function ActivitiesRecientes(){
    $GetActividades = HistorialActividadesRecientes::orderBy('id', 'desc')->paginate(11);
    return $GetActividades;
   }

   public function ActivitiesNotifysRecientes(){
    $GetActividades = HistorialActividadesRecientes::orderBy('id', 'desc')->get();
    return $GetActividades;
   }

   public function GetBackgroundPanelOfUSer()
   {
     #get Color del panel del usuario
       $idUserLogin = Auth::user()->id;
       $Bguser = '';
       $DataUserLogiado = DatosPersonales::where('id_usuario','=', $idUserLogin)->get();
       foreach ($DataUserLogiado as $keyDataUserLogiado) {
         if($keyDataUserLogiado->bg_user != null or $keyDataUserLogiado->bg_user != ''){
           $Bguser = $keyDataUserLogiado->bg_user;
           return $Bguser;
         }else{
           $Bguser ='';
           return $Bguser;
         }
       }

       
   }
    
   public function index()
    {
      $likesPost = LikesPosts::all();
      $EventsDayCalendar = EventosCalendario::all();
      $eventosNOtify = NotificacionesEventos::all();
      $Recordatorios = RecordatoriosAdmin::all();



      #Verifi Cumpleanos de algun empleado
      $UsuariosAll = DatosPersonales::all();
      $AllPost = Post::all();
      $carbon = new \Carbon\Carbon();
      $FechaActual = $carbon->now()->format('m-d');
      $arratGetUserCumple = array();


      foreach ($UsuariosAll as $keyUsuariosAll) {
        
        foreach ($AllPost as $keyAllPost) {
          $GetPostCreado = new \Carbon\Carbon($keyUsuariosAll->created_at); 
          $DatePostCreado = $GetPostCreado->format('m-d');

          if($keyAllPost->id_tipo_publicacion == '5' && $keyAllPost->id_usuario == $keyUsuariosAll->id_usuario && $DatePostCreado == $FechaActual){
            $idUserCumplePublic = $keyUsuariosAll->id_usuario;
            array_push($arratGetUserCumple,$idUserCumplePublic);
          }
        }
        
      }

      foreach ($UsuariosAll as $keyUsuariosAllPub) {
        $GetCUmpleUser = new \Carbon\Carbon($keyUsuariosAllPub->cumpleanos); 
        $DateCumple = $GetCUmpleUser->format('m-d');
        $idUser = $keyUsuariosAllPub->id_usuario;
        if(in_array($idUser, $arratGetUserCumple)){           
        }else{
          if($DateCumple == $FechaActual){
            $idPOst = '5';
            $dataPublicPost = array(
              'descripcion' => 'Te desea Grupo Valdez',
              'id_tipo_publicacion' => $idPOst,
              'id_usuario' => $keyUsuariosAllPub->id_usuario,
            ); 
            $DataStorePosy = new Post($dataPublicPost);  
            $DataStorePosy->save();

            // CREATE ACTIVIDADES
            $usuarioCumpleanos = $keyUsuariosAllPub->id_usuario;
            $idPostPublicado = $DataStorePosy->id;
            $tipoActividad = '14';

            $Usuarios = DatosPersonales::where('id_usuario', '=', $usuarioCumpleanos)->get();

            foreach ($Usuarios as $keyUsuarios) {
              if($usuarioCumpleanos == $keyUsuarios->id_usuario){
                $nameUser = $keyUsuarios->nombre.' '.$keyUsuarios->apellidos;
                $DescriptActiviti = 'Hoy es el cumpleaños de';
              }
              
              $dataPublicActiviti = array(
                'id_usuario' => $usuarioCumpleanos,
                'nonbre_user' => $nameUser,
                'tipo_actividad' => $tipoActividad,
                'id_post' => $idPostPublicado,
                'descripcion_actividad' => $DescriptActiviti,
              );

              $DataStoreActivity = new HistorialActividadesRecientes($dataPublicActiviti);  
              $DataStoreActivity->save();
            }
          }
        }
      }

            
      
      $PostPersonalizados = PostPersonalizados::all();
      $idUserLogin = Auth::user()->id;
      $dataPostD = array();
      $ArrayImgees = '';
      $ArrayDocuemnts = '';



      # Creamos session de idLogiado para chat
      $getCreateOnlineUsers = $this->CreateGetOnlineUser($idUserLogin);

      # get all users online
      $AllOnlineUser = $this->UsersOnline();
      # get all users
      $getUsers = $this->AllUsers();

      # Get posts
      $Posts = $this->GetPost();
      $Likes = $this->getLikesPost();
      $Coments = $this->getComentsPost();
      $DayMothsYear = $this->getDaysMoth();

      # Obteniendo los eventos de cada mes; 
      $EventsCalendar = $this->getCalendar(); 
      $eventsEnero = $EventsCalendar[0];
      $eventsFebrero = $EventsCalendar[1];
      $eventsMarzo = $EventsCalendar[2];      
      $eventsAbril = $EventsCalendar[3];
      $eventsMayo = $EventsCalendar[4];
      $eventsJunio = $EventsCalendar[5];
      $eventsJulio = $EventsCalendar[6];
      $eventsAgosto = $EventsCalendar[7];
      $eventsSeptiembre = $EventsCalendar[8];
      $eventsOctubre = $EventsCalendar[9];
      $eventsNoviembre = $EventsCalendar[10];
      $eventsDiciembre = $EventsCalendar[11];

      $JoinTableUserPosts =  \DB::table('users')
      ->join('datos_personales', 'users.id', '=', 'datos_personales.id_usuario')
      # ->join('datos_empleados', 'users.id', '=', 'datos_empleados.id_usuario')
      ->select('*')
      ->get();

      # Decompiniendo array de post y diviendo en arrays pares e impares
      $DataArrayPostPar = array();
      $DataArrayPostImpar = array();
      $VerifInparPar = 0;
      $CounPost = count($Posts);

      foreach ($Posts as $keyPosts) {
        $ArrayImgees = array();
        $ArrayDocuemnts = array();

        if($keyPosts->imagen != ''){
          $ArrayImgees = explode(",", $keyPosts->imagen);
        }
        if($keyPosts->documentos != ''){
          $ArrayDocuemnts = explode(",", $keyPosts->documentos);
        }

        $dateCreado = new \Carbon\Carbon($keyPosts->created_at); 
        $dateUpdate = new \Carbon\Carbon($keyPosts->created_at); 

        $newArrayDats = array('id' => $keyPosts->id,'descripcion' => $keyPosts->descripcion,'imagen' => $ArrayImgees,'documentos' => $ArrayDocuemnts, 'mime' => $keyPosts->mime, 'id_tipo_publicacion' => $keyPosts->id_tipo_publicacion, 'id_tipo_evento' => $keyPosts->id_tipo_evento, 'descripcion' => $keyPosts->descripcion,'id_usuario' => $keyPosts->id_usuario,'created_at' => $dateCreado->toDateTimeString(),'updated_at' => $dateUpdate->toDateTimeString());
        array_push($dataPostD,$newArrayDats);
      }

      foreach ($dataPostD as $dataPostD) {
        $VerifInparPar = $VerifInparPar+1;
        if($VerifInparPar %2==0){
          array_push($DataArrayPostPar,$dataPostD);
        }else{
          array_push($DataArrayPostImpar,$dataPostD);
        }
      }

      $AllAdps = Adps::all();
      $HistoryAdps = HistorialAdps::all();
      $JoinTableUserDatosPersonalesDatosEmpleado =  \DB::table('datos_personales')
      ->join('datos_empleados', 'datos_personales.id_usuario', '=', 'datos_empleados.id_usuario')
      ->select('datos_personales.nombre','datos_personales.apellidos','datos_personales.foto','datos_personales.mime','datos_personales.id_usuario','datos_empleados.correo_corporativo','datos_empleados.celular','datos_empleados.extencion','datos_empleados.area_departamento')
      ->get();

      $rankingSInApp = $this->rankingSinAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      $RankingGeneral = $rankingSInApp;
      // $rankingWithApp = $this->RankingWithAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      // $RankingGeneral = $rankingWithApp;


      #Get actividades recientes
      $Activities = $this->ActivitiesRecientes();
      $ActivitiesNotifys = $this->ActivitiesNotifysRecientes();
      $NotifisEventos = NotificacionesEventos::all();

      #get Color del panel del usuario
      $Bguser  = $this->GetBackgroundPanelOfUSer();

      #get Foto User login
      $UsersDatasLogin = DatosPersonales::where('id_usuario','=', $idUserLogin)->get();
      $fotoUser = '';
      foreach ($UsersDatasLogin as $keyUsersDatasLogin) {
        $fotoUser =$keyUsersDatasLogin->foto;
        $TypefotoUser =$keyUsersDatasLogin->mime;
      }


      return view('usuarios.home',compact('idUserLogin','AllOnlineUser','Posts','DataArrayPostPar','DataArrayPostImpar','likesPost','JoinTableUserPosts','Likes','Coments','PostPersonalizados','EventsCalendar','eventsEnero','eventsFebrero','eventsMarzo','eventsAbril','eventsMayo','eventsJunio','eventsJulio','eventsAgosto','eventsSeptiembre','eventsOctubre','eventsNoviembre','eventsDiciembre','DayMothsYear','EventsDayCalendar','getUsers','RankingGeneral','JoinTableUserDatosPersonalesDatosEmpleado','eventosNOtify','Activities','NotifisEventos','AllPost','NotifisEventos','ActivitiesNotifys','Recordatorios','Bguser','fotoUser','TypefotoUser'));
    }

    public function rankingSinAppAsesores($GetDataUsers,$ADPS,$HistoryAdps){
      $UsersAlls = DatosPersonales::all();
      $arrayRanking = array();
      $ArrayNotasEvaluaciones = array();
      $ArrayTotalPuntosAdps = array();
      $ArrayPuntosEvaluaciones = array();
      $RankingGeneral = array();
      $puntosObtenidos = 0;
      $puntosObtenidosADP = 0;
      $puntosGenerales = 0;

      $AllEvaluaciones = HistorialEvaluaciones::all();

      #Obteniendo los puntos de todas las evaluaciones de cada usuario
      # y generalizando un total de puntos por usuario
      foreach ($GetDataUsers as $keyDatasUssers) {
        $puntosObtenidos = 0;
        foreach ($AllEvaluaciones as $keyAllEvaluaciones) {
          if($keyDatasUssers->id_usuario == $keyAllEvaluaciones->id_usuario){
            
            $NotaEvaluacion = $keyAllEvaluaciones->total;
            if($NotaEvaluacion <= 5){
              $divideEntre2 = $NotaEvaluacion/2;
              $decimalTotal = round($divideEntre2, 2);
              $ResNumber = '-'.$decimalTotal;
              $ConverNumber = (float)$ResNumber;
              $puntosObtenidos = $puntosObtenidos + (float)$ConverNumber;
            }else{
              $divideEntre2 = $NotaEvaluacion/2;
              $decimalTotal = round($divideEntre2, 2);
              $puntosObtenidos = $puntosObtenidos + $decimalTotal;
            }
          }
        }
        $notasEvaluaciones = array('id_user' => $keyDatasUssers->id_usuario,'puntos' => $puntosObtenidos);
        array_push($ArrayNotasEvaluaciones, $notasEvaluaciones);
      }

      #Obteniendo los puntos de todas las ADPS de cada usuario
      # y generalizando un total de puntos por usuario

      foreach ($GetDataUsers as $keyDatasUssers) {
        $puntosObtenidosADP = 0;
        foreach ($HistoryAdps as $keyAllHistorialAdps) {
          if($keyDatasUssers->id_usuario == $keyAllHistorialAdps->id_usuario){
            foreach ($ADPS as $keyAdps) {
              if($keyAllHistorialAdps->id_adp == $keyAdps->id){
                $RedondearADP = (int)$keyAdps->value_adp;
                $ValorADP = $RedondearADP;
                $puntosObtenidosADP = $puntosObtenidosADP + $ValorADP;
              }
            }
          }
        }
        $TotalPuntosAdps = array('id_user' => $keyDatasUssers->id_usuario,'puntosAdps' => $puntosObtenidosADP);
        array_push($ArrayTotalPuntosAdps, $TotalPuntosAdps);
      }

      foreach ($ArrayTotalPuntosAdps as $keyTotalPuntosAdps => $valueTotalPuntosAdps) {
        $puntosGenerales = 0;
        foreach ($ArrayNotasEvaluaciones as $keyNotasEvaluaciones => $valueNotasEvaluaciones) {
          if($valueTotalPuntosAdps['id_user'] == $valueNotasEvaluaciones['id_user']){
            $puntosGenerales = $valueNotasEvaluaciones['puntos'];
          }
        }
        $puntosGenerales = $puntosGenerales + $valueTotalPuntosAdps['puntosAdps'];
        $puntosRanking = 75 + $puntosGenerales;
        $TotalPuntosGenerales = array('id_user' => $valueTotalPuntosAdps['id_user'],'puntosRanking' => $puntosRanking);
        array_push($RankingGeneral, $TotalPuntosGenerales);
      }
      

      return $RankingGeneral;
    }

    public function RankingWithAppAsesores($GetDataUsers,$ADPS,$HistoryAdps)
    {
      $db_ext = \DB::connection('mysql2');
      $CalificacionesAppATC = $db_ext->table('appac_empleados')->get();

      $UsersAlls = DatosPersonales::all();
      $arrayRanking = array();
      $ArrayNotasEvaluaciones = array();
      $ArrayNotasEvaluacionesApp = array();
      $ArrayTotalPuntosAdps = array();
      $ArrayPuntosEvaluaciones = array();
      $RankingGeneral = array();
      $puntosObtenidos = 0;
      $puntosObtenidosApp = 0;
      $puntosObtenidosADP = 0;
      $puntosGenerales = 0;

      $AllEvaluaciones = HistorialEvaluaciones::all();

      #Obteniendo los puntos de todas las evaluaciones de cada usuario
      # y generalizando un total de puntos por usuario
      foreach ($GetDataUsers as $keyDatasUssers) {
        $puntosObtenidos = 0;
        foreach ($AllEvaluaciones as $keyAllEvaluaciones) {
          if($keyDatasUssers->id_usuario == $keyAllEvaluaciones->id_usuario){
            
            $NotaEvaluacion = $keyAllEvaluaciones->total;
            if($NotaEvaluacion <= 5){
              $divideEntre2 = $NotaEvaluacion/2;
              $decimalTotal = round($divideEntre2, 2);
              $ResNumber = '-'.$decimalTotal;
              $ConverNumber = (float)$ResNumber;
              $puntosObtenidos = $puntosObtenidos + (float)$ConverNumber;
            }else{
              $divideEntre2 = $NotaEvaluacion/2;
              $decimalTotal = round($divideEntre2, 2);
              $puntosObtenidos = $puntosObtenidos + $decimalTotal;
            }
          }
        }
        $notasEvaluaciones = array('id_user' => $keyDatasUssers->id_usuario,'puntos' => $puntosObtenidos);
        array_push($ArrayNotasEvaluaciones, $notasEvaluaciones);
      }

      #Obteniendo los puntos de todas las ADPS de cada usuario
      # y generalizando un total de puntos por usuario

      foreach ($GetDataUsers as $keyDatasUssers) {
        $puntosObtenidosADP = 0;
        foreach ($HistoryAdps as $keyAllHistorialAdps) {
          if($keyDatasUssers->id_usuario == $keyAllHistorialAdps->id_usuario){
            foreach ($ADPS as $keyAdps) {
              if($keyAllHistorialAdps->id_adp == $keyAdps->id){
                $RedondearADP = (int)$keyAdps->value_adp;
                $ValorADP = $RedondearADP;
                $puntosObtenidosADP = $puntosObtenidosADP + $ValorADP;
              }
            }
          }
        }
        $TotalPuntosAdps = array('id_user' => $keyDatasUssers->id_usuario,'puntosAdps' => $puntosObtenidosADP);
        array_push($ArrayTotalPuntosAdps, $TotalPuntosAdps);
      }

      #Obteniendo los puntos de todas las evaluaciones de cada usuario relizadas EN LA APP 
      #DE ATENCION AL CLIENTE
      # y generalizando un total de puntos por usuario
      foreach ($GetDataUsers as $keyDatasUssers) {
        $puntosObtenidosApp = 0;
        foreach ($CalificacionesAppATC as $keyCalificacionesAppATC) {
          $nameEMpleado = $keyDatasUssers->nombre.' '.$keyDatasUssers->apellidos;
          if($nameEMpleado == $keyCalificacionesAppATC->nombre_empleado){
          
            // dd($keyDatasUssers->id_usuario);
            // Pregunta ATencion
            $atencion = $keyCalificacionesAppATC->calificacion_atencion;
            if($atencion == 4){
              $atencion = 10;
            }elseif($atencion == 3){
              $atencion = 7.5;
            }elseif($atencion == 2){
              $atencion = 5;
            }elseif($atencion == 1){
              $atencion = 2.5;
            }
            // Pregunta Informacion
            $informacion = $keyCalificacionesAppATC->calificacion_informacion;
            if($informacion == 4){
              $informacion = 10;
            }elseif($informacion == 3){
              $informacion = 7.5;
            }elseif($informacion == 2){
              $informacion = 5;
            }elseif($informacion == 1){
              $informacion = 2.5;
            }

            // Pregunta presentacion
            $presentacion = $keyCalificacionesAppATC->calificacion_presentacion;
            if($presentacion == 4){
              $presentacion = 10;
            }elseif($presentacion == 3){
              $presentacion = 7.5;
            }elseif($presentacion == 2){
              $presentacion = 5;
            }elseif($presentacion == 1){
              $presentacion = 2.5;
            }

            // Pregunta empatia
            $empatia = $keyCalificacionesAppATC->enpatia_interes;
            if($empatia == 4){
              $empatia = 10;
            }elseif($empatia == 3){
              $empatia = 7.5;
            }elseif($empatia == 2){
              $empatia = 5;
            }elseif($empatia == 1){
              $empatia = 2.5;
            }


            $PromedioDePreguntas = ($atencion + $informacion + $presentacion + $empatia)/4;
            $NotaEvaluacionApp = $PromedioDePreguntas;
            if($NotaEvaluacionApp <= 5){
              $ValorEncuesta = -1;
              $puntosObtenidosApp = $puntosObtenidosApp + $ValorEncuesta;
            }else{
              $ValorEncuesta = 1;
              $puntosObtenidosApp = $puntosObtenidosApp + $ValorEncuesta;
            }
          }
        }
        $notasEvaluacionesApp = array('id_user' => $keyDatasUssers->id_usuario,'puntosApp' => $puntosObtenidosApp);
        array_push($ArrayNotasEvaluacionesApp, $notasEvaluacionesApp);
      }

      foreach ($GetDataUsers as $keyDatasUssers) {
        
        foreach ($ArrayTotalPuntosAdps as $keyTotalPuntosAdps => $valueTotalPuntosAdps) {
          if($keyDatasUssers->id_usuario == $valueTotalPuntosAdps['id_user']){
            $puntosGenerales = 0;
            foreach ($ArrayNotasEvaluaciones as $keyNotasEvaluaciones => $valueNotasEvaluaciones) {
              if($valueTotalPuntosAdps['id_user'] == $valueNotasEvaluaciones['id_user']){
                $puntosGenerales = $puntosGenerales + $valueNotasEvaluaciones['puntos'];
              }
            }
            foreach ($ArrayNotasEvaluacionesApp as $keyNotasEvaluacionesApp => $valueNotasEvaluacionesApp) {
              if($valueTotalPuntosAdps['id_user'] == $valueNotasEvaluacionesApp['id_user']){
                $puntosGenerales = $puntosGenerales +  $valueNotasEvaluacionesApp['puntosApp'];
              }
            }
            #Verificamos si el Usuarios pertenece a algunas de las siguientes categorias
            #Si pertenece significa que es parte de area de ventas por lo cual
            # se califica de manera diferente
            if($keyDatasUssers->area_departamento == 'Ventas Valdez Mobile Merliot' 
              or $keyDatasUssers->area_departamento == 'Ventas Valdez Mobile Escalón' 
              or $keyDatasUssers->area_departamento == 'Ventas Valdez Mobile San Miguel' 
              or $keyDatasUssers->area_departamento == 'Ventas Laptops Valdez Merliot' 
              or $keyDatasUssers->area_departamento == 'Ventas Laptops Valdez Escalon' 
              or $keyDatasUssers->area_departamento == 'Gerencia Ventas' 
              or $keyDatasUssers->area_departamento == 'Supervisor Merliot VM' 
              or $keyDatasUssers->area_departamento == 'Supervisor Escalón VM' 
              or $keyDatasUssers->area_departamento == 'Supervisor San Miguel VM' 
              or $keyDatasUssers->area_departamento == 'Supervisor San Miguel LV' 
              or $keyDatasUssers->area_departamento == 'Supervisor Merliot LV' 
              or $keyDatasUssers->area_departamento == 'Supervisor Escalón LV' )
            {
              $puntosGenerales = $puntosGenerales + $valueTotalPuntosAdps['puntosAdps'];
              $puntosRanking = 150 + $puntosGenerales;
            }else{
              $puntosGenerales = $puntosGenerales + $valueTotalPuntosAdps['puntosAdps'];
              $puntosRanking = 75 + $puntosGenerales;
            }
            
            $TotalPuntosGenerales = array('id_user' => $valueTotalPuntosAdps['id_user'],'puntosRanking' => $puntosRanking);
            array_push($RankingGeneral, $TotalPuntosGenerales);
          }
        }
      }
    
      return $RankingGeneral;
    }

    public function DataLogout(Request $request){

      if($request->ajax()) {
        $id_GetLogout = $request->idlogin;
        $ofLine = GetOnline::where('id_user_login','=',$id_GetLogout)->delete();
        echo json_encode($ofLine);
      }

    }

    public function logOut(Request $request){

      $idUserLogin = Auth::user()->id;
      $ofLineLOgout = GetOnline::where('id_user_login','=',$idUserLogin)->delete();
      Auth::logout();
      
      return redirect('/login');

    }

    public function profile()
    {
      $idUserLogin = Auth::user()->id;
      $EventsDayCalendar = EventosCalendario::all();
      $HorariosUser = Horarios::all();
      $UsersAlls = User::all();
      $Solicitudes = DetallesSolicitudes::where('id_usuario','=',$idUserLogin)->get();
      
      $eventosNOtify = NotificacionesEventos::all();

      #Verifi Cumpleanos de algun empleado
      $UsuariosAll = DatosPersonales::all();
      $AllPost = Post::all();
      $carbon = new \Carbon\Carbon();
      $FechaActual = $carbon->now()->format('m-d');
      $arratGetUserCumple = array();

      # Creamos session de idLogiado para chat
      $getCreateOnlineUsers = $this->CreateGetOnlineUser($idUserLogin);

      $PostPersonalizados = PostPersonalizados::all();
      $dataPostD = array();
      $ArrayImgees = '';
      $ArrayDocuemnts = '';

      # get all users online
      $AllOnlineUser = $this->UsersOnline();
      # get all users
      $getUsers = $this->AllUsers();

      $DayMothsYear = $this->getDaysMoth();

      # Obteniendo los eventos de cada mes; 
      $EventsCalendar = $this->getCalendar(); 
      $eventsEnero = $EventsCalendar[0];
      $eventsFebrero = $EventsCalendar[1];
      $eventsMarzo = $EventsCalendar[2];      
      $eventsAbril = $EventsCalendar[3];
      $eventsMayo = $EventsCalendar[4];
      $eventsJunio = $EventsCalendar[5];
      $eventsJulio = $EventsCalendar[6];
      $eventsAgosto = $EventsCalendar[7];
      $eventsSeptiembre = $EventsCalendar[8];
      $eventsOctubre = $EventsCalendar[9];
      $eventsNoviembre = $EventsCalendar[10];
      $eventsDiciembre = $EventsCalendar[11];

      $JoinTableUserDatas =  \DB::table('users')
      ->join('datos_personales', 'users.id', '=', 'datos_personales.id_usuario')
      ->join('datos_empleados', 'users.id', '=', 'datos_empleados.id_usuario')
      ->join('formacion_acedemica', 'users.id', '=', 'formacion_acedemica.id_usuario')
      ->select('*')
      ->get();


      # Get posts
      $Posts = $this->GetPost();
      $Likes = $this->getLikesPost();
      $Coments = $this->getComentsPost();
      $DayMothsYear = $this->getDaysMoth();

      $JoinTableUserPosts =  \DB::table('users')
      ->join('datos_personales', 'users.id', '=', 'datos_personales.id_usuario')
      # ->join('datos_empleados', 'users.id', '=', 'datos_empleados.id_usuario')
      ->select('*')
      ->get();

      # Decompiniendo array de post y diviendo en arrays pares e impares
      $dataPostD = array();
      $DataArrayPostPar = array();
      $DataArrayPostImpar = array();
      $VerifInparPar = 0;
      $CounPost = count($Posts);
      $arrayOfImages = array();

      foreach ($Posts as $keyPosts) {
        $ArrayImgees = '';
        $ArrayDocuemnts = '';

        if($keyPosts->imagen != ''){
          $ArrayImgees = explode(",", $keyPosts->imagen);
        }
        if($keyPosts->documentos != ''){
          $ArrayDocuemnts = explode(",", $keyPosts->documentos);
        }

        $dateCreado = new \Carbon\Carbon($keyPosts->created_at); 
        $dateUpdate = new \Carbon\Carbon($keyPosts->created_at); 

        $newArrayDats = array('id' => $keyPosts->id,'descripcion' => $keyPosts->descripcion,'imagen' => $ArrayImgees, 'mime' => $keyPosts->mime,'documentos' => $ArrayDocuemnts, 'id_tipo_publicacion' => $keyPosts->id_tipo_publicacion, 'id_tipo_evento' => $keyPosts->id_tipo_evento,'id_usuario' => $keyPosts->id_usuario,'created_at' => $dateCreado->toDateTimeString(),'updated_at' => $dateUpdate->toDateTimeString());
        array_push($dataPostD,$newArrayDats);
      }

      foreach ($dataPostD as $dataPostD) {
        $VerifInparPar = $VerifInparPar+1;
        if($VerifInparPar %2==0){
          array_push($DataArrayPostPar,$dataPostD);
        }else{
          array_push($DataArrayPostImpar,$dataPostD);
        }
      }

      # Decompiniendo array de post para obtener galeria de fotos que el usuario a publicado
      foreach ($Posts as $keyPostsImages) {
        if($keyPostsImages->id_usuario == $idUserLogin){
          if($keyPostsImages->imagen != ''){
            $ArrayImgeesGaleri = '';
            $ArrayImgeesGaleri = explode(",", $keyPostsImages->imagen);
            $dataImaeAray = array('imagesGalery'=>  $ArrayImgeesGaleri,'imagesGaleryType'=>  $keyPostsImages->mime);
            array_push($arrayOfImages,$dataImaeAray);
          }
        }
        
      }

      $arrayDaysDescansoUser = array();
      foreach ($HorariosUser as $keyHorariosUser) {
        if($keyHorariosUser->id_usuario == $idUserLogin){
          if($keyHorariosUser->bloq_horarioMedio1 != null){
            $diasDescanso = explode(", ", $keyHorariosUser->bloq_horarioMedio1);
            array_push($arrayDaysDescansoUser, $diasDescanso);
          }
          if($keyHorariosUser->bloq_horarioMedio2 != null){
            $diasDescanso2 = explode(", ", $keyHorariosUser->bloq_horarioMedio2);
            array_push($arrayDaysDescansoUser, $diasDescanso2);
          }
          if($keyHorariosUser->bloq_horarioMedio3 != null){
            $diasDescanso3 = explode(", ", $keyHorariosUser->bloq_horarioMedio3);
            array_push($arrayDaysDescansoUser, $diasDescanso3);
          }
        }
       
      }

      $DataDias = $this->DaysVacaciones();
      $PrimerNumerDay = $DataDias[0];
      $SegundoNumerDay = $DataDias[1];

      // RANKING
      $AllAdps = Adps::all();
      $HistoryAdps = HistorialAdps::all();
      $JoinTableUserDatosPersonalesDatosEmpleado =  \DB::table('datos_personales')
      ->join('datos_empleados', 'datos_personales.id_usuario', '=', 'datos_empleados.id_usuario')
      ->select('datos_personales.nombre','datos_personales.apellidos','datos_personales.foto','datos_personales.mime','datos_personales.estado','datos_personales.id_usuario','datos_empleados.correo_corporativo','datos_empleados.celular','datos_empleados.extencion','datos_empleados.area_departamento')
      ->get();

      $rankingSInApp = $this->rankingSinAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      $RankingGeneral = $rankingSInApp;
      // $rankingWithApp = $this->RankingWithAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      // $RankingGeneral = $rankingWithApp;

      #get Notificaciones y actividades
      $AllPost = Post::all();
      $Activities = $this->ActivitiesRecientes();
      $ActivitiesNotifys = $this->ActivitiesNotifysRecientes();
      $NotifisEventos = NotificacionesEventos::all();

      #get Color del panel del usuario
      $Bguser  = $this->GetBackgroundPanelOfUSer();

      #get Foto User login
      $UsersDatasLogin = DatosPersonales::where('id_usuario','=', $idUserLogin)->get();
      $fotoUser = '';
      foreach ($UsersDatasLogin as $keyUsersDatasLogin) {
        $fotoUser =$keyUsersDatasLogin->foto;
        $TypefotoUser =$keyUsersDatasLogin->mime;
      }

      // dd($arrayOfImages);

      return view('usuarios.profile',compact('idUserLogin','AllOnlineUser','EventsDayCalendar','getCreateOnlineUsers','AllOnlineUser','getUsers','DayMothsYear','EventsCalendar','eventsEnero','eventsFebrero','eventsMarzo','eventsAbril','eventsMayo','eventsJunio','eventsJulio','eventsAgosto','eventsSeptiembre','eventsOctubre','eventsNoviembre','eventsDiciembre','JoinTableUserDatas','UsersAlls','Posts','Likes','Coments','DayMothsYear','JoinTableUserPosts','DataArrayPostPar','DataArrayPostImpar','dataPostD','arrayOfImages','HorariosUser','arrayDaysDescansoUser','Solicitudes','PrimerNumerDay','SegundoNumerDay','JoinTableUserDatosPersonalesDatosEmpleado','RankingGeneral','eventosNOtify','AllPost','Activities','NotifisEventos','AllPost','ActivitiesNotifys','Bguser','fotoUser','TypefotoUser'));
    }

    public function updateProfileUser(Request $request){
      if($request->ajax()){
        # get Datas upate profile
        $data = facedesrequest::all();
        $idUserWantUpdate = $request->id_user_update;
        $UpdateDepartamento = $request->update_departament;
        $UpdateGenero = $request->update_genero;
        $UpdateEstadoCivil = $request->update_estado_civil;
        $UpdateDireccion = $request->update_direccion;
        $UpdateCumple = $request->update_cumple;
        $UpdateCel = $request->update_cel;
        $UpdateExt = $request->update_ext;
        $UpdateTec = $request->update_tecnico;
        $UpdatePosgrado= $request->update_posgrado;
        $UpdateDiplomado= $request->update_diplomado;
        $UpdateHabilidades= $request->update_hibilidades;
        $UpdateOtherConocimeintos= $request->update_other_conocimientos;

        # Agrupo los datos que pertencen a la tabla datos personales y actualizo
        $dataUpdateProfileDataPersonales = array(
          'departamento' => $UpdateDepartamento,
          'genero' => $UpdateGenero,
          'estado_civil' => $UpdateEstadoCivil,
          'direccion' => $UpdateDireccion,
          'cumpleanos' => $UpdateCumple,
        );

        $UpdateDatosPersonales= \DB::table('datos_personales')
          ->where('id_usuario', '=', $idUserWantUpdate)
          ->update($dataUpdateProfileDataPersonales);

        # Agrupo los datos que pertencen a la tabla datos empleado y actualizo
        $dataUpdateProfileDataEmpleados = array(
          'celular' => $UpdateCel,
          'extencion' => $UpdateExt,
        );

        $UpdateDatosEmpleados= \DB::table('datos_empleados')
          ->where('id_usuario', '=', $idUserWantUpdate)
          ->update($dataUpdateProfileDataEmpleados);
      
        # Agrupo los datos que pertencen a la tabla datos formacion acdemica y actualizo
        $dataUpdateProfileFomacionAcademy = array(
          'tecnico' => $UpdateTec,
          'postgrado' => $UpdatePosgrado,
          'diplomado' => $UpdateDiplomado,
          'habilidades' => $UpdateHabilidades,
          'other_conocimiento' => $UpdateOtherConocimeintos,
        );

        $UpdateDatosFormacionAcademy = \DB::table('formacion_acedemica')
          ->where('id_usuario', '=', $idUserWantUpdate)
          ->update($dataUpdateProfileFomacionAcademy);


        // CREATE ACTIVIDADES
        $usuarioPublic = $idUserWantUpdate;
        $idPostPublicado = '0';
        $tipoActividad = '10';
        $IdEvenCalendar = '0';

        $Usuarios = DatosPersonales::where('id_usuario', '=', $usuarioPublic)->get();

        foreach ($Usuarios as $keyUsuarios) {
          if($usuarioPublic == $keyUsuarios->id_usuario){
            $nameUser = $keyUsuarios->nombre.' '.$keyUsuarios->apellidos;
            $DescriptActiviti = 'actualizó su perfil';
          }
          
          $dataPublicActiviti = array(
            'id_usuario' => $usuarioPublic,
            'nonbre_user' => $nameUser,
            'tipo_actividad' => $tipoActividad,
            'id_post' => $idPostPublicado,
            'id_event_calendar' => $IdEvenCalendar,
            'descripcion_actividad' => $DescriptActiviti,
          );

          $DataStoreActivity = new HistorialActividadesRecientes($dataPublicActiviti);  
          $DataStoreActivity->save();
        }

        echo json_encode('Almacenado');

      }
    }

    public function profileOfUser($id)
    {

      $EventsDayCalendar = EventosCalendario::all();
      $HorariosUser = Horarios::all();
      $UsersAlls = User::all();
      $eventosNOtify = NotificacionesEventos::all();
      
      $idUserLogin = $id;

      # Creamos session de idLogiado para chat
      $getCreateOnlineUsers = $this->CreateGetOnlineUser($idUserLogin);

      $PostPersonalizados = PostPersonalizados::all();
      $dataPostD = array();
      $ArrayImgees = '';
      $ArrayDocuemnts = '';
      # get all users online
      $AllOnlineUser = $this->UsersOnline();
      # get all users
      $getUsers = $this->AllUsers();

      $DayMothsYear = $this->getDaysMoth();

      # Obteniendo los eventos de cada mes; 
      $EventsCalendar = $this->getCalendar(); 
      $eventsEnero = $EventsCalendar[0];
      $eventsFebrero = $EventsCalendar[1];
      $eventsMarzo = $EventsCalendar[2];      
      $eventsAbril = $EventsCalendar[3];
      $eventsMayo = $EventsCalendar[4];
      $eventsJunio = $EventsCalendar[5];
      $eventsJulio = $EventsCalendar[6];
      $eventsAgosto = $EventsCalendar[7];
      $eventsSeptiembre = $EventsCalendar[8];
      $eventsOctubre = $EventsCalendar[9];
      $eventsNoviembre = $EventsCalendar[10];
      $eventsDiciembre = $EventsCalendar[11];

      $JoinTableUserDatas =  \DB::table('users')
      ->join('datos_personales', 'users.id', '=', 'datos_personales.id_usuario')
      ->join('datos_empleados', 'users.id', '=', 'datos_empleados.id_usuario')
      ->join('formacion_acedemica', 'users.id', '=', 'formacion_acedemica.id_usuario')
      ->select('*')
      ->get();


      # Get posts
      $Posts = $this->GetPost();
      $Likes = $this->getLikesPost();
      $Coments = $this->getComentsPost();
      $DayMothsYear = $this->getDaysMoth();

      $JoinTableUserPosts =  \DB::table('users')
      ->join('datos_personales', 'users.id', '=', 'datos_personales.id_usuario')
      # ->join('datos_empleados', 'users.id', '=', 'datos_empleados.id_usuario')
      ->select('*')
      ->get();

      # Decompiniendo array de post y diviendo en arrays pares e impares
      $dataPostD = array();
      $DataArrayPostPar = array();
      $DataArrayPostImpar = array();
      $VerifInparPar = 0;
      $CounPost = count($Posts);
      $arrayOfImages = array();

      foreach ($Posts as $keyPosts) {
        $ArrayImgees = '';
        $ArrayDocuemnts = '';

        if($keyPosts->imagen != ''){
          $ArrayImgees = explode(",", $keyPosts->imagen);
        }
        if($keyPosts->documentos != ''){
          $ArrayDocuemnts = explode(",", $keyPosts->documentos);
        }

        $dateCreado = new \Carbon\Carbon($keyPosts->created_at); 
        $dateUpdate = new \Carbon\Carbon($keyPosts->created_at); 

        $newArrayDats = array('id' => $keyPosts->id,'descripcion' => $keyPosts->descripcion,'imagen' => $ArrayImgees, 'mime' => $keyPosts->mime,'documentos' => $ArrayDocuemnts, 'id_tipo_publicacion' => $keyPosts->id_tipo_publicacion, 'id_tipo_evento' => $keyPosts->id_tipo_evento,'id_usuario' => $keyPosts->id_usuario,'created_at' => $dateCreado->toDateTimeString(),'updated_at' => $dateUpdate->toDateTimeString());
        array_push($dataPostD,$newArrayDats);
      }

      foreach ($dataPostD as $dataPostD) {
        $VerifInparPar = $VerifInparPar+1;
        if($VerifInparPar %2==0){
          array_push($DataArrayPostPar,$dataPostD);
        }else{
          array_push($DataArrayPostImpar,$dataPostD);
        }
      }

      # Decompiniendo array de post para obtener galeria de fotos que el usuario a publicado
      foreach ($Posts as $keyPostsImages) {
        if($keyPostsImages->id_usuario == $idUserLogin){
          if($keyPostsImages->imagen != ''){
            $ArrayImgeesGaleri = '';
            $ArrayImgeesGaleri = explode(",", $keyPostsImages->imagen);
            $dataImaeAray = array('imagesGalery'=>  $ArrayImgeesGaleri,'imagesGaleryType'=>  $keyPostsImages->mime);
            array_push($arrayOfImages,$dataImaeAray);
          }
        }
        
      }

      $arrayDaysDescansoUser = array();
      foreach ($HorariosUser as $keyHorariosUser) {
        if($keyHorariosUser->id_usuario == $idUserLogin){
          if($keyHorariosUser->bloq_horarioMedio1 != null){
            $diasDescanso = explode(", ", $keyHorariosUser->bloq_horarioMedio1);
            array_push($arrayDaysDescansoUser, $diasDescanso);
          }
          if($keyHorariosUser->bloq_horarioMedio2 != null){
            $diasDescanso2 = explode(", ", $keyHorariosUser->bloq_horarioMedio2);
            array_push($arrayDaysDescansoUser, $diasDescanso2);
          }
          if($keyHorariosUser->bloq_horarioMedio3 != null){
            $diasDescanso3 = explode(", ", $keyHorariosUser->bloq_horarioMedio3);
            array_push($arrayDaysDescansoUser, $diasDescanso3);
          }
        }
       
      }

      // RANKING
      $AllAdps = Adps::all();
      $HistoryAdps = HistorialAdps::all();
      $JoinTableUserDatosPersonalesDatosEmpleado =  \DB::table('datos_personales')
      ->join('datos_empleados', 'datos_personales.id_usuario', '=', 'datos_empleados.id_usuario')
      ->select('datos_personales.nombre','datos_personales.apellidos','datos_personales.foto','datos_personales.estado','datos_personales.id_usuario','datos_empleados.correo_corporativo','datos_empleados.celular','datos_empleados.extencion','datos_empleados.area_departamento')
      ->get();

      $rankingSInApp = $this->rankingSinAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      $RankingGeneral = $rankingSInApp;
      // $rankingWithApp = $this->RankingWithAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      // $RankingGeneral = $rankingWithApp;

      #get Notificaciones y actividades
      $AllPost = Post::all();
      $Activities = $this->ActivitiesRecientes();
      $ActivitiesNotifys = $this->ActivitiesNotifysRecientes();
      $NotifisEventos = NotificacionesEventos::all();

      #get Color del panel del usuario d
      $Bguser  = $this->GetBackgroundPanelOfUSer();

      #get Foto User login
      $UsersDatasLogin = DatosPersonales::where('id_usuario','=', $idUserLogin)->get();
      $fotoUser = '';
      foreach ($UsersDatasLogin as $keyUsersDatasLogin) {
        $fotoUser =$keyUsersDatasLogin->foto;
        $TypefotoUser =$keyUsersDatasLogin->mime;
      }

      return view('usuarios.profile-of-user',compact('idUserLogin','AllOnlineUser','EventsDayCalendar','getCreateOnlineUsers','AllOnlineUser','getUsers','DayMothsYear','EventsCalendar','eventsEnero','eventsFebrero','eventsMarzo','eventsAbril','eventsMayo','eventsJunio','eventsJulio','eventsAgosto','eventsSeptiembre','eventsOctubre','eventsNoviembre','eventsDiciembre','JoinTableUserDatas','UsersAlls','Posts','Likes','Coments','DayMothsYear','JoinTableUserPosts','DataArrayPostPar','DataArrayPostImpar','dataPostD','arrayOfImages','HorariosUser','arrayDaysDescansoUser','JoinTableUserDatosPersonalesDatosEmpleado','RankingGeneral','eventosNOtify','Activities','NotifisEventos','AllPost','ActivitiesNotifys','Bguser','fotoUser','TypefotoUser'));
    }

    public function RankingEmpleados()
    {
      $idUserLogin = Auth::user()->id;
      // Creamos session de idLogiado para chat
      $getCreateOnlineUsers = $this->CreateGetOnlineUser($idUserLogin);
      # get all users online
      $AllOnlineUser = $this->UsersOnline();
      # get all users
      $getUsers = $this->AllUsers();

      $AllAdps = Adps::all();
      $HistoryAdps = HistorialAdps::all();
      $JoinTableUserDatosPersonalesDatosEmpleado =  \DB::table('datos_personales')
      ->join('datos_empleados', 'datos_personales.id_usuario', '=', 'datos_empleados.id_usuario')
      ->select('datos_personales.nombre','datos_personales.apellidos','datos_personales.foto','datos_personales.mime','datos_personales.id_usuario','datos_empleados.correo_corporativo','datos_empleados.celular','datos_empleados.extencion','datos_empleados.area_departamento')
      ->get();

      $rankingSInApp = $this->rankingSinAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      $RankingGeneral = $rankingSInApp;
      // $rankingWithApp = $this->RankingWithAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      // $RankingGeneral = $rankingWithApp;

      #Get El usuario con mejor Ranking
      $idMejorRanking = '';
      $NotaMejorRanking = '';
      $UserMejorRanking ='';

      foreach ($RankingGeneral as $keyRankingGeneral => $valueRankingGeneral) {
        if($valueRankingGeneral['puntosRanking'] > $NotaMejorRanking){
          $NotaMejorRanking = $valueRankingGeneral['puntosRanking'];
          $idMejorRanking = $valueRankingGeneral['id_user'];
          $UserMejorRanking = array('id_user' => $valueRankingGeneral['id_user'],'puntos' => $valueRankingGeneral['puntosRanking']);
        }
      }

      #get Notificaciones y actividades
      $AllPost = Post::all();
      $Activities = $this->ActivitiesRecientes();
      $ActivitiesNotifys = $this->ActivitiesNotifysRecientes();
      $NotifisEventos = NotificacionesEventos::all();

      #get Color del panel del usuario d
      $Bguser  = $this->GetBackgroundPanelOfUSer();

      #get Foto User login
      $UsersDatasLogin = DatosPersonales::where('id_usuario','=', $idUserLogin)->get();
      $fotoUser = '';
      foreach ($UsersDatasLogin as $keyUsersDatasLogin) {
        $fotoUser =$keyUsersDatasLogin->foto;
        $TypefotoUser =$keyUsersDatasLogin->mime;
      }

      return view('usuarios.ranking-empleados',compact('idUserLogin','AllOnlineUser','UserMejorRanking','JoinTableUserDatosPersonalesDatosEmpleado','RankingGeneral','idMejorRanking','AllOnlineUser','getUsers','Activities','NotifisEventos','AllPost','ActivitiesNotifys','Bguser','fotoUser','TypefotoUser'));
    }

    public function ChatEmpleados()
    {
      
      $idUserLogin = Auth::user()->id;
      // Creamos session de idLogiado para chat
      $getCreateOnlineUsers = $this->CreateGetOnlineUser($idUserLogin);
      //get all users online
      $AllOnlineUser = $this->UsersOnline();
      $AllPost = Post::all();

      // $ChatWithUsers = User::all();
      $getUsers = $this->AllUsers();
      $idUserLogin = Auth::user()->id;
      $arrayChat = array();

      $UsersWihtChat = User::all();
      $chat = Chats::where('id_user','=',$idUserLogin)->get();        
      $idUserLogin = Auth::user()->id;
      $grpupChat = array();

      $ConversationBetwwenUser = Chats::where('id_user','=',$idUserLogin)->get();
      $ConversationBetwwenUser2 = Chats::where('id_user_conversation','=',$idUserLogin)->get();

      foreach ($UsersWihtChat as $keyUsersWihtChat) {
          $id_ForChat = '';
          $getMensages = '';
          $id_ForChat = $keyUsersWihtChat->id;
          $bande =0;
          $bande2 =0;
          $arrayCOnversation = array();
          $arrayFechas = array();
          $arrayMensages = array();
          $arrayMensagesFechas = array();
          $arrayGetDates = array();
          $arrayVerifiFechas = array();
          $newGruopMensages = array();
          $bande = 0;

          $arrayCOnversation2 = array();
          $arrayFechas2 = array();
          $arrayMensages2 = array();
          $arrayMensagesFechas2 = array();
          $arrayGetDates2 = array();
          $arrayVerifiFechas2 = array();
          $newGruopMensages2 = array();
          
          $bande2 = 0;

           // echo '<pre>';print_r('entro');echo '<pre>';

          foreach ($ConversationBetwwenUser as $keyConversationBetwwenUser) {
            if($keyConversationBetwwenUser->id_user_conversation == $id_ForChat){
                /*Convertimos fechas*/
                $date = new \Carbon\Carbon($keyConversationBetwwenUser->created_at);                    
                $Fechas = $date->format('d-m-Y');
                $time = $date->format('H:i:s');
                /*Creamos primer array para iniciar*/
                if($bande == 0){
                  /*Guardamos el mensaje en el array*/
                  $getMensages = $keyConversationBetwwenUser->conversations;
                  array_push($arrayMensages,$getMensages);
                  /*Guardamos la fechas en el array*/
                  $getDates = $Fechas;
                  array_push($arrayGetDates,$getDates);
                  /*Creamos nuestro bloque de fecha y mensajes enviados*/
                  $newFechaConversation = array('fecha_conver' => $Fechas,'time_send' => $time,'id' => $keyConversationBetwwenUser->id,'id_user' => $keyConversationBetwwenUser->id_user,'id_user_conversation' => $keyConversationBetwwenUser->id_user_conversation,'userSend' => 1,'userReceive' => 0,'mensages' => $arrayMensages);
                  array_push($arrayMensagesFechas,$newFechaConversation);
                  $bande = $bande+1;
                }elseif($bande == 1) {     
                  /*** 
                  Busca dentro del array de fechas, si dentro del array de fechas, la fecha que viene esta 
                  repetida entonces, entonces vas a agrupar le mensaje dentro del bloque de fecha existente
                  ***/
                  if(in_array($Fechas, $arrayGetDates)){     
                      foreach ($arrayMensagesFechas as $keyarrayMensagesFechas => $value) {
                          /* Si del array de mensajes y fechas la fecha es igual, entonces  descomponeme el array*/
                         if($value['fecha_conver'] == $Fechas){
                            $newGruopMensages = array();
                            $positionOfArray =$keyarrayMensagesFechas;
                            $mensagesAnterior = $value['mensages'];
                            foreach ($mensagesAnterior as $keymensagesAnterior) {
                                array_push($newGruopMensages,$keymensagesAnterior);
                            }
                            $getMensages = $keyConversationBetwwenUser->conversations;
                            array_push($newGruopMensages,$getMensages);
                            unset($arrayMensagesFechas[$positionOfArray]);
                            $newFechaConversation = array('fecha_conver' => $Fechas,'time_send' => $time,'id' => $keyConversationBetwwenUser->id,'id_user' => $keyConversationBetwwenUser->id_user,'id_user_conversation' => $keyConversationBetwwenUser->id_user_conversation,'userSend' => 1,'userReceive' => 0,'mensages' => $newGruopMensages);
                            array_push($arrayMensagesFechas,$newFechaConversation);
                         }
                      }
                  }else{
                      $arrayMensages = array();
                      $getMensages = $keyConversationBetwwenUser->conversations;
                      array_push($arrayMensages,$getMensages);
                      $getDates = $Fechas;
                      array_push($arrayGetDates,$getDates);
                      $newFechaConversation = array('fecha_conver' => $Fechas,'time_send' => $time,'id' => $keyConversationBetwwenUser->id,'id_user' => $keyConversationBetwwenUser->id_user,'id_user_conversation' => $keyConversationBetwwenUser->id_user_conversation,'userSend' => 1,'userReceive' => 0,'mensages' => $arrayMensages);
                      array_push($arrayMensagesFechas,$newFechaConversation);
                  }                                 
                }
            }
          }

          foreach ($ConversationBetwwenUser2 as $keyConversationBetwwenUser2) {
            if($keyConversationBetwwenUser2->id_user == $id_ForChat){
              /*Convertimos fechas*/
              $date2 = new \Carbon\Carbon($keyConversationBetwwenUser2->created_at);                    
              $Fechas2 = $date2->format('d-m-Y');
              $time2 = $date2->format('H:i:s');
              /*Creamos primer array para iniciar*/
              if($bande2 == 0){
                /*Guardamos el mensaje en el array*/
                $getMensages2 = $keyConversationBetwwenUser2->conversations;
                array_push($arrayMensages2,$getMensages2);
                /*Guardamos la fechas en el array*/
                $getDates2 = $Fechas2;
                array_push($arrayGetDates2,$getDates2);
                /*Creamos nuestro bloque de fecha y mensajes enviados*/
                $newFechaConversation2 = array('fecha_conver' => $Fechas2,'time_send' => $time2,'id' => $keyConversationBetwwenUser2->id,'id_user' => $keyConversationBetwwenUser2->id_user,'id_user_conversation' => $keyConversationBetwwenUser2->id_user_conversation,'userReceive' => 1,'userSend' => 0,'mensages' => $arrayMensages2);
                array_push($arrayMensagesFechas2,$newFechaConversation2);
                $bande2 = $bande2+1;
              }elseif($bande2 == 1) {     
                /*** 
                Busca dentro del array de fechas, si dentro del array de fechas, la fecha que viene esta 
                repetida entonces, entonces vas a agrupar le mensaje dentro del bloque de fecha existente
                ***/
                if(in_array($Fechas2, $arrayGetDates2)){     
                    foreach ($arrayMensagesFechas2 as $keyarrayMensagesFechas2 => $value2) {
                        /* Si del array de mensajes y fechas la fecha es igual, entonces  descomponeme el array*/
                       if($value2['fecha_conver'] == $Fechas2){
                          $newGruopMensages2 = array();
                          $positionOfArray2 =$keyarrayMensagesFechas2;
                          $mensagesAnterior2 = $value2['mensages'];
                          foreach ($mensagesAnterior2 as $keymensagesAnterior2) {
                              array_push($newGruopMensages2,$keymensagesAnterior2);
                          }
                          $getMensages2 = $keyConversationBetwwenUser2->conversations;
                          array_push($newGruopMensages2,$getMensages2);
                          unset($arrayMensagesFechas2[$positionOfArray2]);
                          $newFechaConversation2 = array('fecha_conver' => $Fechas2,'time_send' => $time2,'id' => $keyConversationBetwwenUser2->id,'id_user' => $keyConversationBetwwenUser2->id_user,'id_user_conversation' => $keyConversationBetwwenUser2->id_user_conversation,'userReceive' => 1,'userSend' => 0,'mensages' => $newGruopMensages2);
                          array_push($arrayMensagesFechas2,$newFechaConversation2);

                       }
                    }
                }else{
                    $arrayMensages2 = array();
                    $getMensages2 = $keyConversationBetwwenUser2->conversations;
                    array_push($arrayMensages2,$getMensages2);
                    $getDates2 = $Fechas2;
                    array_push($arrayGetDates2,$getDates2);
                    $newFechaConversation2 = array('fecha_conver' => $Fechas2,'time_send' => $time2,'id' => $keyConversationBetwwenUser2->id,'id_user' => $keyConversationBetwwenUser2->id_user,'id_user_conversation' => $keyConversationBetwwenUser2->id_user_conversation,'userReceive' => 1,'userSend' => 0,'mensages' => $arrayMensages2);
                    array_push($arrayMensagesFechas2,$newFechaConversation2);
                }                                 
              }
            }
          }

          /** Unimos las conversaciones y los ordenamos por fechas */
          $UnionConversation = array_merge_recursive($arrayMensagesFechas, $arrayMensagesFechas2);
          sort($UnionConversation);

          if(empty($UnionConversation)){
            $SendAndRecive = array();
            // $restandoUnaPocicion =$numeroPocicion;
          }else if(count($UnionConversation) == 1){
            // Busco el total de posiciones
            foreach ($UnionConversation as $keyUnionConversation => $valueUnion) {
                $numeroPocicion =$keyUnionConversation;
            }

            $restandoUnaPocicion = $numeroPocicion;
            /** Al total obtenido le resto uno para luego buscar el array que contenta la pociion 
            anteriormente creada, la idea es buscar el penultimo valor **/
            foreach ($UnionConversation as $key2UnionConversation => $value2UnionConversation) {
                if($key2UnionConversation == $restandoUnaPocicion){
                    $PenultimoValueArray = $value2UnionConversation;
                }
            }

            // Get ultimo registro
            $UltimoValueInsert = end($UnionConversation);

            /**conprovamos quien fue el ultimo en escribir y si la hora fue mayor */
            if($UltimoValueInsert['userSend'] == 1 && $UltimoValueInsert['time_send'] > $PenultimoValueArray['time_send']){
              // Si el ultimo que escribio en la conversacion fue el que esta logiado, traeme este orden
              $SendAndRecive = array_merge_recursive($arrayMensagesFechas2, $arrayMensagesFechas);
              sort($SendAndRecive);
            }else{
              $SendAndRecive = array_merge_recursive($arrayMensagesFechas, $arrayMensagesFechas2);
              sort($SendAndRecive);
            }


          }else{
            // Busco el total de posiciones
            foreach ($UnionConversation as $keyUnionConversation => $valueUnion) {
                $numeroPocicion =$keyUnionConversation;
            }

            $restandoUnaPocicion = $numeroPocicion-1;
            /** Al total obtenido le resto uno para luego buscar el array que contenta la pociion 
            anteriormente creada, la idea es buscar el penultimo valor **/
            foreach ($UnionConversation as $key2UnionConversation => $value2UnionConversation) {
                if($key2UnionConversation == $restandoUnaPocicion){
                    $PenultimoValueArray = $value2UnionConversation;
                }
            }

            // Get ultimo registro
            $UltimoValueInsert = end($UnionConversation);

            /**conprovamos quien fue el ultimo en escribir y si la hora fue mayor */
            if($UltimoValueInsert['userSend'] == 1 && $UltimoValueInsert['time_send'] > $PenultimoValueArray['time_send']){
              // Si el ultimo que escribio en la conversacion fue el que esta logiado, traeme este orden
              $SendAndRecive = array_merge_recursive($arrayMensagesFechas2, $arrayMensagesFechas);
              sort($SendAndRecive);
            }else{
              $SendAndRecive = array_merge_recursive($arrayMensagesFechas, $arrayMensagesFechas2);
              sort($SendAndRecive);
            }
          }

          


          array_push($grpupChat,$SendAndRecive);
      }


      $GetUltimateMensage = array();
      foreach ($grpupChat as $keygrpupChat) {
        $CountArray = count($keygrpupChat)-1;
        foreach ($keygrpupChat as $dataKeygrpupChat => $DatavalueKeygrpupChat) {
           $position = $dataKeygrpupChat;
           $prieb = $DatavalueKeygrpupChat['id_user'];

           if($position == $CountArray ){
            $GetMensage = $DatavalueKeygrpupChat['mensages'];
            $counMensaje = count($GetMensage)-1;

            foreach ($GetMensage as $keyGetMensage => $valueGetMensage) {
                $positionMensage = $keyGetMensage;
                if($positionMensage == $counMensaje){
                    $NewMensahe = $valueGetMensage;
                    $DatavalueKeygrpupChat['mensages'] = $NewMensahe;
                }
            }
            array_push($GetUltimateMensage,$DatavalueKeygrpupChat);
           }
         }
      }
      
// dd($GetUltimateMensage);

      #Get actividades recientes
      $Activities = $this->ActivitiesRecientes();
      $ActivitiesNotifys = $this->ActivitiesNotifysRecientes();
      $NotifisEventos = NotificacionesEventos::all();

      #get Color del panel del usuario d
      $Bguser  = $this->GetBackgroundPanelOfUSer();

      #get Foto User login
      $UsersDatasLogin = DatosPersonales::where('id_usuario','=', $idUserLogin)->get();
      $fotoUser = '';
      foreach ($UsersDatasLogin as $keyUsersDatasLogin) {
        $fotoUser =$keyUsersDatasLogin->foto;
      }

      return view('usuarios.chatUsers', compact('getUsers','GetUltimateMensage','idUserLogin','AllOnlineUser','Bguser','Activities','ActivitiesNotifys','NotifisEventos','fotoUser','AllPost'));
    }

    public function storeChat(Request $request){
      if($request->ajax()) {
        $arrayCOnversation = array();
        $arrayFechas = array();
        $arrayMensages = array();
        $arrayMensagesFechas = array();
        $arrayGetDates = array();
        $arrayVerifiFechas = array();
        $newGruopMensages = array();
        $bande = 0;

        $arrayCOnversation2 = array();
        $arrayFechas2 = array();
        $arrayMensages2 = array();
        $arrayMensagesFechas2 = array();
        $arrayGetDates2 = array();
        $arrayVerifiFechas2 = array();
        $newGruopMensages2 = array();
        $bande2 = 0;

        $id_ForChat = $request->idForChat;
        $idUserLogin = Auth::user()->id;

        $queryConversationUser = User::findOrFail($id_ForChat);
        // $ConversationBetwwenUser = Chats::where('id_user','=',$idUserLogin)->where('id_user_conversation','=',$id_ForChat);

        $ConversationBetwwenUser = Chats::where('id_user','=',$idUserLogin)->get();
        $ConversationBetwwenUser2 = Chats::where('id_user_conversation','=',$idUserLogin)->get();

        foreach ($ConversationBetwwenUser as $keyConversationBetwwenUser) {
          if($keyConversationBetwwenUser->id_user_conversation == $id_ForChat){
            /*Convertimos fechas*/
            $date = new \Carbon\Carbon($keyConversationBetwwenUser->created_at);                    
            $Fechas = $date->format('d-m-Y');
            $time = $date->format('H:i:s');
            $arrayMensages = array();
            /*Guardamos el mensaje en el array*/
            $getMensages = $keyConversationBetwwenUser->conversations;
            array_push($arrayMensages,$getMensages);
            /*Guardamos la fechas en el array*/
            $getDates = $Fechas;
            array_push($arrayGetDates,$getDates);
            /*Creamos nuestro bloque de fecha y mensajes enviados*/
            $newFechaConversation = array('fecha_conver' => $Fechas,'time_send' => $time,'userSend' => 1,'userReceive' => 0,'mensages' => $arrayMensages);
            array_push($arrayMensagesFechas,$newFechaConversation);
          }
        }
       
        

        foreach ($ConversationBetwwenUser2 as $keyConversationBetwwenUser2) {
          if($keyConversationBetwwenUser2->id_user == $id_ForChat){
            /*Convertimos fechas*/
            $date2 = new \Carbon\Carbon($keyConversationBetwwenUser2->created_at);                    
            $Fechas2 = $date2->format('d-m-Y');
            $time2 = $date2->format('H:i:s');
            $arrayMensages2 = array();
            /*Guardamos el mensaje en el array*/
            $getMensages2 = $keyConversationBetwwenUser2->conversations;
            array_push($arrayMensages2,$getMensages2);
            /*Guardamos la fechas en el array*/
            $getDates2 = $Fechas2;
            array_push($arrayGetDates2,$getDates2);
            /*Creamos nuestro bloque de fecha y mensajes enviados*/
            $newFechaConversation2 = array('fecha_conver' => $Fechas2,'time_send' => $time2,'userReceive' => 1,'userSend' => 0,'mensages' => $arrayMensages2);
            array_push($arrayMensagesFechas2,$newFechaConversation2);
          }
        }

        /** Unimos las conversaciones y los ordenamos por fechas */
        $UnionConversation = array_merge_recursive($arrayMensagesFechas, $arrayMensagesFechas2);
        sort($UnionConversation);

        if(empty($UnionConversation)){
          $SendAndRecive = array();
        }else{
          // Busco el total de posiciones
          foreach ($UnionConversation as $keyUnionConversation => $valueUnion) {
            $numeroPocicion =$keyUnionConversation;
          }


          /*Hacemos la siguiente condicion par determinar si en la comversacion solo el user logiado a enviado mensaje, eso determina que solo existe un valor*/
          if($numeroPocicion != 0){
            $restandoUnaPocicion = $numeroPocicion-1;
            /** Al total obtenido le resto uno para luego buscar el array que contenta la pociion 
            anteriormente creada, la idea es buscar el penultimo valor **/
            foreach ($UnionConversation as $key2UnionConversation => $value2UnionConversation) {
              if($key2UnionConversation == $restandoUnaPocicion){
                $PenultimoValueArray = $value2UnionConversation;
              }
            }
            // Get ultimo registro
            $UltimoValueInsert = end($UnionConversation);

            /**conprovamos quien fue el ultimo en escribir y si la hora fue mayor */
            if($UltimoValueInsert['userSend'] == 1 && $UltimoValueInsert['time_send'] > $PenultimoValueArray['time_send']){
              // Si el ultimo que escribio en la conversacion fue el que esta logiado, traeme este orden
              $SendAndRecive = array_merge_recursive($arrayMensagesFechas2, $arrayMensagesFechas);
              sort($SendAndRecive);
            }else{
              $SendAndRecive = array_merge_recursive($arrayMensagesFechas, $arrayMensagesFechas2);
              sort($SendAndRecive);
            }
          }else{

            foreach ($UnionConversation as $key2UnionConversation => $value2UnionConversation) {
            }
            // Get ultimo registro
            $UltimoValueInsert = end($UnionConversation);

            /**conprovamos quien fue el ultimo en escribir y si la hora fue mayor */
            if($UltimoValueInsert['userSend'] == 1 && $UltimoValueInsert['time_send'] ){
              // Si el ultimo que escribio en la conversacion fue el que esta logiado, traeme este orden
              $SendAndRecive = array_merge_recursive($arrayMensagesFechas2, $arrayMensagesFechas);
              sort($SendAndRecive);
            }else{
              $SendAndRecive = array_merge_recursive($arrayMensagesFechas, $arrayMensagesFechas2);
              sort($SendAndRecive);
            }
          }
        }
        
         // dd($SendAndRecive);
        echo json_encode($SendAndRecive);

      }
    }

    public function Calendar()
    {
      $idUserLogin = Auth::user()->id;
      $EventsDayCalendar = EventosCalendario::all();
      $EventsDayCalendarOrder =  \DB::table('eventos_calendario')
      ->select('*')
      ->orderBy('fecha_evento', 'asc')
      ->get();

      $DatosPersonales =  \DB::table('datos_personales')
      ->select('*')
      ->get();

      $UsersAlls = User::all();
      $Solicitudes = DetallesSolicitudes::where('id_usuario','=',$idUserLogin)->get();
      

      # Creamos session de idLogiado para chat
      $getCreateOnlineUsers = $this->CreateGetOnlineUser($idUserLogin);

      # get all users online
      $AllOnlineUser = $this->UsersOnline();
      # get all users
      $getUsers = $this->AllUsers();

      $DayMothsYear = $this->getDaysMoth();

      # Obteniendo los eventos de cada mes; 
      $EventsCalendar = $this->getCalendar(); 
      $eventsEnero = $EventsCalendar[0];
      $eventsFebrero = $EventsCalendar[1];
      $eventsMarzo = $EventsCalendar[2];      
      $eventsAbril = $EventsCalendar[3];
      $eventsMayo = $EventsCalendar[4];
      $eventsJunio = $EventsCalendar[5];
      $eventsJulio = $EventsCalendar[6];
      $eventsAgosto = $EventsCalendar[7];
      $eventsSeptiembre = $EventsCalendar[8];
      $eventsOctubre = $EventsCalendar[9];
      $eventsNoviembre = $EventsCalendar[10];
      $eventsDiciembre = $EventsCalendar[11];

      $JoinTableUserDatas =  \DB::table('users')
      ->join('datos_personales', 'users.id', '=', 'datos_personales.id_usuario')
      ->join('datos_empleados', 'users.id', '=', 'datos_empleados.id_usuario')
      ->join('formacion_acedemica', 'users.id', '=', 'formacion_acedemica.id_usuario')
      ->select('*')
      ->get();

      #get Horarios
      $HorariosUser = Horarios::all();
      $arrayDaysDescansoUser = array();
      foreach ($HorariosUser as $keyHorariosUser) {
        if($keyHorariosUser->id_usuario == $idUserLogin){
          if($keyHorariosUser->bloq_horarioMedio1 != null){
            $diasDescanso = explode(", ", $keyHorariosUser->bloq_horarioMedio1);
            array_push($arrayDaysDescansoUser, $diasDescanso);
          }
          if($keyHorariosUser->bloq_horarioMedio2 != null){
            $diasDescanso2 = explode(", ", $keyHorariosUser->bloq_horarioMedio2);
            array_push($arrayDaysDescansoUser, $diasDescanso2);
          }
          if($keyHorariosUser->bloq_horarioMedio3 != null){
            $diasDescanso3 = explode(", ", $keyHorariosUser->bloq_horarioMedio3);
            array_push($arrayDaysDescansoUser, $diasDescanso3);
          }
        }
       
      }

      $arrayOfImages = array();
      # Get posts
        $Posts = $this->GetPost();
      # Decompiniendo array de post para obtener galeria de fotos que el usuario a publicado
        foreach ($Posts as $keyPostsImages) {
          if($keyPostsImages->id_usuario == $idUserLogin){
            if($keyPostsImages->imagen != ''){
              $ArrayImgeesGaleri = '';
              $ArrayImgeesGaleri = explode(",", $keyPostsImages->imagen);
              array_push($arrayOfImages,$ArrayImgeesGaleri);
            }
          }          
        }

      #get Notificaciones y actividades
      $AllPost = Post::all();
      $Activities = $this->ActivitiesRecientes();
      $ActivitiesNotifys = $this->ActivitiesNotifysRecientes();
      $NotifisEventos = NotificacionesEventos::all();

      #get Color del panel del usuario d
      $Bguser  = $this->GetBackgroundPanelOfUSer();

      #get Foto User login
      $UsersDatasLogin = DatosPersonales::where('id_usuario','=', $idUserLogin)->get();
      $fotoUser = '';
      foreach ($UsersDatasLogin as $keyUsersDatasLogin) {
        $fotoUser =$keyUsersDatasLogin->foto;
      }

      return view('usuarios.calendario',compact('idUserLogin','AllOnlineUser','EventsDayCalendar','UsersAlls','getCreateOnlineUsers','DayMothsYear','EventsCalendar','eventsEnero','eventsFebrero','eventsMarzo','eventsAbril','eventsMayo','eventsJunio','eventsJulio','eventsAgosto','eventsSeptiembre','eventsOctubre','eventsNoviembre','eventsDiciembre','JoinTableUserDatas','HorariosUser','arrayDaysDescansoUser','getUsers','Posts','arrayOfImages','Solicitudes','DatosPersonales','EventsDayCalendarOrder','Activities','NotifisEventos','AllPost','ActivitiesNotifys','Bguser','fotoUser'));
    }

    public function SolicitudPermiso()
    {
      $idUserLogin = Auth::user()->id;
      $EventsDayCalendar = EventosCalendario::all();
      $UsersAlls = User::all();
      $Solicitudes = DetallesSolicitudes::where('id_usuario','=',$idUserLogin)->get();
      

      # Creamos session de idLogiado para chat
      $getCreateOnlineUsers = $this->CreateGetOnlineUser($idUserLogin);

      # get all users online
      $AllOnlineUser = $this->UsersOnline();
      # get all users
      $getUsers = $this->AllUsers();

      $DayMothsYear = $this->getDaysMoth();

      # Obteniendo los eventos de cada mes; 
      $EventsCalendar = $this->getCalendar(); 
      $eventsEnero = $EventsCalendar[0];
      $eventsFebrero = $EventsCalendar[1];
      $eventsMarzo = $EventsCalendar[2];      
      $eventsAbril = $EventsCalendar[3];
      $eventsMayo = $EventsCalendar[4];
      $eventsJunio = $EventsCalendar[5];
      $eventsJulio = $EventsCalendar[6];
      $eventsAgosto = $EventsCalendar[7];
      $eventsSeptiembre = $EventsCalendar[8];
      $eventsOctubre = $EventsCalendar[9];
      $eventsNoviembre = $EventsCalendar[10];
      $eventsDiciembre = $EventsCalendar[11];

      $JoinTableUserDatas =  \DB::table('users')
      ->join('datos_personales', 'users.id', '=', 'datos_personales.id_usuario')
      ->join('datos_empleados', 'users.id', '=', 'datos_empleados.id_usuario')
      ->join('formacion_acedemica', 'users.id', '=', 'formacion_acedemica.id_usuario')
      ->select('*')
      ->get();

      #get Horarios
      $HorariosUser = Horarios::all();
      $arrayDaysDescansoUser = array();
      foreach ($HorariosUser as $keyHorariosUser) {
        if($keyHorariosUser->id_usuario == $idUserLogin){
          if($keyHorariosUser->bloq_horarioMedio1 != null){
            $diasDescanso = explode(", ", $keyHorariosUser->bloq_horarioMedio1);
            array_push($arrayDaysDescansoUser, $diasDescanso);
          }
          if($keyHorariosUser->bloq_horarioMedio2 != null){
            $diasDescanso2 = explode(", ", $keyHorariosUser->bloq_horarioMedio2);
            array_push($arrayDaysDescansoUser, $diasDescanso2);
          }
          if($keyHorariosUser->bloq_horarioMedio3 != null){
            $diasDescanso3 = explode(", ", $keyHorariosUser->bloq_horarioMedio3);
            array_push($arrayDaysDescansoUser, $diasDescanso3);
          }
        }
       
      }

      $arrayOfImages = array();
      # Get posts
        $Posts = $this->GetPost();
      # Decompiniendo array de post para obtener galeria de fotos que el usuario a publicado
        foreach ($Posts as $keyPostsImages) {
          if($keyPostsImages->id_usuario == $idUserLogin){
            if($keyPostsImages->imagen != ''){
              $ArrayImgeesGaleri = '';
              $ArrayImgeesGaleri = explode(",", $keyPostsImages->imagen);
              array_push($arrayOfImages,$ArrayImgeesGaleri);
            }
          }          
        }


        $DataDias = $this->DaysVacaciones();
        $PrimerNumerDay = $DataDias[0];
        $SegundoNumerDay = $DataDias[1];

        #get Notificaciones y actividades
        $AllPost = Post::all();
        $Activities = $this->ActivitiesRecientes();
        $ActivitiesNotifys = $this->ActivitiesNotifysRecientes();
        $NotifisEventos = NotificacionesEventos::all();

        #get Color del panel del usuario d
        $Bguser  = $this->GetBackgroundPanelOfUSer();

        #get Foto User login
        $UsersDatasLogin = DatosPersonales::where('id_usuario','=', $idUserLogin)->get();
        $fotoUser = '';
        foreach ($UsersDatasLogin as $keyUsersDatasLogin) {
          $fotoUser =$keyUsersDatasLogin->foto;
        }


      return view('usuarios.solicitud-permiso',compact('idUserLogin','AllOnlineUser','EventsDayCalendar','UsersAlls','getCreateOnlineUsers','DayMothsYear','EventsCalendar','eventsEnero','eventsFebrero','eventsMarzo','eventsAbril','eventsMayo','eventsJunio','eventsJulio','eventsAgosto','eventsSeptiembre','eventsOctubre','eventsNoviembre','eventsDiciembre','JoinTableUserDatas','HorariosUser','arrayDaysDescansoUser','getUsers','Posts','arrayOfImages','Solicitudes','PrimerNumerDay','SegundoNumerDay','Activities','NotifisEventos','AllPost','ActivitiesNotifys','Bguser','fotoUser'));
    }

    public function StoreSolicitudPermimso(Request $request){

      $data = facedesrequest::all();
      $idUserLogin = Auth::user()->id;
      $MotivoPermiso = $request->descript_solicitud_permiso;
      $TiempoPermiso = $request->tiempo_permiso;
      $TipoDescuento = $request->type_descuento;
      $TipoSolicitud = $request->id_tipo_solicitud;
      $FechaPermiso = $request->fecha_permiso;

      $dataSolicitudPermiso = array(
        'motivo_descripcion' => $MotivoPermiso,
        'fecha_permiso' => $FechaPermiso,
        'hora_permiso' => $TiempoPermiso,
        'id_tipo_solicitud' => $TipoSolicitud,
        'solicitud_espera' => '1',
        'id_usuario' => $idUserLogin,
      );

      $createNewSolicitudPermiso = new DetallesSolicitudes($dataSolicitudPermiso);
      $createNewSolicitudPermiso->save();
      $idSolicitud = $createNewSolicitudPermiso->id;

      if($TipoDescuento == 'Vacaciones'){
        $dataSolicitudTipoDescuento = array(
          'vacaciones' => '1',
          'id_usuario' => $idUserLogin,
          'id_detalles_solicitud' => $idSolicitud,
        );

        $createNewDes = new TiposDescuentos($dataSolicitudTipoDescuento);
        $createNewDes->save();
        Session::flash('Create_Solicitud_permiso', "Solicitud Enviada");
        return back()->withInput();

      }elseif ($TipoDescuento == 'Dia septimo') {
        $dataSolicitudTipoDescuento = array(
          'dia_septimo' => '1',
          'id_usuario' => $idUserLogin,
          'id_detalles_solicitud' => $idSolicitud,
        );

        $createNewDes = new TiposDescuentos($dataSolicitudTipoDescuento);
        $createNewDes->save();
        Session::flash('Create_Solicitud_permiso', "Solicitud Enviada");
        return back()->withInput();
      }

    }

    public function SolicitudPermisoEmergencia()
    {
      $idUserLogin = Auth::user()->id;
      $EventsDayCalendar = EventosCalendario::all();
      $UsersAlls = User::all();
      $Solicitudes = DetallesSolicitudes::where('id_usuario','=',$idUserLogin)->get();
      

      # Creamos session de idLogiado para chat
      $getCreateOnlineUsers = $this->CreateGetOnlineUser($idUserLogin);

      # get all users online
      $AllOnlineUser = $this->UsersOnline();
      # get all users
      $getUsers = $this->AllUsers();

      $DayMothsYear = $this->getDaysMoth();

      # Obteniendo los eventos de cada mes; 
      $EventsCalendar = $this->getCalendar(); 
      $eventsEnero = $EventsCalendar[0];
      $eventsFebrero = $EventsCalendar[1];
      $eventsMarzo = $EventsCalendar[2];      
      $eventsAbril = $EventsCalendar[3];
      $eventsMayo = $EventsCalendar[4];
      $eventsJunio = $EventsCalendar[5];
      $eventsJulio = $EventsCalendar[6];
      $eventsAgosto = $EventsCalendar[7];
      $eventsSeptiembre = $EventsCalendar[8];
      $eventsOctubre = $EventsCalendar[9];
      $eventsNoviembre = $EventsCalendar[10];
      $eventsDiciembre = $EventsCalendar[11];

      $JoinTableUserDatas =  \DB::table('users')
      ->join('datos_personales', 'users.id', '=', 'datos_personales.id_usuario')
      ->join('datos_empleados', 'users.id', '=', 'datos_empleados.id_usuario')
      ->join('formacion_acedemica', 'users.id', '=', 'formacion_acedemica.id_usuario')
      ->select('*')
      ->get();

      #get Horarios
      $HorariosUser = Horarios::all();
      $arrayDaysDescansoUser = array();
      foreach ($HorariosUser as $keyHorariosUser) {
        if($keyHorariosUser->id_usuario == $idUserLogin){
          if($keyHorariosUser->bloq_horarioMedio1 != null){
            $diasDescanso = explode(", ", $keyHorariosUser->bloq_horarioMedio1);
            array_push($arrayDaysDescansoUser, $diasDescanso);
          }
          if($keyHorariosUser->bloq_horarioMedio2 != null){
            $diasDescanso2 = explode(", ", $keyHorariosUser->bloq_horarioMedio2);
            array_push($arrayDaysDescansoUser, $diasDescanso2);
          }
          if($keyHorariosUser->bloq_horarioMedio3 != null){
            $diasDescanso3 = explode(", ", $keyHorariosUser->bloq_horarioMedio3);
            array_push($arrayDaysDescansoUser, $diasDescanso3);
          }
        }
       
      }

      $arrayOfImages = array();
      # Get posts
        $Posts = $this->GetPost();
      # Decompiniendo array de post para obtener galeria de fotos que el usuario a publicado
        foreach ($Posts as $keyPostsImages) {
          if($keyPostsImages->id_usuario == $idUserLogin){
            if($keyPostsImages->imagen != ''){
              $ArrayImgeesGaleri = '';
              $ArrayImgeesGaleri = explode(",", $keyPostsImages->imagen);
              array_push($arrayOfImages,$ArrayImgeesGaleri);
            }
          }          
        }

        $DataDias = $this->DaysVacaciones();
        $PrimerNumerDay = $DataDias[0];
        $SegundoNumerDay = $DataDias[1];

        #get Notificaciones y actividades
        $AllPost = Post::all();
        $Activities = $this->ActivitiesRecientes();
        $ActivitiesNotifys = $this->ActivitiesNotifysRecientes();
        $NotifisEventos = NotificacionesEventos::all();

        #get Color del panel del usuario d
        $Bguser  = $this->GetBackgroundPanelOfUSer();

        #get Foto User login
        $UsersDatasLogin = DatosPersonales::where('id_usuario','=', $idUserLogin)->get();
        $fotoUser = '';
        foreach ($UsersDatasLogin as $keyUsersDatasLogin) {
          $fotoUser =$keyUsersDatasLogin->foto;
        }



      return view('usuarios.motivo-emergencia',compact('idUserLogin','AllOnlineUser','EventsDayCalendar','UsersAlls','getCreateOnlineUsers','DayMothsYear','EventsCalendar','eventsEnero','eventsFebrero','eventsMarzo','eventsAbril','eventsMayo','eventsJunio','eventsJulio','eventsAgosto','eventsSeptiembre','eventsOctubre','eventsNoviembre','eventsDiciembre','JoinTableUserDatas','HorariosUser','arrayDaysDescansoUser','getUsers','Posts','arrayOfImages','Solicitudes','PrimerNumerDay','SegundoNumerDay','Activities','NotifisEventos','AllPost','ActivitiesNotifys','Bguser','fotoUser'));
    }

    public function StoreSolicitudEmergencia(Request $request){

      $data = facedesrequest::all();
      $idUserLogin = Auth::user()->id;
      $MotivoEmergencia = $request->motivo_emergencia;
      $fileDocuments = $request->file('file_inputemergencia_document');  
      $fileImages = $request->file('file_inputemergenci_imga');  
      $arrayDocuments = array();
      $arrayImages = array();

      // Validad Subbida de archivos
      if($fileDocuments != ''){
        $cantidadDocument = count($fileDocuments);

        for ($i=0; $i < $cantidadDocument ; $i++) { 
         $nombreFoto = $fileDocuments[$i]->getClientOriginalName();
         $fileNameFoto = rand(11,99999);
         $imageName = $fileNameFoto.'.'.$fileDocuments[$i]->getClientOriginalExtension();
         $fileDocuments[$i]->move(
             base_path() . '\public\assets\images\documents', $imageName
         );
         array_push($arrayDocuments, $imageName);
        }

      }elseif($fileImages != ''){
        $cantidadImages = count($fileImages);

        for ($i=0; $i < $cantidadImages ; $i++) { 
         $nombreFoto = $fileImages[$i]->getClientOriginalName();
         $fileNameFoto = rand(11,99999);
         $imageName = $fileNameFoto.'.'.$fileImages[$i]->getClientOriginalExtension();
         $fileImages[$i]->move(
             base_path() . '\public\assets\images\documents', $imageName
         );
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

      $dataSolicitudPermisoEmergencia = array(
        'motivo_descripcion' => $MotivoEmergencia,
        'documentos_adjunto' => $uniedo_document,
        'img_adjunta' => $uniedo_images,
        'id_tipo_solicitud' => 2,
        'solicitud_espera' => '1',
        'id_usuario' => $idUserLogin,
      );

      $DataStoreEmergenci = new DetallesSolicitudes($dataSolicitudPermisoEmergencia);  
      $DataStoreEmergenci->save();

      Session::flash('Create_Solicitud_permiso_emergencia', "Solicitud Enviada");
      return back()->withInput();

    }

    public function BuzonSugerencias()
    {
      $idUserLogin = Auth::user()->id;
      $EventsDayCalendar = EventosCalendario::all();
      $UsersAlls = User::all();
      $Solicitudes = DetallesSolicitudes::where('id_usuario','=',$idUserLogin)->get();
      

      # Creamos session de idLogiado para chat
      $getCreateOnlineUsers = $this->CreateGetOnlineUser($idUserLogin);

      # get all users online
      $AllOnlineUser = $this->UsersOnline();
      # get all users
      $getUsers = $this->AllUsers();

      $DayMothsYear = $this->getDaysMoth();

      # Obteniendo los eventos de cada mes; 
      $EventsCalendar = $this->getCalendar(); 
      $eventsEnero = $EventsCalendar[0];
      $eventsFebrero = $EventsCalendar[1];
      $eventsMarzo = $EventsCalendar[2];      
      $eventsAbril = $EventsCalendar[3];
      $eventsMayo = $EventsCalendar[4];
      $eventsJunio = $EventsCalendar[5];
      $eventsJulio = $EventsCalendar[6];
      $eventsAgosto = $EventsCalendar[7];
      $eventsSeptiembre = $EventsCalendar[8];
      $eventsOctubre = $EventsCalendar[9];
      $eventsNoviembre = $EventsCalendar[10];
      $eventsDiciembre = $EventsCalendar[11];

      $JoinTableUserDatas =  \DB::table('users')
      ->join('datos_personales', 'users.id', '=', 'datos_personales.id_usuario')
      ->join('datos_empleados', 'users.id', '=', 'datos_empleados.id_usuario')
      ->join('formacion_acedemica', 'users.id', '=', 'formacion_acedemica.id_usuario')
      ->select('*')
      ->get();

      #get Horarios
      $HorariosUser = Horarios::all();
      $arrayDaysDescansoUser = array();
      foreach ($HorariosUser as $keyHorariosUser) {
        if($keyHorariosUser->id_usuario == $idUserLogin){
          if($keyHorariosUser->bloq_horarioMedio1 != null){
            $diasDescanso = explode(", ", $keyHorariosUser->bloq_horarioMedio1);
            array_push($arrayDaysDescansoUser, $diasDescanso);
          }
          if($keyHorariosUser->bloq_horarioMedio2 != null){
            $diasDescanso2 = explode(", ", $keyHorariosUser->bloq_horarioMedio2);
            array_push($arrayDaysDescansoUser, $diasDescanso2);
          }
          if($keyHorariosUser->bloq_horarioMedio3 != null){
            $diasDescanso3 = explode(", ", $keyHorariosUser->bloq_horarioMedio3);
            array_push($arrayDaysDescansoUser, $diasDescanso3);
          }
        }
       
      }

      $arrayOfImages = array();
      # Get posts
        $Posts = $this->GetPost();
      # Decompiniendo array de post para obtener galeria de fotos que el usuario a publicado
        foreach ($Posts as $keyPostsImages) {
          if($keyPostsImages->id_usuario == $idUserLogin){
            if($keyPostsImages->imagen != ''){
              $ArrayImgeesGaleri = '';
              $ArrayImgeesGaleri = explode(",", $keyPostsImages->imagen);
              array_push($arrayOfImages,$ArrayImgeesGaleri);
            }
          }          
        }

        $DataDias = $this->DaysVacaciones();
        $PrimerNumerDay = $DataDias[0];
        $SegundoNumerDay = $DataDias[1];

        #get Notificaciones y actividades
        $AllPost = Post::all();
        $Activities = $this->ActivitiesRecientes();
        $ActivitiesNotifys = $this->ActivitiesNotifysRecientes();
        $NotifisEventos = NotificacionesEventos::all();

        #get Color del panel del usuario d
        $Bguser  = $this->GetBackgroundPanelOfUSer();

        #get Foto User login
        $UsersDatasLogin = DatosPersonales::where('id_usuario','=', $idUserLogin)->get();
        $fotoUser = '';
        foreach ($UsersDatasLogin as $keyUsersDatasLogin) {
          $fotoUser =$keyUsersDatasLogin->foto;
          $TypefotoUser =$keyUsersDatasLogin->mime;
        }

      return view('usuarios.buzon-sugerencias',compact('idUserLogin','AllOnlineUser','EventsDayCalendar','UsersAlls','getCreateOnlineUsers','DayMothsYear','EventsCalendar','eventsEnero','eventsFebrero','eventsMarzo','eventsAbril','eventsMayo','eventsJunio','eventsJulio','eventsAgosto','eventsSeptiembre','eventsOctubre','eventsNoviembre','eventsDiciembre','JoinTableUserDatas','HorariosUser','arrayDaysDescansoUser','getUsers','Posts','arrayOfImages','Solicitudes','PrimerNumerDay','SegundoNumerDay','Activities','NotifisEventos','AllPost','ActivitiesNotifys','Bguser','fotoUser','TypefotoUser'));
    }

    public function StoreBuzonSugerencia(Request $request){

      $data = facedesrequest::all();
      $idUserLogin = Auth::user()->id;
      $MotivoSugerencia = $request->motivo_sugerencia;
      $fileDocuments = $request->file('file_inputemergencia_document');  
      $fileImages = $request->file('file_inputemergenci_imga');  
      $arrayDocuments = array();
      $arrayImages = array();

      // Validad Subbida de archivos
      if($fileDocuments != ''){
        $cantidadDocument = count($fileDocuments);

        for ($i=0; $i < $cantidadDocument ; $i++) { 
         $nombreFoto = $fileDocuments[$i]->getClientOriginalName();
         $fileNameFoto = rand(11,99999);
         $imageName = $fileNameFoto.'.'.$fileDocuments[$i]->getClientOriginalExtension();
         $fileDocuments[$i]->move(
             base_path() . '\public\assets\images\documents', $imageName
         );
         array_push($arrayDocuments, $imageName);
        }

      }elseif($fileImages != ''){
        $cantidadImages = count($fileImages);

        for ($i=0; $i < $cantidadImages ; $i++) { 
         $nombreFoto = $fileImages[$i]->getClientOriginalName();
         $fileNameFoto = rand(11,99999);
         $imageName = $fileNameFoto.'.'.$fileImages[$i]->getClientOriginalExtension();
         $fileImages[$i]->move(
             base_path() . '\public\assets\images\documents', $imageName
         );
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

      $dataSolicitudPermisoEmergencia = array(
        'motivo_descripcion' => $MotivoSugerencia,
        'documentos_adjunto' => $uniedo_document,
        'img_adjunta' => $uniedo_images,
        'id_tipo_solicitud' => 3,
        'solicitud_espera' => '1',
        'id_usuario' => $idUserLogin,
      );

      $DataStoreSugerencia = new DetallesSolicitudes($dataSolicitudPermisoEmergencia);  
      $DataStoreSugerencia->save();

      Session::flash('Create_Solicitud_sugerencia', "Solicitud Enviada");
      return back()->withInput();

    }


    public function DetallsSolicitudesInProceso()
    {
      $idUserLogin = Auth::user()->id;
      $EventsDayCalendar = EventosCalendario::all();
      $UsersAlls = User::all();
      $Solicitudes = DetallesSolicitudes::where('id_usuario','=',$idUserLogin)->where('solicitud_espera','=','1')->get();
      

      # Creamos session de idLogiado para chat
      $getCreateOnlineUsers = $this->CreateGetOnlineUser($idUserLogin);

      # get all users online
      $AllOnlineUser = $this->UsersOnline();
      # get all users
      $getUsers = $this->AllUsers();

      $DayMothsYear = $this->getDaysMoth();

      # Obteniendo los eventos de cada mes; 
      $EventsCalendar = $this->getCalendar(); 
      $eventsEnero = $EventsCalendar[0];
      $eventsFebrero = $EventsCalendar[1];
      $eventsMarzo = $EventsCalendar[2];      
      $eventsAbril = $EventsCalendar[3];
      $eventsMayo = $EventsCalendar[4];
      $eventsJunio = $EventsCalendar[5];
      $eventsJulio = $EventsCalendar[6];
      $eventsAgosto = $EventsCalendar[7];
      $eventsSeptiembre = $EventsCalendar[8];
      $eventsOctubre = $EventsCalendar[9];
      $eventsNoviembre = $EventsCalendar[10];
      $eventsDiciembre = $EventsCalendar[11];

      $JoinTableUserDatas =  \DB::table('users')
      ->join('datos_personales', 'users.id', '=', 'datos_personales.id_usuario')
      ->join('datos_empleados', 'users.id', '=', 'datos_empleados.id_usuario')
      ->join('formacion_acedemica', 'users.id', '=', 'formacion_acedemica.id_usuario')
      ->select('*')
      ->get();

      #get Horarios
      $HorariosUser = Horarios::all();
      $arrayDaysDescansoUser = array();
      foreach ($HorariosUser as $keyHorariosUser) {
        if($keyHorariosUser->id_usuario == $idUserLogin){
          if($keyHorariosUser->bloq_horarioMedio1 != null){
            $diasDescanso = explode(", ", $keyHorariosUser->bloq_horarioMedio1);
            array_push($arrayDaysDescansoUser, $diasDescanso);
          }
          if($keyHorariosUser->bloq_horarioMedio2 != null){
            $diasDescanso2 = explode(", ", $keyHorariosUser->bloq_horarioMedio2);
            array_push($arrayDaysDescansoUser, $diasDescanso2);
          }
          if($keyHorariosUser->bloq_horarioMedio3 != null){
            $diasDescanso3 = explode(", ", $keyHorariosUser->bloq_horarioMedio3);
            array_push($arrayDaysDescansoUser, $diasDescanso3);
          }
        }
       
      }

      $arrayOfImages = array();
      # Get posts
        $Posts = $this->GetPost();
      # Decompiniendo array de post para obtener galeria de fotos que el usuario a publicado
        foreach ($Posts as $keyPostsImages) {
          if($keyPostsImages->id_usuario == $idUserLogin){
            if($keyPostsImages->imagen != ''){
              $ArrayImgeesGaleri = '';
              $ArrayImgeesGaleri = explode(",", $keyPostsImages->imagen);
              array_push($arrayOfImages,$ArrayImgeesGaleri);
            }
          }          
        }


        $ComentariosPermisos = ComentariosSolicitudes::all();
        $ComentariosEmergencias = ComentariosSolicitudes::all();
        $ComentariosSugerencias = ComentariosSolicitudes::all();
        $PrimerNumerDay = '';
        $SegundoNumerDay = '';

        $DescuentosSolicitudes = TiposDescuentos::all();
        $UsersAllsPersonalesData = DatosPersonales::all();

        $PermisosData = DetallesSolicitudes::where('id_tipo_solicitud', '=','1')->orderBy('id','desc')->get();
        $EmergenciasData = DetallesSolicitudes::where('id_tipo_solicitud', '=','2')->orderBy('id','desc')->get();
        $SugerenciasData = DetallesSolicitudes::where('id_tipo_solicitud', '=','3')->orderBy('id','desc')->get();

        
        $DataDias = $this->DaysVacaciones();
        $PrimerNumerDay = $DataDias[0];
        $SegundoNumerDay = $DataDias[1];

        #get Notificaciones y actividades
        $AllPost = Post::all();
        $Activities = $this->ActivitiesRecientes();
        $ActivitiesNotifys = $this->ActivitiesNotifysRecientes();
        $NotifisEventos = NotificacionesEventos::all();

        #get Color del panel del usuario d
        $Bguser  = $this->GetBackgroundPanelOfUSer();

        #get Foto User login
        $UsersDatasLogin = DatosPersonales::where('id_usuario','=', $idUserLogin)->get();
        $fotoUser = '';
        foreach ($UsersDatasLogin as $keyUsersDatasLogin) {
          $fotoUser =$keyUsersDatasLogin->foto;
        }
        

      return view('usuarios.solicitud-proceso',compact('idUserLogin','AllOnlineUser','EventsDayCalendar','UsersAlls','getCreateOnlineUsers','DayMothsYear','EventsCalendar','eventsEnero','eventsFebrero','eventsMarzo','eventsAbril','eventsMayo','eventsJunio','eventsJulio','eventsAgosto','eventsSeptiembre','eventsOctubre','eventsNoviembre','eventsDiciembre','JoinTableUserDatas','HorariosUser','arrayDaysDescansoUser','getUsers','Posts','arrayOfImages','Solicitudes','ComentariosPermisos','PermisosData','DescuentosSolicitudes','UsersAllsPersonalesData','EmergenciasData','ComentariosEmergencias','ComentariosSugerencias','SugerenciasData','PrimerNumerDay','SegundoNumerDay','Activities','NotifisEventos','AllPost','ActivitiesNotifys','Bguser','fotoUser'));
    }

    public function  DaysVacaciones(){

      #Obteniendo los dias de vacaciones del usuario
      $idUSerlogin = Auth::user()->id;
      $DaysVacacionesData = VacacionesUsers::where('id_usuario', '=', $idUSerlogin)->get();
      $dataArrayDias = array();

      foreach ($DaysVacacionesData as $keyDaysVacacionesData) {
        $diasVacaciones = $keyDaysVacacionesData->dias;
        #Si le quedan menos de 10 dias, antepondra un cero
        if($diasVacaciones <= 9){
          $PrimerNumerDay = 0;
          $SegundoNumerDay = $diasVacaciones;
          array_push($dataArrayDias, $PrimerNumerDay);
          array_push($dataArrayDias, $SegundoNumerDay);
        }else{
          #Si le quedan mas de 10 dias sustrae el primero y el segundo numero
          $PrimerNumerDay = substr($diasVacaciones, 0, -1);
          $SegundoNumerDay = substr($diasVacaciones, -1);
          array_push($dataArrayDias, $PrimerNumerDay);
          array_push($dataArrayDias, $SegundoNumerDay);
        }
      }

      return $dataArrayDias;

    }


    public function EvaluationToPersonal()
    {
      $idUserLogin = Auth::user()->id;
      // Creamos session de idLogiado para chat
      $getCreateOnlineUsers = $this->CreateGetOnlineUser($idUserLogin);
      //get all users online
      $AllOnlineUser = $this->UsersOnline();

      #GetDtaUser logiado
      $UsersLogiado = DatosPersonales::where('id_usuario', '=', $idUserLogin)->get();
      #Get Encargados de areas
      $encargadoArea = EncargadosAreas::where('id_encargardo', '=', $idUserLogin)->get();

      $UsersAlls = DatosPersonales::all();
      $JoinTableUserDatas =  \DB::table('datos_personales')
      ->join('datos_empleados', 'datos_personales.id_usuario', '=', 'datos_empleados.id_usuario')
      ->select('*')
      ->get();

      $HistorialEvaluaciones = HistorialEvaluaciones::all();

      $AllAdps = Adps::all();
      $HistoryAdps = HistorialAdps::all();
      $JoinTableUserDatosPersonalesDatosEmpleado =  \DB::table('datos_personales')
      ->join('datos_empleados', 'datos_personales.id_usuario', '=', 'datos_empleados.id_usuario')
      ->select('datos_personales.nombre','datos_personales.apellidos','datos_personales.foto','datos_personales.id_usuario','datos_empleados.correo_corporativo','datos_empleados.celular','datos_empleados.extencion','datos_empleados.area_departamento')
      ->get();

      $rankingSInApp = $this->rankingSinAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      $RankingGeneral = $rankingSInApp;
      // $rankingWithApp = $this->RankingWithAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      // $RankingGeneral = $rankingWithApp;

      #get Notificaciones y actividades
      $AllPost = Post::all();
      $Activities = $this->ActivitiesRecientes();
      $ActivitiesNotifys = $this->ActivitiesNotifysRecientes();
      $NotifisEventos = NotificacionesEventos::all();

      #get Color del panel del usuario d
      $Bguser  = $this->GetBackgroundPanelOfUSer();

      #get Foto User login
      $UsersDatasLogin = DatosPersonales::where('id_usuario','=', $idUserLogin)->get();
      $fotoUser = '';
      foreach ($UsersDatasLogin as $keyUsersDatasLogin) {
        $fotoUser =$keyUsersDatasLogin->foto;
      }

      return view('usuarios.evaluaciones-a-personal',compact('idUserLogin','AllOnlineUser','UsersLogiado','encargadoArea','UsersAlls','JoinTableUserDatas','HistorialEvaluaciones','JoinTableUserDatosPersonalesDatosEmpleado','RankingGeneral','Activities','NotifisEventos','AllPost','ActivitiesNotifys','Bguser','fotoUser'));
    }

    public function EvaluationToPersonalDetall($idEncargado, $id)
    {
      $idUserEvaluacion = $id;
      $UsersAlls = DatosPersonales::all();
      $UsersEvaluacion = DatosPersonales::where('id_usuario','=', $id)->get();
      $EncargadosOfAreas = EncargadosAreas::where('id_encargardo','=', $idEncargado)->get();
      $HistorialEvaluaciones = HistorialEvaluaciones::all();

      // $encargadoArea = array();
      $idUserLogin = Auth::user()->id;
      // Creamos session de idLogiado para chat
      $getCreateOnlineUsers = $this->CreateGetOnlineUser($idUserLogin);
      //get all users online
      $AllOnlineUser = $this->UsersOnline();

      // RANKING
      $AllAdps = Adps::all();
      $HistoryAdps = HistorialAdps::all();
      $JoinTableUserDatosPersonalesDatosEmpleado =  \DB::table('datos_personales')
      ->join('datos_empleados', 'datos_personales.id_usuario', '=', 'datos_empleados.id_usuario')
      ->select('datos_personales.nombre','datos_personales.apellidos','datos_personales.foto','datos_personales.id_usuario','datos_empleados.correo_corporativo','datos_empleados.celular','datos_empleados.extencion','datos_empleados.area_departamento')
      ->get();

      $rankingSInApp = $this->rankingSinAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      $RankingGeneral = $rankingSInApp;
      // $rankingWithApp = $this->RankingWithAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      // $RankingGeneral = $rankingWithApp;

      #get Notificaciones y actividades
      $AllPost = Post::all();
      $Activities = $this->ActivitiesRecientes();
      $ActivitiesNotifys = $this->ActivitiesNotifysRecientes();
      $NotifisEventos = NotificacionesEventos::all();

      #get Color del panel del usuario d
      $Bguser  = $this->GetBackgroundPanelOfUSer();

      #get Foto User login
      $UsersDatasLogin = DatosPersonales::where('id_usuario','=', $idUserLogin)->get();
      $fotoUser = '';
      foreach ($UsersDatasLogin as $keyUsersDatasLogin) {
        $fotoUser =$keyUsersDatasLogin->foto;
      }

      return view('usuarios.evaluaciones-a-personal-detall',compact('idUserLogin','AllOnlineUser','EncargadosOfAreas','UsersEvaluacion','UsersAlls','idUserEvaluacion','idEncargado','JoinTableUserDatosPersonalesDatosEmpleado','RankingGeneral','Activities','NotifisEventos','AllPost','ActivitiesNotifys','HistorialEvaluaciones','Bguser','fotoUser'));
    }

    public function StoreEvaluation(Request $request){
      $data = facedesrequest::all();
      $idUserLogin = Auth::user()->id;      
      $encargadoArea = EncargadosAreas::where('id_encargardo', '=', $idUserLogin)->get();
      $JoinTableUserDatas =  \DB::table('datos_personales')
      ->join('datos_empleados', 'datos_personales.id_usuario', '=', 'datos_empleados.id_usuario')
      ->select('*')
      ->get();

      #Get todos los datos enviados
      $ordernLimpieza = $request->nota_onePregu;
      $trabajoEquipo = $request->nota_twoPregu;
      $tiemposestablecidos = $request->nota_threPregu;
      $proactividad = $request->nota_fourPregu;
      $ActitudUser = $request->nota_fivePregu;
      $Puntualidad = $request->nota_sixPregu;
      $EvlocionUser = $request->nota_sevenPregu;
      $ConocimientosArea = $request->nota_EithPregu;
      $ImagenPersonal = $request->nota_ninePregu;
      $lenguajeVerbal = $request->nota_tenPregu;
      $idEncargado = $request->_idencargado;
      $idUserEvaluado = $request->_iduser;
      $UsersEvaluado = DatosPersonales::where('id_usuario','=', $idUserEvaluado)->get();

      #SUmamos los puntos de todas la preguntas
      $SubTotal = $ordernLimpieza + $trabajoEquipo + $tiemposestablecidos + $proactividad + $ActitudUser + $Puntualidad + $EvlocionUser + $ConocimientosArea + $ImagenPersonal + $lenguajeVerbal;

      #Dividimos el total de puntos entre el total de preguntas
      $Total = $SubTotal / 10;

      #Get mes siguiente del mes actual
      $date = new \Carbon\Carbon('next month');
      $dateMes = $date->format('m');

      #Get mes actual
      $carbon = new \Carbon\Carbon();
      $MesActual = $carbon->now()->format('m');

      #Creamo arreglo con todos los datos a guardar
      $dataSendEvaluation = array(
        'orden_limpieza_trabajo' => $ordernLimpieza,
        'trabajo_en_equipo' => $trabajoEquipo,
        'cumplimiento_tiempos_entrega' => $tiemposestablecidos,
        'proactividad' => $proactividad,
        'actitud_antes_estres_dificultades' => $ActitudUser,
        'puntualidad_entrada_salida' => $Puntualidad,
        'evaluacion_desempeno' => $EvlocionUser,
        'conocimientos_necesarios' => $ConocimientosArea,
        'imagen_higiene_personal' => $ImagenPersonal,
        'lenguaje_verbal' => $lenguajeVerbal,
        'total' => $Total,
        'evaluacion_realizada' => '1',
        'mes_evaluacion' => $MesActual,
        'proxima_evaluacion' => $dateMes,
        'id_usuario' => $idUserEvaluado,
        'id_encargado' => $idEncargado,
      );

      #Guardamos la evaluacion
      $saveEvaluation = new HistorialEvaluaciones($dataSendEvaluation);
      $saveEvaluation->save();

      #Despues de guardar la evaluacion veirficaremos si el usuario que califica
      #ya termino sus evaluaciones. Si no ha terminado mostrar una vista donde
      #mostrara las evalauucines faltantes y hechas, pero si ya las termino 
      #Mostrtara la pantalla de que ya termino   

      $HistorialEvaluaciones = HistorialEvaluaciones::all();
      # Get total de usuarios que le pertenecen al encargado
      $totalUsersPorEncargado = 0;
      foreach ($encargadoArea as $encargados) {
        foreach ($JoinTableUserDatas as $users) {
          if($users->jefe_inmediato == $encargados->id_encargardo){
            $totalUsersPorEncargado = $totalUsersPorEncargado+1;
          }
        }
      }  

      # Verificamos cuantas evaluaciones ya fueron realizadas por el usuario
      $totalUsuariosYaEvaluados = 0;
      foreach ($encargadoArea as $encargados) {
        foreach ($JoinTableUserDatas as $users) {
          if($users->jefe_inmediato == $encargados->id_encargardo){
            $validaIdUser = '';
            foreach ($HistorialEvaluaciones as $evaluaciones) {
              if($evaluaciones->id_usuario == $users->id_usuario){
                $carbon = new \Carbon\Carbon();
                $MesActual = $carbon->now()->format('m');
                if($evaluaciones->proxima_evaluacion > $MesActual){
                  if($evaluaciones->mes_evaluacion == $MesActual){
                    $totalUsuariosYaEvaluados = $totalUsuariosYaEvaluados+1;
                  }
                }
              }
            }
          }
        }
      }

      #Si no ha terminado mostrar evaluaciones hechas y por hacer
      if($totalUsersPorEncargado != $totalUsuariosYaEvaluados){
        foreach ($UsersEvaluado as $keyUsersEvaluado) {
          Session::flash('Evaluacion_Users', $keyUsersEvaluado->nombre.' '.$keyUsersEvaluado->apellidos);
          Session::flash('Evaluacion_UsersFoto', $keyUsersEvaluado->foto);
          Session::flash('Evaluacion_UsersId', $keyUsersEvaluado->id_usuario);
        }        
        return redirect('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/evaluacion-a-personal-evaluados');

      }else{
        return redirect('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/finish-evaluation');
      }

    }

    public function EvaluationToPersonalEvaluados()
    {
      $UsersAlls = DatosPersonales::all();
      $idUserLogin = Auth::user()->id;

      #GetDtaUser logiado
      $UsersLogiado = DatosPersonales::where('id_usuario', '=', $idUserLogin)->get();
      #Get Encargados de areas
      $encargadoArea = EncargadosAreas::where('id_encargardo', '=', $idUserLogin)->get();
      $JoinTableUserDatas =  \DB::table('datos_personales')
      ->join('datos_empleados', 'datos_personales.id_usuario', '=', 'datos_empleados.id_usuario')
      ->select('*')
      ->get();

      $HistorialEvaluaciones = HistorialEvaluaciones::all();

      // Creamos session de idLogiado para chat
      $getCreateOnlineUsers = $this->CreateGetOnlineUser($idUserLogin);
      //get all users online
      $AllOnlineUser = $this->UsersOnline();

      // RANKING
      $AllAdps = Adps::all();
      $HistoryAdps = HistorialAdps::all();
      $JoinTableUserDatosPersonalesDatosEmpleado =  \DB::table('datos_personales')
      ->join('datos_empleados', 'datos_personales.id_usuario', '=', 'datos_empleados.id_usuario')
      ->select('datos_personales.nombre','datos_personales.apellidos','datos_personales.foto','datos_personales.id_usuario','datos_empleados.correo_corporativo','datos_empleados.celular','datos_empleados.extencion','datos_empleados.area_departamento')
      ->get();

      $rankingSInApp = $this->rankingSinAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      $RankingGeneral = $rankingSInApp;
      // $rankingWithApp = $this->RankingWithAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      // $RankingGeneral = $rankingWithApp;

      #get Notificaciones y actividades
      $AllPost = Post::all();
      $Activities = $this->ActivitiesRecientes();
      $ActivitiesNotifys = $this->ActivitiesNotifysRecientes();
      $NotifisEventos = NotificacionesEventos::all();

      #get Color del panel del usuario d
      $Bguser  = $this->GetBackgroundPanelOfUSer();

      #get Foto User login
      $UsersDatasLogin = DatosPersonales::where('id_usuario','=', $idUserLogin)->get();
      $fotoUser = '';
      foreach ($UsersDatasLogin as $keyUsersDatasLogin) {
        $fotoUser =$keyUsersDatasLogin->foto;
      }

      return view('usuarios.evaluaciones-a-personal-evaluados',compact('idUserLogin','AllOnlineUser','UsersAlls','UsersEvaluacion','encargadoArea','UsersLogiado','JoinTableUserDatas','HistorialEvaluaciones','JoinTableUserDatosPersonalesDatosEmpleado','RankingGeneral','Activities','NotifisEventos','AllPost','ActivitiesNotifys','Bguser','fotoUser'));
    }

    public function FinishEvaluation()
    {
      $idUserLogin = Auth::user()->id;
      // Creamos session de idLogiado para chat
      $getCreateOnlineUsers = $this->CreateGetOnlineUser($idUserLogin);
      //get all users online
      $AllOnlineUser = $this->UsersOnline();

      #get Notificaciones y actividades
      $AllPost = Post::all();
      $Activities = $this->ActivitiesRecientes();
      $ActivitiesNotifys = $this->ActivitiesNotifysRecientes();
      $NotifisEventos = NotificacionesEventos::all();

      #get Color del panel del usuario d
      $Bguser  = $this->GetBackgroundPanelOfUSer();

      #get Foto User login
      $UsersDatasLogin = DatosPersonales::where('id_usuario','=', $idUserLogin)->get();
      $fotoUser = '';
      foreach ($UsersDatasLogin as $keyUsersDatasLogin) {
        $fotoUser =$keyUsersDatasLogin->foto;
      }

      return view('usuarios.finish-evaluaction',compact('idUserLogin','AllOnlineUser','Activities','NotifisEventos','AllPost','ActivitiesNotifys','Bguser','fotoUser'));
    }

    public function GetPost()
    {
      $DataPosts = Post::select('*')
        ->orderBy('id', 'desc')
        ->get();

      return $DataPosts;
    }

    public function getLikesPost(){
      $DataLikes = LikesPosts::all();
      $arrayUsersLikes = array();

      foreach ($DataLikes as $keyDataLikes) {
        $porciones = explode(",", $keyDataLikes->id_usuarios_likes);
        $NewArrayDataLikes = array('id' => $keyDataLikes->id, 'id_publicacion' => $keyDataLikes->id_publicacion,'id_usuarios_likes' => $porciones,'total_likes' => $keyDataLikes->total_likes,);
        array_push($arrayUsersLikes, $NewArrayDataLikes);
      }

      // dd($arrayUsersLikes);

      return $arrayUsersLikes;

    }

    public function getComentsPost(){      

      $JoinTableUserPostsComents =  \DB::table('users')
      ->join('datos_personales', 'users.id', '=', 'datos_personales.id_usuario')
      ->join('comentarios_post', 'users.id', '=', 'comentarios_post.id_usuario')
      ->select('users.name','datos_personales.foto','datos_personales.id_usuario','comentarios_post.comentarios','comentarios_post.id_publicacion')
      ->get();

      return $JoinTableUserPostsComents;
    }

    public function StoreEntrada(Request $request){
      if($request->ajax()){
        $dataIdUser = $request->idUserLoginMarcar;
        $asistencias = AsistenciaUsers::all();
        $validaUserMarcoEntrada = false;

        # Configuramos la hora local
        date_default_timezone_set('America/Monterrey');
        $fechaActual = date('Y-m-d');
        $dateHoraEntrada =  date('H:i');

        # Verificamos entre todas las asistencias si el usuario que quiere registrar
        # ya habia registrado la entra en el mismo dia
        foreach ($asistencias as $keyAsistencias) {
          if($keyAsistencias->id_usuario == $dataIdUser){
            if($keyAsistencias->fecha == $fechaActual){
              $validaUserMarcoEntrada = true;
            }
          }          
        }

        #Si no habia registrado entrada, crea la entrada, si no, manda un  mensaje en la vista
        if($validaUserMarcoEntrada == false){
          $dataMarcarEntrada = array(
            'hora_entrada' => $dateHoraEntrada,
            'fecha' => $fechaActual,
            'id_usuario' => $dataIdUser,
          );

          $createHoraEntrada = new AsistenciaUsers($dataMarcarEntrada);
          $createHoraEntrada->save();
          echo json_encode('false');
        }else{
          echo json_encode('true');
        }        

        
      }
    }

    public function StoreSalida(Request $request){
      if($request->ajax()){
        $dataIdUser = $request->idUserLoginMarcar;

        # Configuramos la hora local
        date_default_timezone_set('America/Monterrey');
        $fechaActual = date('Y-m-d');
        $dateHoraSalida =  date('H:i');

        #Obtengo la hora de salida
        $dataMarcarSalida = array(
          'hora_salida' => $dateHoraSalida,
          'fecha' => $fechaActual,
        );

        #Actualizo la hora de salida del usuario
        $updateSalidaUser = \DB::table('asistencia_usuarios')
          ->where('id_usuario', '=', $dataIdUser)
          ->where('fecha', '=', $fechaActual)
          ->update($dataMarcarSalida);

        echo json_encode('true');
      }
    }


    public function StoreComentsSugerencias(Request $request){

      $COmentSugerencia = $request->descrip_comen_suge;
      $idUserSugerencia = $request->id_user_sugerencia;
      $idSolicitudSugerencia = $request->id_solicitudse;
      $imageName = '';

      $fileFoto = $request->file('fileinputimage');
      $fileDocuemnt = $request->file('fileinputdocuemnt');

      #Vericamos si existe una imagen o documento
      if($fileFoto != null){

        $nombreFoto = $fileFoto->getClientOriginalName();
        $fileNameFoto = rand(11,99999);
        $imageName = $fileNameFoto.'.'.$request->file('fileinputimage')->getClientOriginalExtension();
        $request->file('fileinputimage')->move(
            base_path() . '\public\assets\images\documents', $imageName
        );

      }elseif($fileDocuemnt != null){

        $nombreFoto = $fileFoto->getClientOriginalName();
        $fileNameDocuemnt = rand(11,99999);
        $imageName = $fileNameDocuemnt.'.'.$request->file('fileinputdocuemnt')->getClientOriginalExtension();
        $request->file('fileinputdocuemnt')->move(
            base_path() . '\public\assets\images\documents', $imageName
        );

      }
     
     #creamo array con todos los datos que almacenanremos en la tabla comentarios solicitudes
      $dataCOmentSugerencia = array(
        'conversation' => $COmentSugerencia,
        'documentos_adjuntos' => $imageName,
        'id_usuario' => $idUserSugerencia,
        'id_detalle_solicitud' => $idSolicitudSugerencia,
      );

      $createComentSugerencia = new ComentariosSolicitudes($dataCOmentSugerencia);
      $createComentSugerencia->save();
      Session::flash('Create_Comentario', "Su comentario se ha enviado");
      return back()->withInput();

    }

    public function previewContPost($idusers,$idpost){
      $idUserLogin = Auth::user()->id;
      $JoinTableUserPosts =  \DB::table('users')
      ->join('datos_personales', 'users.id', '=', 'datos_personales.id_usuario')
      # ->join('datos_empleados', 'users.id', '=', 'datos_empleados.id_usuario')
      ->select('*')
      ->get();

      $getPost = Post::where('id','=',$idpost)->get();
      $Likes = $this->getLikesPost();
      $Coments = $this->getComentsPost();
      $arrayOfImages = array();
      $ArrayOfDocuemnts = array();

      foreach ($getPost as $keyPostsImages) {
        if($keyPostsImages->id_usuario == $idusers){
          if($keyPostsImages->imagen != ''){
            $ArrayImgeesGaleri = '';
            $ArrayImgeesGaleri = explode(",", $keyPostsImages->imagen);
            array_push($arrayOfImages,$ArrayImgeesGaleri);
          }
        }
        if($keyPostsImages->id_usuario == $idusers){
          if($keyPostsImages->documentos != ''){
            $ArrayDocuemnts = explode(",", $keyPostsImages->documentos);
            array_push($ArrayOfDocuemnts,$ArrayDocuemnts);
          }
        }
        
        
      }

      #get Notificaciones y actividades
      $AllPost = Post::all();
      $Activities = $this->ActivitiesRecientes();
      $ActivitiesNotifys = $this->ActivitiesNotifysRecientes();
      $NotifisEventos = NotificacionesEventos::all();

      #get Color del panel del usuario d
      $Bguser  = $this->GetBackgroundPanelOfUSer();

      #get Foto User login
      $UsersDatasLogin = DatosPersonales::where('id_usuario','=', $idUserLogin)->get();
      $fotoUser = '';
      foreach ($UsersDatasLogin as $keyUsersDatasLogin) {
        $fotoUser =$keyUsersDatasLogin->foto;
      }

      return view('usuarios.previuw-detall', compact('JoinTableUserPosts','idusers','idpost','getPost','Likes','Coments','idUserLogin','arrayOfImages','ArrayOfDocuemnts','Activities','NotifisEventos','AllPost','ActivitiesNotifys','Bguser','fotoUser'));
    }

    public function notifyView(Request $request)
    {
      if($request->ajax()) {
        $idNotificacion = $request->idnotifi;
        $idUserNotificacion = $request->iduserNotifi;

        $getNotificacion = HistorialActividadesRecientes::where('id','=',$idNotificacion)->get();
        $idUserViewsNotify = '';
        #bucamos los usuarios que ya vieron la notificaicon
        foreach ($getNotificacion as $keyGetNotificacion) {
          $idUserViewsNotify = $keyGetNotificacion->id_users_view;
        }

        #Si no lo encuentra guarda el usuario que vio la notificacion
        if($idUserViewsNotify == ''){
          $dataUpdateNotificacion = array(
            'id_users_view' => $idUserNotificacion,
          );
          $UpdateNotificacion= \DB::table('historial_actividades_recientes')
            ->where('id', '=', $idNotificacion)
            ->update($dataUpdateNotificacion);

          echo json_encode('vista');

        }elseif($idUserViewsNotify != ''){
          #si encuentra algun usuario, verifica si el que viene ya existe, si existe
          #solo retorna a su respectiva pagina
          $decomponerIds = explode(',', $idUserViewsNotify);
          if(in_array($idUserNotificacion, $decomponerIds)){
            echo json_encode('vista');
          }else{
            #Si no es el mismo concatena el numero usuario con los anteriores
            # y actualiza la notificacion
            $newUserView = $idUserViewsNotify.','.$idUserNotificacion;
            $dataUpdateNotificacion = array(
              'id_users_view' => $newUserView,
            );
            $UpdateNotificacion= \DB::table('historial_actividades_recientes')
              ->where('id', '=', $idNotificacion)
              ->update($dataUpdateNotificacion);

            echo json_encode('vista');
          }
        }

        
        
      }

    }



    public function ChangeColorBGUser(Request $request)
    {
      $IDUserChancheColor = $request->idUserChangeCOlor;
      $BgUser = $request->dataColor;

      $dataUpdateBackgrounf = array(
        'bg_user' => $BgUser,
      );

      $UpdateBackground= \DB::table('datos_personales')
        ->where('id_usuario', '=', $IDUserChancheColor)
        ->update($dataUpdateBackgrounf);

     echo json_encode('cambiado');
    }

    public function UploadArchivos(Request $request){
      // $fileImages = facedesrequest::all();
      $dataELe = array();

      $fileImages = $request->file('file'); 
      $imageName = $fileImages->getClientOriginalName();
      $imageNameType = $fileImages->getClientOriginalExtension();

      $SaveFile = \Storage::disk('ubUploadsChange')->put('documents/'.$imageName,  \File::get($fileImages));

      $GetImage  = \Storage::disk('ubUploadsChange')->get('/documents/'.$imageName.'');
      $DataImgae = base64_encode($GetImage);
      $file = 'data:'.$imageNameType.';base64,'.$DataImgae.'';
      $fileType = $imageNameType;

      $dataArchivoCreate = array('file' => $file, 'fileType' => $fileType);
      array_push($dataELe,$dataArchivoCreate);

      echo json_encode($dataELe);

    }


    public function loadUserHome(){
      # get all users
      $getUsers = $this->AllUsers();

      foreach($getUsers as $users){
        $GetImage  = \Storage::disk('ubUploadsChange')->get('/profiles/'.$users->foto.'');
        $DataImgae = base64_encode($GetImage);
        $foto = 'background-image: url("data:'.$users->mime.';base64,'.$DataImgae.'")';

        $GetContentUser = "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 AlluserReegitradosPorBloque'><a href='#!' data-iduserchat='$users->id_usuario'><div class='col-xs-12 col-sm-6 col-md-4 col-lg-4 vloqImageUser' style='$foto'></div></a></div>";

        echo $GetContentUser;
        
      }
          
    }

}
