<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as facedesrequest;

use Auth;
use App\Sucursales;
use App\Marcas;
use App\Areas;
use App\Roles;
use App\User;
use Session;
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
use App\RecordatoriosAdmin;
use App\ComentariosSolicitudes;
use App\DatosPersonales;
use App\VacacionesUsers;
use App\DatosEmpleados;
use App\EncargadosAreas;
use App\HistorialEvaluaciones;
use App\Adps;
use App\HistorialAdps;
use App\NotificacionesEventos;
use App\HistorialActividadesRecientes;
use App\Documentos;
// use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response ;



class AdminController extends Controller
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

    public function ActivitiesRecientes(){
     date_default_timezone_set('America/Monterrey');
     $fechaMesActual = date('Y-m-d');

     $GetActividades = HistorialActividadesRecientes::orderBy('id', 'desc')->where('created_at', 'like', '%'.$fechaMesActual.'%')->get();
     return $GetActividades;
    }

    public function ActivitiesRecientesPorFecha(){

     date_default_timezone_set('America/Monterrey');
     $fechaDiaAnterior =  date("Y-m-d", strtotime("yesterday"));

     $GetActividadesFechas = HistorialActividadesRecientes::where('created_at','like','%'.$fechaDiaAnterior.'%')->orderBy('id', 'desc')->get();

     $totalNotifciaciones = $this->ValidaNotificaciones($GetActividadesFechas);

     echo json_encode($totalNotifciaciones);

    }

    public function HistorialActividadesRecientes($fecha){

     $GetActividadesFechas = HistorialActividadesRecientes::where('created_at','like','%'.$fecha.'%')->orderBy('id', 'desc')->get();

     return view('admin.history-notificaciones', compact('GetActividadesFechas'));     
    }

    public function HistorialActividadesRecientesAll(){

     $GetActividadesFechas = HistorialActividadesRecientes::orderBy('id', 'desc')->get();

     return view('admin.history-notificaciones', compact('GetActividadesFechas'));     
    }

    public function ActivitiesNotifysRecientes(){
     $GetActividades = HistorialActividadesRecientes::orderBy('id', 'desc')->get();
     return $GetActividades;
    }

    public function Home()
    {
        $idUserLogin = Auth::user()->id;
        $EventsDayCalendar = EventosCalendario::all();
        $Recordatorios = RecordatoriosAdmin::all();
        $UsersAlls = User::all();
        $UsersWihtChat = User::all();
        $chat = Chats::where('id_user','=',$idUserLogin)->get();        
        $grpupChat = array();

        $getUsers = $this->AllUsers();
        $ConversationBetwwenUser = Chats::where('id_user','=',$idUserLogin)->get();
        $ConversationBetwwenUser2 = Chats::where('id_user_conversation','=',$idUserLogin)->get();

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


        #Get actividades recientes
        $Activities = $this->ActivitiesRecientes();

        $totalNotifciaciones = $this->ValidaNotificaciones($Activities);

        date_default_timezone_set('America/Monterrey');
        $fechaMesActual = date('Y-m-d');

        $DiaASiguiente= new \Carbon\Carbon('yesterday');
        $fechaDiaSiguiente = $DiaASiguiente->format('Y-m-d');

        $ActivitiesNotifys = $this->ActivitiesNotifysRecientes();
        $NotifisEventos = NotificacionesEventos::all();

        #get Solicitudes de llegadas tarde
        $HistoryLLegadasTardes = AsistenciaUsers::where('fecha', '=', $fechaMesActual)->where('hora_entrada', '>', '08:00')->get();
        #get Solicitudes de emergencia
        $EmergenciasData = DetallesSolicitudes::where('id_tipo_solicitud', '=','2')->where('created_at', 'like','%'.$fechaMesActual.'%')->orderBy('id','desc')->get();
        #get Solicitudes permisos
        $PermisosDataSoli = DetallesSolicitudes::where('id_tipo_solicitud', '=','1')->where('created_at', 'like', '%'.$fechaMesActual.'%')->orderBy('id','desc')->get();
        # Obtener notifiaciones creadas
        $GetNotificaciones = $this->getNotificaciones();
        return view('admin.home', compact('idUserLogin','EventsDayCalendar','UsersAlls','DayMothsYear','EventsCalendar','eventsEnero','eventsFebrero','eventsMarzo','eventsAbril','eventsMayo','eventsJunio','eventsJulio','eventsAgosto','eventsSeptiembre','eventsOctubre','eventsNoviembre','eventsDiciembre','JoinTableUserDatas','Recordatorios','GetUltimateMensage','getUsers','Activities','ActivitiesNotifys','NotifisEventos','totalNotifciaciones','fechaMesActual','fechaDiaSiguiente','HistoryLLegadasTardes','EmergenciasData','PermisosDataSoli','GetNotificaciones'));
    }

    public function ValidaNotificaciones($getNotifis){
      $totalNotifciaciones = 0;
      foreach ($getNotifis as $activi) {
        if($activi->tipo_actividad == 4){
          $idUserLo = Auth::user()->id;
          $idValidaView = false;
          $userViews = explode(',', $activi->id_users_view);
          if($userViews == $idUserLo){
            $idValidaView = true;
          }
          if( $idValidaView == false){
            $totalNotifciaciones = $totalNotifciaciones+1;
          }
        }

        if($activi->tipo_actividad == 5){
          $idUserLo = Auth::user()->id;
          $idValidaView = false;
          $userViews = explode(',', $activi->id_users_view);
          if($userViews == $idUserLo){
            $idValidaView = true;
          }
          if( $idValidaView == false){
            $totalNotifciaciones = $totalNotifciaciones+1;
          }
        }

        if($activi->tipo_actividad == 13){
          $idUserLo = Auth::user()->id;
          $idValidaView = false;
          $userViews = explode(',', $activi->id_users_view);
          if($userViews == $idUserLo){
            $idValidaView = true;
          }
          if( $idValidaView == false){
            $totalNotifciaciones = $totalNotifciaciones+1;
          }
        }

        if($activi->tipo_actividad == 10){
          $idUserLo = Auth::user()->id;
          $idValidaView = false;
          $userViews = explode(',', $activi->id_users_view);
          if($userViews == $idUserLo){
            $idValidaView = true;
          }
          if( $idValidaView == false){
            $totalNotifciaciones = $totalNotifciaciones+1;
          }
        }

        if($activi->tipo_actividad == 14){
          $idUserLo = Auth::user()->id;
          $idValidaView = false;
          $userViews = explode(',', $activi->id_users_view);
          if($userViews == $idUserLo){
            $idValidaView = true;
          }
          if( $idValidaView == false){
            $totalNotifciaciones = $totalNotifciaciones+1;
          }
        }

        if($activi->tipo_actividad == 11){
          $idUserLo = Auth::user()->id;
          $idValidaView = false;
          $userViews = explode(',', $activi->id_users_view);
          if($userViews == $idUserLo){
            $idValidaView = true;
          }
          if( $idValidaView == false){
            if($activi->id_usuario == Auth::user()->id){
              $totalNotifciaciones = $totalNotifciaciones+1;
            }
            
          }
        }

        if($activi->tipo_actividad == 12){
          $idUserLo = Auth::user()->id;
          $idValidaView = false;
          $userViews = explode(',', $activi->id_users_view);
          if($userViews == $idUserLo){
            $idValidaView = true;
          }
          if( $idValidaView == false){
            if($activi->id_usuario == Auth::user()->id){
             $totalNotifciaciones = $totalNotifciaciones+1;
            }
          }
        }
      }

      return $totalNotifciaciones;
    }
    
    public function Board()
    {
      $likesPost = LikesPosts::all();
      $EventsDayCalendar = EventosCalendario::all();
      $eventosNOtify = NotificacionesEventos::all();
      
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

        $newArrayDats = array('id' => $keyPosts->id,'descripcion' => $keyPosts->descripcion,'imagen' => $ArrayImgees,'documentos' => $ArrayDocuemnts, 'id_tipo_publicacion' => $keyPosts->id_tipo_publicacion, 'mime' => $keyPosts->mime, 'id_tipo_evento' => $keyPosts->id_tipo_evento, 'descripcion' => $keyPosts->descripcion,'id_usuario' => $keyPosts->id_usuario,'created_at' => $dateCreado->toDateTimeString(),'updated_at' => $dateUpdate->toDateTimeString());
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

      #Get notificaciones
      $GetActividadesFechas = HistorialActividadesRecientes::orderBy('id', 'desc')->get();


      return view('admin.board',compact('idUserLogin','AllOnlineUser','Posts','DataArrayPostPar','DataArrayPostImpar','likesPost','JoinTableUserPosts','Likes','Coments','PostPersonalizados','EventsCalendar','eventsEnero','eventsFebrero','eventsMarzo','eventsAbril','eventsMayo','eventsJunio','eventsJulio','eventsAgosto','eventsSeptiembre','eventsOctubre','eventsNoviembre','eventsDiciembre','DayMothsYear','EventsDayCalendar','getUsers','eventosNOtify','GetActividadesFechas'));
    }

    public function ChatAdmin()
    {
        $idUserLogin = Auth::user()->id;
        $UsersWihtChat = User::all();
        $chat = Chats::where('id_user','=',$idUserLogin)->get();        
        $grpupChat = array();

        # get all users online
        $AllOnlineUser = $this->UsersOnline();

        $getUsers = $this->AllUsers();
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



        return view('admin.chatAdmin',compact('idUserLogin','EventsDayCalendar','UsersAlls','DayMothsYear','EventsCalendar','eventsEnero','eventsFebrero','eventsMarzo','eventsAbril','eventsMayo','eventsJunio','eventsJulio','eventsAgosto','eventsSeptiembre','eventsOctubre','eventsNoviembre','eventsDiciembre','JoinTableUserDatas','Recordatorios','GetUltimateMensage','getUsers','AllOnlineUser'));
    }

    public function Sugerencias()
    {

      $ComentariosSugerencias = ComentariosSolicitudes::all();
      $SugerenciasData = DetallesSolicitudes::where('id_tipo_solicitud', '=','3')->orderBy('id','desc')->get();

      $UsersAlls = DatosPersonales::all();

      $JoinTableUserDatasSugerenciasVerifiView =  \DB::table('datos_personales')
      ->join('detalles_solicitudes', 'datos_personales.id_usuario', '=', 'detalles_solicitudes.id_usuario')
      ->select('*')
      ->where('id_tipo_solicitud', '=','3')
      ->whereNull('solicitud_vista')
      ->get();

      $CantidadSugerenciasNovistas = count($JoinTableUserDatasSugerenciasVerifiView);

      # Obtener notifiaciones creadas
      $GetNotificaciones = $this->getNotificaciones();

      return view('admin.sugerencias',compact('ComentariosSugerencias','UsersAlls','CantidadSugerenciasNovistas','SugerenciasData','GetNotificaciones'));
    }

    public function Emergencias()
    {
      $ComentariosEmergencias = ComentariosSolicitudes::all();
      $EmergenciasData = DetallesSolicitudes::where('id_tipo_solicitud', '=','2')->orderBy('id','desc')->get();

      $UsersAlls = DatosPersonales::all();

      $JoinTableUserDatasEmergenciasVerifiView =  \DB::table('datos_personales')
      ->join('detalles_solicitudes', 'datos_personales.id_usuario', '=', 'detalles_solicitudes.id_usuario')
      ->select('*')
      ->where('id_tipo_solicitud', '=','2')
      ->whereNull('solicitud_vista')
      ->get();


      $CantidadEmergenciasNovistas = count($JoinTableUserDatasEmergenciasVerifiView);

      # Obtener notifiaciones creadas
      $GetNotificaciones = $this->getNotificaciones();

      return view('admin.emergencias',compact('ComentariosEmergencias','UsersAlls','CantidadEmergenciasNovistas','EmergenciasData','GetNotificaciones'));
    }

    public function EmergenciasFechas($fechaemergenci)
    {
      $ComentariosEmergencias = ComentariosSolicitudes::all();
      $EmergenciasData = DetallesSolicitudes::where('id_tipo_solicitud', '=','2')->where('created_at', 'like','%'.$fechaemergenci.'%')->orderBy('id','desc')->get();

      $UsersAlls = DatosPersonales::all();

      $JoinTableUserDatasEmergenciasVerifiView =  \DB::table('datos_personales')
      ->join('detalles_solicitudes', 'datos_personales.id_usuario', '=', 'detalles_solicitudes.id_usuario')
      ->select('*')
      ->where('id_tipo_solicitud', '=','2')
      ->whereNull('solicitud_vista')
      ->get();


      $CantidadEmergenciasNovistas = count($JoinTableUserDatasEmergenciasVerifiView);

      return view('admin.emergencias',compact('ComentariosEmergencias','UsersAlls','CantidadEmergenciasNovistas','EmergenciasData'));
    }

    public function emergenciasTotalsFechas($fechaMesActual){
      #get Solicitudes de emergencia
      $EmergenciasData = DetallesSolicitudes::where('id_tipo_solicitud', '=','2')->where('created_at', 'like','%'.$fechaMesActual.'%')->orderBy('id','desc')->get();
      $totalEmergenciasYesterday = count($EmergenciasData);
      echo json_encode($totalEmergenciasYesterday);
    }

    public function SolicitudPermisos()
    {
      $ComentariosPermisos = ComentariosSolicitudes::all();
      $PermisosData = DetallesSolicitudes::where('id_tipo_solicitud', '=','1')->orderBy('id','desc')->get();

      $UsersAlls = DatosPersonales::all();
      $DescuentosSolicitudes = TiposDescuentos::all();

      $JoinTableUserDatasPermmisosVerifiView =  \DB::table('datos_personales')
      ->join('detalles_solicitudes', 'datos_personales.id_usuario', '=', 'detalles_solicitudes.id_usuario')
      ->select('*')
      ->where('id_tipo_solicitud', '=','1')
      ->whereNull('solicitud_vista')
      ->get();


      $CantidadPermisosNovistas = count($JoinTableUserDatasPermmisosVerifiView);

      # Obtener notifiaciones creadas
      $GetNotificaciones = $this->getNotificaciones();

      return view('admin.solicitud-permisos',compact('ComentariosPermisos','UsersAlls','CantidadPermisosNovistas','PermisosData','JoinTableUserDatasPermmisosVerifiView','DescuentosSolicitudes','GetNotificaciones'));
    }

    public function SolicitudPermisosFecha($fechapermiso)
    {
      $ComentariosPermisos = ComentariosSolicitudes::all();
      $PermisosData = DetallesSolicitudes::where('id_tipo_solicitud', '=','1')->where('created_at', 'like','%'.$fechapermiso.'%')->orderBy('id','desc')->get();

      $UsersAlls = DatosPersonales::all();
      $DescuentosSolicitudes = TiposDescuentos::all();

      $JoinTableUserDatasPermmisosVerifiView =  \DB::table('datos_personales')
      ->join('detalles_solicitudes', 'datos_personales.id_usuario', '=', 'detalles_solicitudes.id_usuario')
      ->select('*')
      ->where('id_tipo_solicitud', '=','1')
      ->whereNull('solicitud_vista')
      ->get();


      $CantidadPermisosNovistas = count($JoinTableUserDatasPermmisosVerifiView);

      return view('admin.solicitud-permisos',compact('ComentariosPermisos','UsersAlls','CantidadPermisosNovistas','PermisosData','JoinTableUserDatasPermmisosVerifiView','DescuentosSolicitudes'));
    }

    public function PermisosTotalsFechas($fechaMesActual){
      #get Solicitudes de emergencia
      $PermisosData = DetallesSolicitudes::where('id_tipo_solicitud', '=','1')->where('created_at', 'like','%'.$fechaMesActual.'%')->orderBy('id','desc')->get();
      $totalPermisosYesterday = count($PermisosData);
      echo json_encode($totalPermisosYesterday);
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
            $diasDescanso = explode(",", $keyHorariosUser->bloq_horarioMedio1);
            array_push($arrayDaysDescansoUser, $diasDescanso);
          }
          if($keyHorariosUser->bloq_horarioMedio2 != null){
            $diasDescanso2 = explode(",", $keyHorariosUser->bloq_horarioMedio2);
            array_push($arrayDaysDescansoUser, $diasDescanso2);
          }
          if($keyHorariosUser->bloq_horarioMedio3 != null){
            $diasDescanso3 = explode(",", $keyHorariosUser->bloq_horarioMedio3);
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

        # Obtener notifiaciones creadas
        $GetNotificaciones = $this->getNotificaciones();
        
      return view('admin.calendario',compact('idUserLogin','AllOnlineUser','EventsDayCalendar','UsersAlls','getCreateOnlineUsers','DayMothsYear','EventsCalendar','eventsEnero','eventsFebrero','eventsMarzo','eventsAbril','eventsMayo','eventsJunio','eventsJulio','eventsAgosto','eventsSeptiembre','eventsOctubre','eventsNoviembre','eventsDiciembre','JoinTableUserDatas','HorariosUser','arrayDaysDescansoUser','getUsers','Posts','arrayOfImages','Solicitudes','DatosPersonales','EventsDayCalendarOrder','GetNotificaciones'));
    }

    public function Documentos()
    {
      $ArrayCarpetas = array();
       $idurl ='';
       $idurl2 ='';
       $idurl3 ='';
       $idurl4 = '';
       $idurl5 = '';
       $idurl6 = '';

       #directorios de archivos
       $getDirectoryArchivos = Documentos::where('ubicacion_archivo','=','documents-admin/')->get();
       #get directorios carpetas
       $getDirectoryCarpetas = Documentos::where('ubicacion_anterior','=','documents-admin/')->where('type_upload','=','carpeta')->get();
             
       # OBTENER LAS CARPETAS QUE EXISTEN EN UNA CARPETA, DESCOMPONEMOS EL ARRAY OBTENIDO DE TODAS LAS CARPERTAS QUE EXITEN
       # EN EL DIRECTORIO Y CON BASENAME OBTENEMOS EL NOMBRE DE LA CARPETA
       foreach ($getDirectoryCarpetas as $keygetDirectoryCarpetas) {
         $nameCarptea = $keygetDirectoryCarpetas->nombre_archivo;
         $nameCarptea2 = $keygetDirectoryCarpetas->ubicacion_archivo;
         $randomNmm = rand(5, 1232335);

         $dataCarpetas = array('nameCarpeta' => $nameCarptea,'nameCarpeta2' => $nameCarptea2,'VaueContenido' => '1','identiFI' => $randomNmm);
         array_push($ArrayCarpetas,$dataCarpetas);
       }

       # Obtener notifiaciones creadas
       $GetNotificaciones = $this->getNotificaciones();

       return view('admin.documentos',compact('getDirectoryArchivos','getDirectoryCarpetas','ArrayCarpetas','idurl','idurl2','idurl3','idurl4','idurl5','idurl6','GetNotificaciones'));
    }

    public function DocumentosRutas1($idurl)
    {
      $idurl1 = $idurl;
      $idurl2 = '';
      $idurl3 = '';
      $idurl4 = '';
      $idurl5 = '';
      $idurl6 = '';
      $ArrayCarpetas = array();

      #directorios de archivos
      $getDirectoryArchivos = Documentos::where('ubicacion_archivo','=','documents-admin/'.$idurl.'/')->get();
      #get directorios carpetas
      $getDirectoryCarpetas = Documentos::where('ubicacion_anterior','=','documents-admin/'.$idurl.'/')->where('type_upload','=','carpeta')->get();

      # OBTENER LAS CARPETAS QUE EXISTEN EN UNA CARPETA, DESCOMPONEMOS EL ARRAY OBTENIDO DE TODAS LAS CARPERTAS QUE EXITEN
      # EN EL DIRECTORIO Y CON BASENAME OBTENEMOS EL NOMBRE DE LA CARPETA
      foreach ($getDirectoryCarpetas as $keygetDirectoryCarpetas) {
        $nameCarptea = $keygetDirectoryCarpetas->nombre_archivo;
        $nameCarptea2 = $keygetDirectoryCarpetas->ubicacion_archivo;
        $randomNmm = rand(5, 1232335);

        $dataCarpetas = array('nameCarpeta' => $nameCarptea,'nameCarpeta2' => $nameCarptea2,'VaueContenido' => '1','identiFI' => $randomNmm);
        array_push($ArrayCarpetas,$dataCarpetas);
      }

      # Obtener notifiaciones creadas
      $GetNotificaciones = $this->getNotificaciones();


      return view('admin.documentos',compact('getDirectoryArchivos','getDirectoryCarpetas','ArrayCarpetas','idurl','idurl2','idurl3','idurl4','idurl5','idurl6','GetNotificaciones'));
    }

    public function DocumentosRutas2($idurl,$idurl2)
    {
      $data = facedesrequest::all();
      $idurl = $idurl;
      $idurl2 = $idurl2;
      $idurl3 = '';
      $idurl4 = '';
      $idurl5 = '';
      $idurl6 = '';
      $ArrayCarpetas = array();

      #directorios de archivos
      $getDirectoryArchivos = Documentos::where('ubicacion_archivo','=','documents-admin/'.$idurl.'/'.$idurl2.'/')->get();
      #get directorios carpetas
      $getDirectoryCarpetas = Documentos::where('ubicacion_anterior','=','documents-admin/'.$idurl.'/'.$idurl2.'/')->where('type_upload','=','carpeta')->get();

      # OBTENER LAS CARPETAS QUE EXISTEN EN UNA CARPETA, DESCOMPONEMOS EL ARRAY OBTENIDO DE TODAS LAS CARPERTAS QUE EXITEN
      # EN EL DIRECTORIO Y CON BASENAME OBTENEMOS EL NOMBRE DE LA CARPETA
      foreach ($getDirectoryCarpetas as $keygetDirectoryCarpetas) {
        $nameCarptea = $keygetDirectoryCarpetas->nombre_archivo;
        $nameCarptea2 = $keygetDirectoryCarpetas->ubicacion_archivo;
        $randomNmm = rand(5, 1232335);

        $dataCarpetas = array('nameCarpeta' => $nameCarptea,'nameCarpeta2' => $nameCarptea2,'VaueContenido' => '1','identiFI' => $randomNmm);
        array_push($ArrayCarpetas,$dataCarpetas);
      }

      # Obtener notifiaciones creadas
      $GetNotificaciones = $this->getNotificaciones();

      return view('admin.documentos',compact('getDirectoryArchivos','getDirectoryCarpetas','ArrayCarpetas','idurl','idurl2','idurl3','idurl4','idurl5','idurl6','GetNotificaciones'));
    }

    public function DocumentosRutas3($idurl,$idurl2,$idurl3)
    {
      $data = facedesrequest::all();
      $idurl = $idurl;
      $idurl2 = $idurl2;
      $idurl3 = $idurl3;
      $idurl4 = '';
      $idurl5 = '';
      $idurl6 = '';
      $ArrayCarpetas = array();
      #directorios de archivos
      $getDirectoryArchivos = Documentos::where('ubicacion_archivo','=','documents-admin/'.$idurl.'/'.$idurl2.'/'.$idurl3.'/')->get();
      #get directorios carpetas
      $getDirectoryCarpetas = Documentos::where('ubicacion_anterior','=','documents-admin/'.$idurl.'/'.$idurl2.'/'.$idurl3.'/')->where('type_upload','=','carpeta')->get();

      # OBTENER LAS CARPETAS QUE EXISTEN EN UNA CARPETA, DESCOMPONEMOS EL ARRAY OBTENIDO DE TODAS LAS CARPERTAS QUE EXITEN
      # EN EL DIRECTORIO Y CON BASENAME OBTENEMOS EL NOMBRE DE LA CARPETA
      foreach ($getDirectoryCarpetas as $keygetDirectoryCarpetas) {
        $nameCarptea = $keygetDirectoryCarpetas->nombre_archivo;
        $nameCarptea2 = $keygetDirectoryCarpetas->ubicacion_archivo;
        $randomNmm = rand(5, 1232335);

        $dataCarpetas = array('nameCarpeta' => $nameCarptea,'nameCarpeta2' => $nameCarptea2,'VaueContenido' => '1','identiFI' => $randomNmm);
        array_push($ArrayCarpetas,$dataCarpetas);
      }

      # Obtener notifiaciones creadas
      $GetNotificaciones = $this->getNotificaciones();

      return view('admin.documentos',compact('getDirectoryArchivos','getDirectoryCarpetas','ArrayCarpetas','idurl','idurl2','idurl3','idurl4','idurl5','idurl6','GetNotificaciones'));
    }

    public function DocumentosRutas4($idurl,$idurl2,$idurl3,$idurl4)
    {
      $data = facedesrequest::all();
      $idurl = $idurl;
      $idurl2 = $idurl2;
      $idurl3 = $idurl3;
      $idurl4 = $idurl4;
      $idurl5 = '';
      $idurl6 = '';
      $ArrayCarpetas = array();

      #directorios de archivos
      $getDirectoryArchivos = Documentos::where('ubicacion_archivo','=','documents-admin/'.$idurl.'/'.$idurl2.'/'.$idurl3.'/'.$idurl4.'/')->get();
      #get directorios carpetas
      $getDirectoryCarpetas = Documentos::where('ubicacion_anterior','=','documents-admin/'.$idurl.'/'.$idurl2.'/'.$idurl3.'/'.$idurl4.'/')->where('type_upload','=','carpeta')->get();

      # OBTENER LAS CARPETAS QUE EXISTEN EN UNA CARPETA, DESCOMPONEMOS EL ARRAY OBTENIDO DE TODAS LAS CARPERTAS QUE EXITEN
      # EN EL DIRECTORIO Y CON BASENAME OBTENEMOS EL NOMBRE DE LA CARPETA
      foreach ($getDirectoryCarpetas as $keygetDirectoryCarpetas) {
        $nameCarptea = $keygetDirectoryCarpetas->nombre_archivo;
        $nameCarptea2 = $keygetDirectoryCarpetas->ubicacion_archivo;
        $randomNmm = rand(5, 1232335);

        $dataCarpetas = array('nameCarpeta' => $nameCarptea,'nameCarpeta2' => $nameCarptea2,'VaueContenido' => '1','identiFI' => $randomNmm);
        array_push($ArrayCarpetas,$dataCarpetas);
      }

      # Obtener notifiaciones creadas
      $GetNotificaciones = $this->getNotificaciones();

      return view('admin.documentos',compact('getDirectoryArchivos','getDirectoryCarpetas','ArrayCarpetas','idurl','idurl2','idurl3','idurl4','idurl5','idurl6','GetNotificaciones'));
    }

    public function DocumentosRutas5($idurl,$idurl2,$idurl3,$idurl4,$idurl5)
    {
      $data = facedesrequest::all();
      $idurl = $idurl;
      $idurl2 = $idurl2;
      $idurl3 = $idurl3;
      $idurl4 = $idurl4;
      $idurl5 = $idurl5;
      $idurl6 = '';
      $ArrayCarpetas = array();

      #directorios de archivos
      $getDirectoryArchivos = Documentos::where('ubicacion_archivo','=','documents-admin/'.$idurl.'/'.$idurl2.'/'.$idurl3.'/'.$idurl4.'/'.$idurl5.'/')->get();
      #get directorios carpetas
      $getDirectoryCarpetas = Documentos::where('ubicacion_anterior','=','documents-admin/'.$idurl.'/'.$idurl2.'/'.$idurl3.'/'.$idurl4.'/'.$idurl5.'/')->where('type_upload','=','carpeta')->get();

      # OBTENER LAS CARPETAS QUE EXISTEN EN UNA CARPETA, DESCOMPONEMOS EL ARRAY OBTENIDO DE TODAS LAS CARPERTAS QUE EXITEN
      # EN EL DIRECTORIO Y CON BASENAME OBTENEMOS EL NOMBRE DE LA CARPETA
      foreach ($getDirectoryCarpetas as $keygetDirectoryCarpetas) {
        $nameCarptea = $keygetDirectoryCarpetas->nombre_archivo;
        $nameCarptea2 = $keygetDirectoryCarpetas->ubicacion_archivo;
        $randomNmm = rand(5, 1232335);

        $dataCarpetas = array('nameCarpeta' => $nameCarptea,'nameCarpeta2' => $nameCarptea2,'VaueContenido' => '1','identiFI' => $randomNmm);
        array_push($ArrayCarpetas,$dataCarpetas);
      }

      # Obtener notifiaciones creadas
      $GetNotificaciones = $this->getNotificaciones();

      return view('admin.documentos',compact('getDirectoryArchivos','getDirectoryCarpetas','ArrayCarpetas','idurl','idurl2','idurl3','idurl4','idurl5','idurl6','GetNotificaciones'));
    }

    public function DocumentosRutas6($idurl,$idurl2,$idurl3,$idurl4,$idurl5,$idurl6)
    {
      $data = facedesrequest::all();
      $idurl = $idurl;
      $idurl2 = $idurl2;
      $idurl3 = $idurl3;
      $idurl4 = $idurl4;
      $idurl5 = $idurl5;
      $idurl6 = $idurl6;
      $ArrayCarpetas = array();

      #directorios de archivos
      $getDirectoryArchivos = Documentos::where('ubicacion_archivo','=','documents-admin/'.$idurl.'/'.$idurl2.'/'.$idurl3.'/'.$idurl4.'/'.$idurl5.'/'.$idurl6.'/')->get();
      #get directorios carpetas
      $getDirectoryCarpetas = Documentos::where('ubicacion_anterior','=','documents-admin/'.$idurl.'/'.$idurl2.'/'.$idurl3.'/'.$idurl4.'/'.$idurl5.'/'.$idurl6.'/')->where('type_upload','=','carpeta')->get();

      # OBTENER LAS CARPETAS QUE EXISTEN EN UNA CARPETA, DESCOMPONEMOS EL ARRAY OBTENIDO DE TODAS LAS CARPERTAS QUE EXITEN
      # EN EL DIRECTORIO Y CON BASENAME OBTENEMOS EL NOMBRE DE LA CARPETA
      foreach ($getDirectoryCarpetas as $keygetDirectoryCarpetas) {
        $nameCarptea = $keygetDirectoryCarpetas->nombre_archivo;
        $nameCarptea2 = $keygetDirectoryCarpetas->ubicacion_archivo;
        $randomNmm = rand(5, 1232335);

        $dataCarpetas = array('nameCarpeta' => $nameCarptea,'nameCarpeta2' => $nameCarptea2,'VaueContenido' => '1','identiFI' => $randomNmm);
        array_push($ArrayCarpetas,$dataCarpetas);
      }

      # Obtener notifiaciones creadas
      $GetNotificaciones = $this->getNotificaciones();

      return view('admin.documentos',compact('getDirectoryArchivos','getDirectoryCarpetas','ArrayCarpetas','idurl','idurl2','idurl3','idurl4','idurl5','idurl6','GetNotificaciones'));
    }

    public function Ranking()
    {
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

      # Obtener notifiaciones creadas
      $GetNotificaciones = $this->getNotificaciones();

      return view('admin.ranking', compact('JoinTableUserDatosPersonalesDatosEmpleado','AllAdps','HistoryAdps','RankingGeneral','GetNotificaciones'));
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

    public function UsersAll()
    {
      $UsersAlls = DatosPersonales::all();

      $carbon = new \Carbon\Carbon();
      $fechaMesActual = $carbon->now()->format('m');
      $fechaYearActual = $carbon->now()->format('Y');
      $GetEvaluaciones = HistorialEvaluaciones::where('mes_evaluacion', 'like', '%'.$fechaMesActual.'%' )->where('created_at', 'like', '%'.$fechaYearActual.'%' )->get();

      $JoinTableUserDatosPersonalesDatosEmpleado =  \DB::table('datos_personales')
      ->join('datos_empleados', 'datos_personales.id_usuario', '=', 'datos_empleados.id_usuario')
      ->select('datos_personales.nombre','datos_personales.apellidos','datos_personales.foto','datos_personales.estado','datos_personales.id_usuario','datos_empleados.correo_corporativo','datos_empleados.celular','datos_empleados.extencion')
      ->get();

      $totalUsers = count($JoinTableUserDatosPersonalesDatosEmpleado);

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

      return view('admin.usuarios', compact('JoinTableUserDatosPersonalesDatosEmpleado','RankingGeneral','HistoryAdps','GetEvaluaciones','totalUsers'));
    }

     public function DescativeUser(Request $request)
     {
       $idUsuario = $request->ide_user;
       $DataDescativeUser = array(
         'estado' => 0,
       );

       $EstadoUser= \DB::table('datos_personales')
         ->where('id_usuario', '=', $idUsuario)
         ->update($DataDescativeUser);

       Session::flash('Create_Estado', "El Usuario ha sido desactivado");
       return back()->withInput();
     }

    public function AddUsers()
    {
        $sucursales = $this->GetSucursales();
        $marcas = $this->GetMarcas();
        $areas = $this->GetAreas();
        $roles = $this->GetRoles();
        $usersAll = $this->GetUsers();

        return view('admin.Add-usuarios', compact('sucursales','marcas','areas','roles','usersAll'));
    }

    public function HistoryUsers()
    {
      $UsersAlls = DatosPersonales::all();
      $HorariosData = Horarios::all();
      $Asistencias = AsistenciaUsers::all();
      $arrayHorarioUsers = array();
      $arrayLosHorariosOfUser = array();
      $ADPS = Adps::all();

      foreach ($HorariosData as $keyHorariosData) {
        $arrayHorarioUsers = array();
        // DIAS COMPLETOS
       // primer bloque de horarios
       $DayCompleto = $keyHorariosData->bloq_horario1;
       $DayCompletoTime = $keyHorariosData->bloq_horario1Time;
       $RemoveComasCompl1 = explode(', ',$DayCompleto);
       $RemoveComasCompleTime1 = explode(',',$DayCompletoTime);

       if($DayCompleto != null){
         // Horarios del primer bloque
         foreach ($RemoveComasCompl1 as $keyRemoveComasCompl1e) {
           $dias = $keyRemoveComasCompl1e;
           $HoraEntrada = $RemoveComasCompleTime1[0];
           $HoraSalida = $RemoveComasCompleTime1[1];
           $HorarioDias = array('dia' =>$dias, 'entrada' =>$HoraEntrada, 'salida' =>$HoraSalida);
           array_push($arrayHorarioUsers, $HorarioDias);
         }
       }

       // segundo bloque de horarios
        $DayCompleto2 = $keyHorariosData->bloq_horario2;
        $DayCompletoTime2 = $keyHorariosData->bloq_horario2Time;

        if($DayCompleto2 != null){
          $RemoveComasCompl2 = explode(', ',$DayCompleto2);
          $RemoveComasCompleTime2 = explode(',',$DayCompletoTime2);

          // Horarios del segundo bloque
          foreach ($RemoveComasCompl2 as $keyRemoveComasCompl2e) {
            $dias2 = $keyRemoveComasCompl2e;
            $HoraEntrada2 = $RemoveComasCompleTime2[0];
            $HoraSalida2 = $RemoveComasCompleTime2[1];
            $HorarioDias2 = array('dia' =>$dias2, 'entrada' =>$HoraEntrada2, 'salida' =>$HoraSalida2);
            array_push($arrayHorarioUsers, $HorarioDias2);
          }
        }        

        // tercer bloque de horarios
        $DayCompleto3 = $keyHorariosData->bloq_horario3;
        $DayCompletoTime3 = $keyHorariosData->bloq_horario3Time;

        if($DayCompleto3 != null){
          $RemoveComasCompl3 = explode(', ',$DayCompleto3);
          $RemoveComasCompleTime3 = explode(',',$DayCompletoTime3);

          // Horarios del tercer bloque
          foreach ($RemoveComasCompl3 as $keyRemoveComasCompl3e) {
            $dias3 = $keyRemoveComasCompl3e;
            $HoraEntrada3 = $RemoveComasCompleTime3[0];
            $HoraSalida3 = $RemoveComasCompleTime3[1];
            $HorarioDias3 = array('dia' =>$dias3, 'entrada' =>$HoraEntrada3, 'salida' =>$HoraSalida3);
            array_push($arrayHorarioUsers, $HorarioDias3);
          }
        }   

        // MEDIOS DIAS    

        // primer bloque de horarios medio tiempo
        $DayMedio1 = $keyHorariosData->bloq_horarioMedio1;
        $DayMedio1Time = $keyHorariosData->bloq_horarioMedio1Time;
        $RemoveComasMedio1 = explode(', ',$DayMedio1);
        $RemoveComasMedioTime1 = explode(',',$DayMedio1Time);

        if($DayMedio1 != null){
          // Horarios del primer bloque medio tiempo
          foreach ($RemoveComasMedio1 as $keyRemoveComasMedio1e) {
            $diasMedios = $keyRemoveComasMedio1e;
            $HoraEntradaMedio = $RemoveComasMedioTime1[0];
            $HoraSalidaMedio = $RemoveComasMedioTime1[1];
            $HorarioDiasMedios = array('dia' =>$diasMedios, 'entrada' =>$HoraEntradaMedio, 'salida' =>$HoraSalidaMedio);
            array_push($arrayHorarioUsers, $HorarioDiasMedios);
          }
        }

        // segundo bloque de horarios medio tiempo
         $DayMedio2 = $keyHorariosData->bloq_horarioMedio2;
         $DayMedioTime2 = $keyHorariosData->bloq_horarioMedio2Time;

         if($DayMedio2 != null){
           $RemoveComasMedio2 = explode(', ',$DayMedio2);
           $RemoveComasMedioTime2 = explode(',',$DayMedioTime2);

           // Horarios del segundo bloque medio tiempo
           foreach ($RemoveComasMedio2 as $keyRemoveComasMedio2e) {
             $diasMedio2 = $keyRemoveComasMedio2e;
             $HoraEntradaMedio2 = $RemoveComasMedioTime2[0];
             $HoraSalidaMedio2 = $RemoveComasMedioTime2[1];
             $HorarioDiasMedio2 = array('dia' =>$diasMedio2, 'entrada' =>$HoraEntradaMedio2, 'salida' =>$HoraSalidaMedio2);
             array_push($arrayHorarioUsers, $HorarioDiasMedio2);
           }
         }        

         // tercer bloque de horarios medio tiempo
         $DayMedio3 = $keyHorariosData->bloq_horarioMedio3;
         $DayMedioTime3 = $keyHorariosData->bloq_horarioMedio3Time;

         if($DayMedio3 != null){
           $RemoveComasMedio3 = explode(', ',$DayMedio3);
           $RemoveComasMedioTime3 = explode(',',$DayMedioTime3);

           // Horarios del tercer bloque medio tiempo
           foreach ($RemoveComasMedio3 as $keyRemoveComasCompl3e) {
             $diasMedio3 = $keyRemoveComasCompl3e;
             $HoraEntradaMedio3 = $RemoveComasMedioTime3[0];
             $HoraSalidaMedio3 = $RemoveComasMedioTime3[1];
             $HorarioDiasMedio3 = array('dia' =>$diasMedio3, 'entrada' =>$HoraEntradaMedio3, 'salida' =>$HoraSalidaMedio3);
             array_push($arrayHorarioUsers, $HorarioDiasMedio3);
           }
         }   
         
         $HorariosOfUser = array('id_user_h' => $keyHorariosData->id_usuario, 'horarios' => $arrayHorarioUsers); 
        array_push($arrayLosHorariosOfUser,$HorariosOfUser);
      }

      // dd($arrayLosHorariosOfUser);
      $HistorialAdps = HistorialAdps::all();

      $arrayAdpsCreadas = array();
      foreach ($HistorialAdps as $keyHistorialAdps) {
        $idAsistenciasDataAdp = $keyHistorialAdps->id_asistencias;
        array_push($arrayAdpsCreadas,$idAsistenciasDataAdp);
      }

      $AllAdps = Adps::all();
      $HistoryAdps = HistorialAdps::all();
      $JoinTableUserDatosPersonalesDatosEmpleado =  \DB::table('datos_personales')
      ->join('datos_empleados', 'datos_personales.id_usuario', '=', 'datos_empleados.id_usuario')
      ->select('datos_personales.nombre','datos_personales.apellidos','datos_personales.foto','datos_personales.id_usuario','datos_empleados.correo_corporativo','datos_empleados.celular','datos_empleados.extencion','datos_empleados.area_departamento')
      ->get();

      // RANKING
      $rankingSInApp = $this->rankingSinAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      $RankingGeneral = $rankingSInApp;
      // $rankingWithApp = $this->RankingWithAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      // $RankingGeneral = $rankingWithApp;

      # Obtener notifiaciones creadas
      $GetNotificaciones = $this->getNotificaciones();

      return view('admin.historial-usuarios',compact('UsersAlls','JoinTableUserDatasHostoriLlegadas','Asistencias','arrayLosHorariosOfUser','ADPS','arrayAdpsCreadas','RankingGeneral','GetNotificaciones'));
    }

    public function HistoryUsersFechas($fecha)
    {
      $UsersAlls = DatosPersonales::all();
      $HorariosData = Horarios::all();
      $Asistencias = AsistenciaUsers::where('fecha','=',$fecha)->get();
      $arrayHorarioUsers = array();
      $arrayLosHorariosOfUser = array();
      $ADPS = Adps::all();

      foreach ($HorariosData as $keyHorariosData) {
        $arrayHorarioUsers = array();
        // DIAS COMPLETOS
       // primer bloque de horarios
       $DayCompleto = $keyHorariosData->bloq_horario1;
       $DayCompletoTime = $keyHorariosData->bloq_horario1Time;
       $RemoveComasCompl1 = explode(', ',$DayCompleto);
       $RemoveComasCompleTime1 = explode(',',$DayCompletoTime);

       if($DayCompleto != null){
         // Horarios del primer bloque
         foreach ($RemoveComasCompl1 as $keyRemoveComasCompl1e) {
           $dias = $keyRemoveComasCompl1e;
           $HoraEntrada = $RemoveComasCompleTime1[0];
           $HoraSalida = $RemoveComasCompleTime1[1];
           $HorarioDias = array('dia' =>$dias, 'entrada' =>$HoraEntrada, 'salida' =>$HoraSalida);
           array_push($arrayHorarioUsers, $HorarioDias);
         }
       }

       // segundo bloque de horarios
        $DayCompleto2 = $keyHorariosData->bloq_horario2;
        $DayCompletoTime2 = $keyHorariosData->bloq_horario2Time;

        if($DayCompleto2 != null){
          $RemoveComasCompl2 = explode(', ',$DayCompleto2);
          $RemoveComasCompleTime2 = explode(',',$DayCompletoTime2);

          // Horarios del segundo bloque
          foreach ($RemoveComasCompl2 as $keyRemoveComasCompl2e) {
            $dias2 = $keyRemoveComasCompl2e;
            $HoraEntrada2 = $RemoveComasCompleTime2[0];
            $HoraSalida2 = $RemoveComasCompleTime2[1];
            $HorarioDias2 = array('dia' =>$dias2, 'entrada' =>$HoraEntrada2, 'salida' =>$HoraSalida2);
            array_push($arrayHorarioUsers, $HorarioDias2);
          }
        }        

        // tercer bloque de horarios
        $DayCompleto3 = $keyHorariosData->bloq_horario3;
        $DayCompletoTime3 = $keyHorariosData->bloq_horario3Time;

        if($DayCompleto3 != null){
          $RemoveComasCompl3 = explode(', ',$DayCompleto3);
          $RemoveComasCompleTime3 = explode(',',$DayCompletoTime3);

          // Horarios del tercer bloque
          foreach ($RemoveComasCompl3 as $keyRemoveComasCompl3e) {
            $dias3 = $keyRemoveComasCompl3e;
            $HoraEntrada3 = $RemoveComasCompleTime3[0];
            $HoraSalida3 = $RemoveComasCompleTime3[1];
            $HorarioDias3 = array('dia' =>$dias3, 'entrada' =>$HoraEntrada3, 'salida' =>$HoraSalida3);
            array_push($arrayHorarioUsers, $HorarioDias3);
          }
        }   

        // MEDIOS DIAS    

        // primer bloque de horarios medio tiempo
        $DayMedio1 = $keyHorariosData->bloq_horarioMedio1;
        $DayMedio1Time = $keyHorariosData->bloq_horarioMedio1Time;
        $RemoveComasMedio1 = explode(', ',$DayMedio1);
        $RemoveComasMedioTime1 = explode(',',$DayMedio1Time);

        if($DayMedio1 != null){
          // Horarios del primer bloque medio tiempo
          foreach ($RemoveComasMedio1 as $keyRemoveComasMedio1e) {
            $diasMedios = $keyRemoveComasMedio1e;
            $HoraEntradaMedio = $RemoveComasMedioTime1[0];
            $HoraSalidaMedio = $RemoveComasMedioTime1[1];
            $HorarioDiasMedios = array('dia' =>$diasMedios, 'entrada' =>$HoraEntradaMedio, 'salida' =>$HoraSalidaMedio);
            array_push($arrayHorarioUsers, $HorarioDiasMedios);
          }
        }

        // segundo bloque de horarios medio tiempo
         $DayMedio2 = $keyHorariosData->bloq_horarioMedio2;
         $DayMedioTime2 = $keyHorariosData->bloq_horarioMedio2Time;

         if($DayMedio2 != null){
           $RemoveComasMedio2 = explode(', ',$DayMedio2);
           $RemoveComasMedioTime2 = explode(',',$DayMedioTime2);

           // Horarios del segundo bloque medio tiempo
           foreach ($RemoveComasMedio2 as $keyRemoveComasMedio2e) {
             $diasMedio2 = $keyRemoveComasMedio2e;
             $HoraEntradaMedio2 = $RemoveComasMedioTime2[0];
             $HoraSalidaMedio2 = $RemoveComasMedioTime2[1];
             $HorarioDiasMedio2 = array('dia' =>$diasMedio2, 'entrada' =>$HoraEntradaMedio2, 'salida' =>$HoraSalidaMedio2);
             array_push($arrayHorarioUsers, $HorarioDiasMedio2);
           }
         }        

         // tercer bloque de horarios medio tiempo
         $DayMedio3 = $keyHorariosData->bloq_horarioMedio3;
         $DayMedioTime3 = $keyHorariosData->bloq_horarioMedio3Time;

         if($DayMedio3 != null){
           $RemoveComasMedio3 = explode(', ',$DayMedio3);
           $RemoveComasMedioTime3 = explode(',',$DayMedioTime3);

           // Horarios del tercer bloque medio tiempo
           foreach ($RemoveComasMedio3 as $keyRemoveComasCompl3e) {
             $diasMedio3 = $keyRemoveComasCompl3e;
             $HoraEntradaMedio3 = $RemoveComasMedioTime3[0];
             $HoraSalidaMedio3 = $RemoveComasMedioTime3[1];
             $HorarioDiasMedio3 = array('dia' =>$diasMedio3, 'entrada' =>$HoraEntradaMedio3, 'salida' =>$HoraSalidaMedio3);
             array_push($arrayHorarioUsers, $HorarioDiasMedio3);
           }
         }   
         
         $HorariosOfUser = array('id_user_h' => $keyHorariosData->id_usuario, 'horarios' => $arrayHorarioUsers); 
        array_push($arrayLosHorariosOfUser,$HorariosOfUser);
      }

      // dd($arrayLosHorariosOfUser);
      $HistorialAdps = HistorialAdps::all();

      $arrayAdpsCreadas = array();
      foreach ($HistorialAdps as $keyHistorialAdps) {
        $idAsistenciasDataAdp = $keyHistorialAdps->id_asistencias;
        array_push($arrayAdpsCreadas,$idAsistenciasDataAdp);
      }

      $AllAdps = Adps::all();
      $HistoryAdps = HistorialAdps::all();
      $JoinTableUserDatosPersonalesDatosEmpleado =  \DB::table('datos_personales')
      ->join('datos_empleados', 'datos_personales.id_usuario', '=', 'datos_empleados.id_usuario')
      ->select('datos_personales.nombre','datos_personales.apellidos','datos_personales.foto','datos_personales.id_usuario','datos_empleados.correo_corporativo','datos_empleados.celular','datos_empleados.extencion','datos_empleados.area_departamento')
      ->get();

      // RANKING
      $rankingSInApp = $this->rankingSinAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      $RankingGeneral = $rankingSInApp;
      // $rankingWithApp = $this->RankingWithAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      // $RankingGeneral = $rankingWithApp;


      return view('admin.historial-usuarios',compact('UsersAlls','JoinTableUserDatasHostoriLlegadas','Asistencias','arrayLosHorariosOfUser','ADPS','arrayAdpsCreadas','RankingGeneral'));
    }

    public function HistoryAyer($fechaYesterday){
     $HistoryLLegadasTardes = AsistenciaUsers::where('fecha', '=', $fechaYesterday)->where('hora_entrada', '>', '08:00')->get();
     $TotalLLegadasTarde = count($HistoryLLegadasTardes);
     echo json_encode($TotalLLegadasTarde);
    }

    public function HistoryEntradaSalidaUsers($id)
    {
      $UsersAlls = DatosPersonales::where('id_usuario', '=', $id)->get();

      #get Historial de llegada del dia actual
      $AsistenciasDay = AsistenciaUsers::where('id_usuario', '=', $id)->get();
      $DataHistoryHoy ='';
      $carbon = new \Carbon\Carbon();
      $fechaActual = $carbon->now()->format('Y-m-d');
      foreach ($AsistenciasDay as $keyAsistenciasDay) {
        if($keyAsistenciasDay->fecha == $fechaActual){
          $DataHistoryHoy = array('fecha' => $keyAsistenciasDay->fecha,'hora_entrada' => $keyAsistenciasDay->hora_entrada,'hora_salida' => $keyAsistenciasDay->hora_salida);
        }
      }
      #Get todas las asistencias del usuario
      $AsistenciasAll = AsistenciaUsers::where('id_usuario', '=', $id)->orderBy('fecha', 'desc')->get();

      #Get notificaciones
      $GetActividadesFechas = HistorialActividadesRecientes::orderBy('id', 'desc')->get();
      
      return view('admin.historial-entrada-salida',compact('AsistenciasDay','AsistenciasAll','UsersAlls','DataHistoryHoy','GetActividadesFechas'));
    }

    public function HistoryEntradaSalidaUsersAlls()
    {
      $UsersAlls = DatosPersonales::all();


      #get Historial de llegada del dia actual
      $AsistenciasDay = AsistenciaUsers::all();
      $DataHistoryArray = '';
      $DataHistoryHoy = array();

      $carbon = new \Carbon\Carbon();
      $fechaActual = $carbon->now()->format('Y-m-d');


      foreach ($AsistenciasDay as $keyAsistenciasDay) {
        if($keyAsistenciasDay->fecha == $fechaActual){
          $DataHistoryArray = array('fecha' => $keyAsistenciasDay->fecha,'hora_entrada' => $keyAsistenciasDay->hora_entrada,'hora_salida' => $keyAsistenciasDay->hora_salida,'id_usuario' => $keyAsistenciasDay->id_usuario);
          array_push($DataHistoryHoy,$DataHistoryArray);
        }
      }

      #Get todas las asistencias del usuario
      $AsistenciasAll =  \DB::table('asistencia_usuarios')
      ->select('*')
      ->orderBy('fecha','desc')
      ->get();

      // dd($DataHistoryHoy);

      #Get notificaciones
      $GetActividadesFechas = HistorialActividadesRecientes::orderBy('id', 'desc')->get();

      return view('admin.historial-entrada-salida-all',compact('AsistenciasDay','AsistenciasAll','UsersAlls','DataHistoryHoy','GetActividadesFechas'));
    }

    public function EditUser($id)
    {
      $UsersAlls = DatosPersonales::all();
      $Areas = Areas::all();
      # Variables Dias Completos
      $bloComplete1 = '';
      $bloCompleteTime1 = '';
      $bloComplete2 = '';
      $bloCompleteTime2 = '';
      $bloComplete3 = '';
      $bloCompleteTime3 = '';

      # Variables Medios Dias
      $bloMedio1 = '';
      $bloMedioTime1 = '';
      $bloMedio2 = '';
      $bloMedioTime2 = '';
      $bloMedio3 = '';
      $bloMedioTime3 = '';


      $Horarios = Horarios::where('id_usuario', '=', $id)->get();

      # Validadando y obteniendo horarios del usuario
      foreach ($Horarios as $keyHorarios) {
        # Dias Completos
        if($keyHorarios->bloq_horario1 != null && $keyHorarios->bloq_horario1 != ''){
          $bloComplete1 = explode(",", $keyHorarios->bloq_horario1);
        }  
        if($keyHorarios->bloq_horario1Time != null && $keyHorarios->bloq_horario1Time != ''){
          $bloCompleteTime1 = explode(",", $keyHorarios->bloq_horario1Time);
        }   
        if($keyHorarios->bloq_horario2 != null && $keyHorarios->bloq_horario2 != ''){
          $bloComplete2 = explode(",", $keyHorarios->bloq_horario2);
        }  
        if($keyHorarios->bloq_horario2Time != null && $keyHorarios->bloq_horario2Time != ''){
          $bloCompleteTime2 = explode(",", $keyHorarios->bloq_horario2Time);
        }   
        if($keyHorarios->bloq_horario3 != null && $keyHorarios->bloq_horario3 != ''){
          $bloComplete3 = explode(",", $keyHorarios->bloq_horario3);
        }  
        if($keyHorarios->bloq_horario3Time != null && $keyHorarios->bloq_horario3Time != ''){
          $bloCompleteTime3 = explode(",", $keyHorarios->bloq_horario3Time);
        }  

        # Dias Medios
        if($keyHorarios->bloq_horarioMedio1 != null && $keyHorarios->bloq_horarioMedio1 != ''){
          $bloMedio1 = explode(",", $keyHorarios->bloq_horarioMedio1);
        }  
        if($keyHorarios->bloq_horarioMedio1Time != null && $keyHorarios->bloq_horarioMedio1Time != ''){
          $bloMedioTime1 = explode(",", $keyHorarios->bloq_horarioMedio1Time);
        }   
        if($keyHorarios->bloq_horarioMedio2 != null && $keyHorarios->bloq_horarioMedio2 != ''){
          $bloMedio2 = explode(",", $keyHorarios->bloq_horarioMedio2);
        }  
        if($keyHorarios->bloq_horarioMedio2Time != null && $keyHorarios->bloq_horarioMedio2Time != ''){
          $bloMedioTime2 = explode(",", $keyHorarios->bloq_horarioMedio2Time);
        }   
        if($keyHorarios->bloq_horarioMedio3 != null && $keyHorarios->bloq_horarioMedio3 != ''){
          $bloMedio3 = explode(",", $keyHorarios->bloq_horarioMedio3);
        }  
        if($keyHorarios->bloq_horarioMedio3Time != null && $keyHorarios->bloq_horarioMedio3Time != ''){
          $bloMedioTime3 = explode(",", $keyHorarios->bloq_horarioMedio3Time);
        }     
      }

      // RANKING
      $AllAdps = Adps::all();
      $HistoryAdps = HistorialAdps::all();
      $JoinTableUserDatosPersonalesDatosEmpleado =  \DB::table('datos_personales')
      ->join('datos_empleados', 'datos_personales.id_usuario', '=', 'datos_empleados.id_usuario')
      ->select('*')
      ->where('datos_personales.id_usuario', '=', $id)
      ->get();

      $rankingSInApp = $this->rankingSinAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      $RankingGeneral = $rankingSInApp;
      // $rankingWithApp = $this->RankingWithAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      // $RankingGeneral = $rankingWithApp;

      return view('admin.Edit-usuarios', compact('JoinTableUserDatosPersonalesDatosEmpleado','UsersAlls','Horarios','bloComplete1','bloCompleteTime1','bloComplete2','bloCompleteTime2','bloComplete3','bloCompleteTime3','bloMedio1','bloMedioTime1','bloMedio2','bloMedioTime2','bloMedio3','bloMedioTime3','id','Areas','RankingGeneral'));
    }

    public function EditUserHorario($id)
    {
      $UsersAlls = DatosPersonales::all();
      $Areas = Areas::all();
      # Variables Dias Completos
      $bloComplete1 = '';
      $bloCompleteTime1 = '';
      $bloComplete2 = '';
      $bloCompleteTime2 = '';
      $bloComplete3 = '';
      $bloCompleteTime3 = '';

      # Variables Medios Dias
      $bloMedio1 = '';
      $bloMedioTime1 = '';
      $bloMedio2 = '';
      $bloMedioTime2 = '';
      $bloMedio3 = '';
      $bloMedioTime3 = '';


      $Horarios = Horarios::where('id_usuario', '=', $id)->get();

      # Validadando y obteniendo horarios del usuario
      foreach ($Horarios as $keyHorarios) {
        # Dias Completos
        if($keyHorarios->bloq_horario1 != null && $keyHorarios->bloq_horario1 != ''){
          $bloComplete1 = explode(",", $keyHorarios->bloq_horario1);
        }  
        if($keyHorarios->bloq_horario1Time != null && $keyHorarios->bloq_horario1Time != ''){
          $bloCompleteTime1 = explode(",", $keyHorarios->bloq_horario1Time);
        }   
        if($keyHorarios->bloq_horario2 != null && $keyHorarios->bloq_horario2 != ''){
          $bloComplete2 = explode(",", $keyHorarios->bloq_horario2);
        }  
        if($keyHorarios->bloq_horario2Time != null && $keyHorarios->bloq_horario2Time != ''){
          $bloCompleteTime2 = explode(",", $keyHorarios->bloq_horario2Time);
        }   
        if($keyHorarios->bloq_horario3 != null && $keyHorarios->bloq_horario3 != ''){
          $bloComplete3 = explode(",", $keyHorarios->bloq_horario3);
        }  
        if($keyHorarios->bloq_horario3Time != null && $keyHorarios->bloq_horario3Time != ''){
          $bloCompleteTime3 = explode(",", $keyHorarios->bloq_horario3Time);
        }  

        # Dias Medios
        if($keyHorarios->bloq_horarioMedio1 != null && $keyHorarios->bloq_horarioMedio1 != ''){
          $bloMedio1 = explode(",", $keyHorarios->bloq_horarioMedio1);
        }  
        if($keyHorarios->bloq_horarioMedio1Time != null && $keyHorarios->bloq_horarioMedio1Time != ''){
          $bloMedioTime1 = explode(",", $keyHorarios->bloq_horarioMedio1Time);
        }   
        if($keyHorarios->bloq_horarioMedio2 != null && $keyHorarios->bloq_horarioMedio2 != ''){
          $bloMedio2 = explode(",", $keyHorarios->bloq_horarioMedio2);
        }  
        if($keyHorarios->bloq_horarioMedio2Time != null && $keyHorarios->bloq_horarioMedio2Time != ''){
          $bloMedioTime2 = explode(",", $keyHorarios->bloq_horarioMedio2Time);
        }   
        if($keyHorarios->bloq_horarioMedio3 != null && $keyHorarios->bloq_horarioMedio3 != ''){
          $bloMedio3 = explode(",", $keyHorarios->bloq_horarioMedio3);
        }  
        if($keyHorarios->bloq_horarioMedio3Time != null && $keyHorarios->bloq_horarioMedio3Time != ''){
          $bloMedioTime3 = explode(",", $keyHorarios->bloq_horarioMedio3Time);
        }     
      }

      // RANKING
      $AllAdps = Adps::all();
      $HistoryAdps = HistorialAdps::all();
      $JoinTableUserDatosPersonalesDatosEmpleado =  \DB::table('datos_personales')
      ->join('datos_empleados', 'datos_personales.id_usuario', '=', 'datos_empleados.id_usuario')
      ->select('*')
      ->where('datos_personales.id_usuario', '=', $id)
      ->get();

      $rankingSInApp = $this->rankingSinAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      $RankingGeneral = $rankingSInApp;
      // $rankingWithApp = $this->RankingWithAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      // $RankingGeneral = $rankingWithApp;

      return view('admin.Edit-usuarios-horario', compact('JoinTableUserDatosPersonalesDatosEmpleado','UsersAlls','Horarios','bloComplete1','bloCompleteTime1','bloComplete2','bloCompleteTime2','bloComplete3','bloCompleteTime3','bloMedio1','bloMedioTime1','bloMedio2','bloMedioTime2','bloMedio3','bloMedioTime3','id','Areas','RankingGeneral'));
    }

    public function EditUserGrupos(Request $request)
    {
      $data = facedesrequest::all();
      $UsersAlls = DatosPersonales::all();
      $idsUserGroup = $request->select_user_edit;

      $dataAreas = $this->GetAreas();

      // dd($idsUserGroup);
      return view('admin.Edit-usuarios-grupos',compact('idsUserGroup','UsersAlls','dataAreas'));
    }

    public function MonthlyEvaluations()
    {
      $idUserLogin = Auth::user()->id;
      $EncargadosOfAreas = EncargadosAreas::where('id_encargardo', '=', $idUserLogin)->get();
      $UsersAlls = DatosPersonales::all();
      $JoinTableUserDatas =  \DB::table('datos_personales')
      ->join('datos_empleados', 'datos_personales.id_usuario', '=', 'datos_empleados.id_usuario')
      ->select('*')
      ->get();

      $HistorialEvaluaciones = HistorialEvaluaciones::all();

      // RANKINNG
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

      # Obtener notifiaciones creadas
      $GetNotificaciones = $this->getNotificaciones();

      return view('admin.evaluciones-mensuales',compact('EncargadosOfAreas','UsersAlls','JoinTableUserDatas','HistorialEvaluaciones','RankingGeneral','GetNotificaciones'));
    }

    public function MonthlyEvaluationsDetall($idEncargado, $id)
    {
      $idUserEvaluacion = $id;
      $UsersAlls = DatosPersonales::all();
      $UsersEvaluacion = DatosPersonales::where('id_usuario','=', $id)->get();
      $EncargadosOfAreas = EncargadosAreas::where('id_encargardo','=', $idEncargado)->get();
      // RANKINNG
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

      # Obtener notifiaciones creadas
      $GetNotificaciones = $this->getNotificaciones();

      return view('admin.evaluciones-mensuales-detall',compact('UsersEvaluacion','EncargadosOfAreas','UsersAlls','idEncargado','idUserEvaluacion','RankingGeneral','GetNotificaciones'));
    }

    public function StoreEvaluation(Request $request){
      $data = facedesrequest::all();
      // dd($data);

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
      $idUserEvaluado = $request->_iduser;
      $idEncargado = $request->_idencargado;

      $SubTotal = $ordernLimpieza + $trabajoEquipo + $tiemposestablecidos + $proactividad + $ActitudUser + $Puntualidad + $EvlocionUser + $ConocimientosArea + $ImagenPersonal + $lenguajeVerbal;

      $Total = $SubTotal / 10;

      $date = new \Carbon\Carbon('next month');
      $dateMes = $date->format('m');

      $carbon = new \Carbon\Carbon();
      $MesActual = $carbon->now()->format('m');

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

      $saveEvaluation = new HistorialEvaluaciones($dataSendEvaluation);
      $saveEvaluation->save();
      Session::flash('Evaluacion', "La evaluacion del usuario ha sido realizada");
      return redirect('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/evaluaciones-mensuales');

    }

    public function Demo()
    {
      $db_ext = \DB::connection('mysql2');
      $countries = $db_ext->table('appac_lista_empleados')->get();
      dd($countries);
      return view('demoDB');
    }


    public function GetSucursales()
    {
        $DataSucursales = Sucursales::all();
        return $DataSucursales;
    }

    public function GetMarcas()
    {
        $DataMarcas = Marcas::all();
        return $DataMarcas;
    }

    public function GetAreas()
    {
        $DataAreas = Areas::all();
        return $DataAreas;
    }

    public function GetRoles()
    {
        $DataRoles = Roles::all();
        return $DataRoles;
    }

    public function GetUsers()
    {
        $DataUsers = User::all();
        return $DataUsers;
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

    public function StorRecordatorio(Request $request){
      $data = facedesrequest::all();

      # Obteniendo informacion del recordatorio que queremos crear
      $idUserPublicRecordatorio = $request->id_user_recordatorio;
      $DescripcionRecordatorio = $request->descrip_recordatorio;

      # Los datos Obtenidos los almacenamos en un array 
      $dataRecordatorio = array(
        'descripcion_recordatorio' => $DescripcionRecordatorio,
        'id_usuario' => $idUserPublicRecordatorio,
      );

      # Los datos Obtenidos los guardamos 
      $createNewRecordatorio = new RecordatoriosAdmin($dataRecordatorio);
      $createNewRecordatorio->save();
      Session::flash('Create_Recordatorio', "El Recordatorio ha sido creado");
      return back()->withInput();
    }

    public function DeleteRecordatorio(Request $request){
        $data = facedesrequest::all();
        $idRecordatorio = $request->id_remove_recordatorio;
        
        \DB::table('recordatorios_admin')->where('id', '=', $idRecordatorio)->delete();
        return back()->withInput();
    }

    public function AllUsers(){
      // $Users = User::all();

      $Users =  \DB::table('users')
      ->join('datos_personales', 'users.id', '=', 'datos_personales.id_usuario')
      ->select('*')
      ->get();

      return $Users;
    }

    public function UsersOnline(){

       $OnlineUser = GetOnline::all();
       $allUsers = User::all();
       $arrayUsersOnline = array();

       foreach ($OnlineUser as $keyOnlineUser) {
         foreach ($allUsers as $keyallUsers) {
           if($keyOnlineUser->id_user_login == $keyallUsers->id){
             $getArrayUser = array('id_user' => $keyallUsers->id, 'nombre_user' => $keyallUsers->name);
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

    public function StoreviewSugerenciaEmergenciaAndMore(Request $request){
      if($request->ajax()) {
        $IdSolicitudView = $request->idSugerencia;
        $dataUpdateSolicitud = array(
            'solicitud_vista' =>  '1',
        );
        $GetUpdateSolicitud = DetallesSolicitudes::findOrFail($IdSolicitudView);
        $GetUpdateSolicitud->fill($dataUpdateSolicitud);
        $GetUpdateSolicitud->save();
        echo json_encode('true');
      }
    }

    public function storeCheeboxGroup(Request $request){

      $data = facedesrequest::all();
      # Obtenemos las solicitudes que queremos dejar como visto
      $dataIdsSolicitudes = $request->group_select_action_solictudes;
      $cantidadSolicitudes = count($dataIdsSolicitudes);

      #Descomponemos el array que viene y obtenemos su valor segun la pocicion que se encuentra y actualizamos
      for ($s=0; $s <$cantidadSolicitudes ; $s++) { 
        $IdSolicitudView = $dataIdsSolicitudes[$s];
        $dataUpdateSolicitudes = array(
            'solicitud_vista' =>  '1',
        );
        $GetUpdateSolicitudID = DetallesSolicitudes::findOrFail($IdSolicitudView);
        $GetUpdateSolicitudID->fill($dataUpdateSolicitudes);
        $GetUpdateSolicitudID->save();
        
      }

      return back()->withInput();

    }

    public function storeCheeboxGroupDelete(Request $request){

      $data = facedesrequest::all();
      # Obtenemos las solicitudes que queremos dejar como visto
      $dataIdsSolicitudes = $request->group_select_action_solictudes;
      $cantidadSolicitudes = count($dataIdsSolicitudes);

      #Descomponemos el array que viene y obtenemos su valor segun la pocicion que se encuentra y actualizamos
      for ($s=0; $s <$cantidadSolicitudes ; $s++) { 
        $IdSolicitudView = $dataIdsSolicitudes[$s];
        
        $getDeleteSolicitud = DetallesSolicitudes::find($IdSolicitudView);
        $getDeleteSolicitud->delete();

        $getDeleteSolicitudCOmentarios = ComentariosSolicitudes::where('id_detalle_solicitud', '=', $IdSolicitudView)->delete();

        
      }

      return back()->withInput();

    }

    #Solicitud de permiso agregada 
    public function storeActionSolicitud(Request $request){
      if($request->ajax()) {
        $idSolicitudAcep = $request->idSoliAcepta;
        $TypeDescuento = $request->typeDescuento;
        $idOfUserSolicitud = $request->idUSerSOlictud;
        $daysVacaciones = '';

        if($TypeDescuento == 1){
          $DataVacacioneUsers = VacacionesUsers::where('id_usuario', '=', $idOfUserSolicitud)->get();
          foreach ($DataVacacioneUsers as $keyDataVacacioneUsers) {
            $daysVacaciones = $keyDataVacacioneUsers->dias;
          }

          $dataUpdateDayVaciones= array(
              'dias' =>   $daysVacaciones-1,
          );

          $VacacioneUsers= \DB::table('vacaciones_user')
            ->where('id_usuario', '=', $idOfUserSolicitud)
            ->update($dataUpdateDayVaciones);

          $dataUpdateSolicitudesAction = array(
              'solicitud_aceptada' =>  '1',
              'solicitud_espera' =>  null,
          );

          $GetUpdateSolicitudIDUpdate = DetallesSolicitudes::findOrFail($idSolicitudAcep);
          $GetUpdateSolicitudIDUpdate->fill($dataUpdateSolicitudesAction);
          $GetUpdateSolicitudIDUpdate->save();

          echo json_encode($daysVacaciones-1);
        }else{
          
          $dataUpdateSolicitudesAction = array(
              'solicitud_aceptada' =>  '1',
          );

          $GetUpdateSolicitudIDUpdate = DetallesSolicitudes::findOrFail($idSolicitudAcep);
          $GetUpdateSolicitudIDUpdate->fill($dataUpdateSolicitudesAction);
          $GetUpdateSolicitudIDUpdate->save();

          echo json_encode('descuento');
        }
      }

    }

    #Solicitud de permiso denegada
    public function storeActionSolicitudDenegada(Request $request){
      if($request->ajax()) {

        $idSolicitudDenega = $request->idSoliDenega;
        $dataUpdateSolicitudesAction = array(
            'solicitud_denegada' =>  '1',
            'solicitud_espera' =>  null,
        );

        $GetUpdateSolicitudIDUpdate = DetallesSolicitudes::findOrFail($idSolicitudDenega);
        $GetUpdateSolicitudIDUpdate->fill($dataUpdateSolicitudesAction);
        $GetUpdateSolicitudIDUpdate->save();

        echo json_encode('true');
      }

    }

    public function SearchSolicitudPermiso(Request $request){
      // $nameUserSearch = $request->n;
      $nameUserSearch = $request->user_search;
      $UsersAlls = DatosPersonales::where('nombre', 'like', '%'.$nameUserSearch.'%')->get();
      // dd($UsersAlls);
      $ComentariosPermisos = ComentariosSolicitudes::all();
      $PermisosData = DetallesSolicitudes::where('id_tipo_solicitud', '=','1')->orderBy('id','desc')->get();

      
      $DescuentosSolicitudes = TiposDescuentos::all();

      $JoinTableUserDatasPermmisosVerifiView =  \DB::table('datos_personales')
      ->join('detalles_solicitudes', 'datos_personales.id_usuario', '=', 'detalles_solicitudes.id_usuario')
      ->select('*')
      ->where('id_tipo_solicitud', '=','1')
      ->whereNull('solicitud_vista')
      ->get();


      $CantidadPermisosNovistas = count($JoinTableUserDatasPermmisosVerifiView);

      return view('admin.solicitud-permisos',compact('ComentariosPermisos','UsersAlls','CantidadPermisosNovistas','PermisosData','JoinTableUserDatasPermmisosVerifiView','DescuentosSolicitudes'));
    }

    public function SearchEmergencias(Request $request){

      $nameUserSearch = $request->user_search;
      $UsersAlls = DatosPersonales::where('nombre', 'like', '%'.$nameUserSearch.'%')->get();

      $ComentariosEmergencias = ComentariosSolicitudes::all();
      $EmergenciasData = DetallesSolicitudes::where('id_tipo_solicitud', '=','2')->orderBy('id','desc')->get();

      $JoinTableUserDatasEmergenciasVerifiView =  \DB::table('datos_personales')
      ->join('detalles_solicitudes', 'datos_personales.id_usuario', '=', 'detalles_solicitudes.id_usuario')
      ->select('*')
      ->where('id_tipo_solicitud', '=','2')
      ->whereNull('solicitud_vista')
      ->get();


      $CantidadEmergenciasNovistas = count($JoinTableUserDatasEmergenciasVerifiView);

      return view('admin.emergencias',compact('ComentariosEmergencias','UsersAlls','CantidadEmergenciasNovistas','EmergenciasData'));

    }

    public function SearchSugerencias(Request $request){
      $nameUserSearch = $request->user_search;
      $UsersAlls = DatosPersonales::where('nombre', 'like', '%'.$nameUserSearch.'%')->get();

      $ComentariosSugerencias = ComentariosSolicitudes::all();
      $SugerenciasData = DetallesSolicitudes::where('id_tipo_solicitud', '=','3')->orderBy('id','desc')->get();

      $JoinTableUserDatasSugerenciasVerifiView =  \DB::table('datos_personales')
      ->join('detalles_solicitudes', 'datos_personales.id_usuario', '=', 'detalles_solicitudes.id_usuario')
      ->select('*')
      ->where('id_tipo_solicitud', '=','3')
      ->whereNull('solicitud_vista')
      ->get();

      $CantidadSugerenciasNovistas = count($JoinTableUserDatasSugerenciasVerifiView);

      return view('admin.sugerencias',compact('ComentariosSugerencias','UsersAlls','CantidadSugerenciasNovistas','SugerenciasData'));
    }

    public function SearchUsuarios(Request $request){
      // $nameUserSearch = $request->n;
      $nameUserSearch = $request->user_search;
      $UsersAlls = DatosPersonales::where('nombre', 'like', '%'.$nameUserSearch.'%')->get();

      $carbon = new \Carbon\Carbon();
      $fechaMesActual = $carbon->now()->format('m');
      $fechaYearActual = $carbon->now()->format('Y');
      $GetEvaluaciones = HistorialEvaluaciones::where('mes_evaluacion', 'like', '%'.$fechaMesActual.'%' )->where('created_at', 'like', '%'.$fechaYearActual.'%' )->get();

      $JoinTableUserDatosPersonalesDatosEmpleado =  \DB::table('datos_personales')
      ->join('datos_empleados', 'datos_personales.id_usuario', '=', 'datos_empleados.id_usuario')
      ->select('datos_personales.nombre','datos_personales.apellidos','datos_personales.foto','datos_personales.estado','datos_personales.id_usuario','datos_empleados.correo_corporativo','datos_empleados.celular','datos_empleados.extencion')
      ->where('nombre', 'like', '%'.$nameUserSearch.'%')
      ->get();

      $totalUsers = count($JoinTableUserDatosPersonalesDatosEmpleado);

      // RANKING
      $AllAdps = Adps::all();
      $HistoryAdps = HistorialAdps::all();
      $JoinTableUserDatosPersonalesDatosEmpleado =  \DB::table('datos_personales')
      ->join('datos_empleados', 'datos_personales.id_usuario', '=', 'datos_empleados.id_usuario')
      ->select('datos_personales.nombre','datos_personales.apellidos','datos_personales.foto','datos_personales.estado','datos_personales.id_usuario','datos_empleados.correo_corporativo','datos_empleados.celular','datos_empleados.extencion','datos_empleados.area_departamento')
      ->where('nombre', 'like', '%'.$nameUserSearch.'%')
      ->get();

      $rankingSInApp = $this->rankingSinAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      $RankingGeneral = $rankingSInApp;
      // $rankingWithApp = $this->RankingWithAppAsesores($JoinTableUserDatosPersonalesDatosEmpleado,$AllAdps,$HistoryAdps);
      // $RankingGeneral = $rankingWithApp;

      return view('admin.usuarios', compact('JoinTableUserDatosPersonalesDatosEmpleado','RankingGeneral','HistoryAdps','GetEvaluaciones','totalUsers'));
    }


    public function UploadChangeDirect(Request $request){
      if($request->ajax()) {
        $data= facedesrequest::all();
        $nameCarpetaTraslade = $request->nameCarpeta;
        $UbicacionCarpetaTraslade = $request->ubicacionCarpeta;
        $UbicacionArchivo = $request->ubicaArchivo;
        $idArchivo = $request->idDaArchivo;
        $nameArchiveTraslade = $request->dataNameArchivo;

        $filePath = $nameArchiveTraslade;
        $content = \Storage::disk('ubUploadsChange')->move(''.$UbicacionArchivo.''.$filePath, ''.$UbicacionArchivo.''.$nameCarpetaTraslade.'/'.$filePath.'');

        $newUbicacionArchivo = ''.$UbicacionArchivo.''.$nameCarpetaTraslade.'/';

        $DataUpdateDirectery = array(
          'ubicacion_archivo' => $newUbicacionArchivo,
        );

        $SaveData= \DB::table('documentos')
          ->where('id', '=', $idArchivo)
          ->update($DataUpdateDirectery);


        echo json_encode('enviado');
      }
    }

    public function UploadChangeDirectSnAJax(Request $request){
      $data= facedesrequest::all();

      $getNameArchivos = $request->dta_move_element;

      $getUrl = $request->_url;
      $cadena = "http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/documentos";
      $removeParteUrl = str_replace($cadena,"",$getUrl);

      if($removeParteUrl == ''){
        foreach ($getNameArchivos as $keyGetNameArchivos) {
          $filePath = $keyGetNameArchivos;
          $content = \Storage::disk('ubUploads')->move($filePath,'/archivos/'.$filePath.'');
        }

      }else{
        foreach ($getNameArchivos as $keyGetNameArchivos) {
          $filePath = $keyGetNameArchivos;
          $content = \Storage::disk('ubUploads')->move($filePath,'/archivos/'.$filePath.'');
        }
      }
    }

    public function RemoveDirectSnAJax(Request $request){
      #obtenemos la url desde donde viene la peticion, ya que cuando entren en carpetas necesitaremos la ubicacion para eliminar archivos
      #Le decimos que de la url que viene que reemplce todo lo relaciona a la variable "$Cadena"
      #Luego validamos que si por ejemplo la peticion viene de la raiz sin entrar en carpetas entonces quedara como vacio, si es vacio
      #eliminara el archivo desde la raiz.
      #SIn embargo si la consulta de eliminar viene desde carptas internas entonces concatenamos  el nombre de esas carpetas y de esa manera
      #buscara el archivo para eliminarlo
      #
      $data = facedesrequest::all();
      $getUrl = $request->_url;
      $getRemoveArchivos = $request->dta_move_element;
      $getRemoveArchivosCarpetas = $request->dta_move_element_car;
      $cadena = "http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/documentos";

      $removeParteUrl = str_replace($cadena,"",$getUrl);
      #Si vienen archivos para eliminar
      if(count($getRemoveArchivos)>0){
        if($removeParteUrl == ''){
          foreach ($getRemoveArchivos as $keyGetRemoveArchivos) {
            \Storage::disk('ubUploads')->delete('/'.$keyGetRemoveArchivos.'');
          }        
        }else{
          foreach ($getRemoveArchivos as $keyGetRemoveArchivos) {
            \Storage::disk('ubUploads')->delete(''.$removeParteUrl.'/'.$keyGetRemoveArchivos.'');        
          }
        }
      }
      #Si Son carpetas para eliminar
      elseif(count($getRemoveArchivosCarpetas)>0){
        if($removeParteUrl == ''){
          foreach ($getRemoveArchivosCarpetas as $keygetRemoveArchivosCarpetas) {
            \Storage::disk('ubUploads')->deleteDirectory('/'.$keygetRemoveArchivosCarpetas.'');
          }        
        }else{
          foreach ($getRemoveArchivosCarpetas as $keygetRemoveArchivosCarpetas) {
            \Storage::disk('ubUploads')->deleteDirectory(''.$removeParteUrl.'/'.$keygetRemoveArchivosCarpetas.'');        
          }
        }
      }
      
      Session::flash('Remove_documentos', "Los documentos han sido eliminados");
      return back()->withInput();
    }

    public function MoveDocumentos(){

      $filePath = 'etiqueta-ico.png';
      $getDirectori = \Storage::disk('ubUploads')->get($filePath);
      $content = \Storage::disk('ubUploads')->move($filePath,'/archivos/'.$filePath.'');
      dd('movido');

    }

    public function documentsDowload(Request $request){
      $file =  $request->_name_archivo;
      $fileUrl =  $request->_url;
      $fileUrl2 =  $request->_url2;
      $fileUrl3 =  $request->_url3;
      $fileUrl4 =  $request->_url4;
      $fileUrl5 =  $request->_url5;

      #Si la descarga proviene del primer folder que seleccione
      if($fileUrl == '' && $fileUrl2 == ''&& $fileUrl3 == '' && $fileUrl4 == '' && $fileUrl5 == ''){

        $entry = Documentos::where('nombre_archivo', '=', $file)->firstOrFail();
        $storagePath  = \Storage::disk('ubUploadsChange')->get('/'.$entry->ubicacion_archivo.''.$entry->nombre_archivo.'');
        // return response()->download($storagePath);
        #data
        // return (new \Response($storagePath, 200))
        //               ->header('Content-Type', $entry->mime);
        // return response()->download($storagePath);
        return response($storagePath, 200, ['Content-Type' => $entry->mime]);
        // $fileData = \Storage::disk('ubUploadsChange')->get($entry->nombre_archivo);
        // dd($storagePath);

        // $SaveFile = \Storage::disk('ubUploadsChange')->put('documents-admin/'.$nombreDocumento,  \File::get($fileDocumento));

        // $dataUploadFile = array(
        //   'nombre_archivo' => $nombreDocumento,
        //   'type_upload' => 'file',
        //   'ubicacion_archivo' => 'documents-admin/',
        // );
        // $SaveDocument = new Documentos($dataUploadFile);
        // $SaveDocument->save();

        // $path = base_path().'/public/assets/images/documents-admin/'.$file.'';    
        // return response()->download($path);
      }
      if($fileUrl != '' && $fileUrl2 == ''&& $fileUrl3 == '' && $fileUrl4 == '' && $fileUrl5 == ''){
        $path = base_path().'/public/assets/images/documents-admin/'.$fileUrl.'/'.$file.'';    
        return response()->download($path);
      }
      #Si la descarga proviene del segundo folder que seleccione
      elseif($fileUrl != '' && $fileUrl2 != '' && $fileUrl3 == '' && $fileUrl4 == '' && $fileUrl5 == ''){
        $path = base_path().'/public/assets/images/documents-admin/'.$fileUrl.'/'.$fileUrl2.'/'.$file.'';    
        return response()->download($path);
      }
      #Si la descarga proviene del tercer folder que seleccione
      elseif($fileUrl != '' && $fileUrl2 != '' && $fileUrl3 != '' && $fileUrl4 == '' && $fileUrl5 == ''){
        $path = base_path().'/public/assets/images/documents-admin/'.$fileUrl.'/'.$fileUrl2.'/'.$fileUrl3.'/'.$file.'';    
        return response()->download($path);
      }
      #Si la descarga proviene del cuarto folder que seleccione
      elseif($fileUrl != '' && $fileUrl2 != '' && $fileUrl3 != '' && $fileUrl4 != '' && $fileUrl5 == ''){
        $path = base_path().'/public/assets/images/documents-admin/'.$fileUrl.'/'.$fileUrl2.'/'.$fileUrl3.'/'.$fileUrl4.'/'.$file.'';    
        return response()->download($path);
      }
      #Si la descarga proviene del quinto folder que seleccione
      elseif($fileUrl != '' && $fileUrl2 != '' && $fileUrl3 != '' && $fileUrl4 != '' && $fileUrl5 != ''){
        $path = base_path().'/public/assets/images/documents-admin/'.$fileUrl.'/'.$fileUrl2.'/'.$fileUrl3.'/'.$fileUrl4.'/'.$fileUrl5.'/'.$file.'';    
        return response()->download($path);
      }
      
    }



    public function uploadNewArchivo(Request $request){
      $data = facedesrequest::all();

      $fileDocumento = $request->file('file_input_docuemnt_upload');
      $nombreDocumento = $fileDocumento->getClientOriginalName();
      $TipoDocumento = $fileDocumento->getClientMimeType();

      $fileUrl =  $request->_url;
      $fileUrl2 =  $request->_url2;
      $fileUrl3 =  $request->_url3;
      $fileUrl4 =  $request->_url4;
      $fileUrl5 =  $request->_url5;

      #Si la descarga proviene del primer folder que seleccione
      if($fileUrl == '' && $fileUrl2 == ''&& $fileUrl3 == '' && $fileUrl4 == '' && $fileUrl5 == ''){

        $SaveFile = \Storage::disk('ubUploadsChange')->put('documents-admin/'.$nombreDocumento,  \File::get($fileDocumento));
        #dat
        $dataUploadFile = array(
          'nombre_archivo' => $nombreDocumento,
          'mime' => $TipoDocumento,
          'type_upload' => 'file',
          'ubicacion_archivo' => 'documents-admin/',
        );
        $SaveDocument = new Documentos($dataUploadFile);
        $SaveDocument->save();
        Session::flash('Upload_document', "El Archivo ha sido subido con exito");
        return back()->withInput();
      }
      #Si la descarga proviene del primer folder que seleccione
      if($fileUrl != '' && $fileUrl2 == ''&& $fileUrl3 == '' && $fileUrl4 == '' && $fileUrl5 == ''){

        $SaveFile = \Storage::disk('ubUploadsChange')->put('documents-admin/'.$fileUrl.'/'.$nombreDocumento,  \File::get($fileDocumento));

        $dataUploadFile = array(
          'nombre_archivo' => $nombreDocumento,
          'mime' => $TipoDocumento,
          'type_upload' => 'file',
          'ubicacion_archivo' => 'documents-admin/'.$fileUrl.'/',
        );
        $SaveDocument = new Documentos($dataUploadFile);
        $SaveDocument->save();

        Session::flash('Upload_document', "El Archivo ha sido subido con exito");
        return back()->withInput();
      }
      #Si la descarga proviene del segundo folder que seleccione
      elseif($fileUrl != '' && $fileUrl2 != '' && $fileUrl3 == '' && $fileUrl4 == '' && $fileUrl5 == ''){  

        $SaveFile = \Storage::disk('ubUploadsChange')->put('documents-admin/'.$fileUrl.'/'.$fileUrl2.'/'.$nombreDocumento,  \File::get($fileDocumento));

        $dataUploadFile = array(
          'nombre_archivo' => $nombreDocumento,
          'mime' => $TipoDocumento,
          'type_upload' => 'file',
          'ubicacion_archivo' => 'documents-admin/'.$fileUrl.'/'.$fileUrl2.'/',
        );
        $SaveDocument = new Documentos($dataUploadFile);
        $SaveDocument->save();

        Session::flash('Upload_document', "El Archivo ha sido subido con exito");
        return back()->withInput();
      }
      #Si la descarga proviene del tercer folder que seleccione
      elseif($fileUrl != '' && $fileUrl2 != '' && $fileUrl3 != '' && $fileUrl4 == '' && $fileUrl5 == ''){

        $SaveFile = \Storage::disk('ubUploadsChange')->put('documents-admin/'.$fileUrl.'/'.$fileUrl2.'/'.$fileUrl3.'/'.$nombreDocumento,  \File::get($fileDocumento));

        $dataUploadFile = array(
          'nombre_archivo' => $nombreDocumento,
          'mime' => $TipoDocumento,
          'type_upload' => 'file',
          'ubicacion_archivo' => 'documents-admin/'.$fileUrl.'/'.$fileUrl2.'/'.$fileUrl3.'/',
        );
        $SaveDocument = new Documentos($dataUploadFile);
        $SaveDocument->save();

        Session::flash('Upload_document', "El Archivo ha sido subido con exito");
        return back()->withInput();
      }
      #Si la descarga proviene del cuarto folder que seleccione
      elseif($fileUrl != '' && $fileUrl2 != '' && $fileUrl3 != '' && $fileUrl4 != '' && $fileUrl5 == ''){ 

        $SaveFile = \Storage::disk('ubUploadsChange')->put('documents-admin/'.$fileUrl.'/'.$fileUrl2.'/'.$fileUrl3.'/'.$fileUrl4.'/'.$nombreDocumento,  \File::get($fileDocumento));

        $dataUploadFile = array(
          'nombre_archivo' => $nombreDocumento,
          'mime' => $TipoDocumento,
          'type_upload' => 'file',
          'ubicacion_archivo' => 'documents-admin/'.$fileUrl.'/'.$fileUrl2.'/'.$fileUrl3.'/'.$fileUrl4.'/',
        );
        $SaveDocument = new Documentos($dataUploadFile);
        $SaveDocument->save();

        Session::flash('Upload_document', "El Archivo ha sido subido con exito");
        return back()->withInput();
      }
      #Si la descarga proviene del quinto folder que seleccione
      elseif($fileUrl != '' && $fileUrl2 != '' && $fileUrl3 != '' && $fileUrl4 != '' && $fileUrl5 != ''){

        $SaveFile = \Storage::disk('ubUploadsChange')->put('documents-admin/'.$fileUrl.'/'.$fileUrl2.'/'.$fileUrl3.'/'.$fileUrl4.'/'.$fileUrl5.'/'.$nombreDocumento,  \File::get($fileDocumento));

        $dataUploadFile = array(
          'nombre_archivo' => $nombreDocumento,
          'mime' => $TipoDocumento,
          'type_upload' => 'file',
          'ubicacion_archivo' => 'documents-admin/'.$fileUrl.'/'.$fileUrl2.'/'.$fileUrl3.'/'.$fileUrl4.'/'.$fileUrl5.'/',
        );
        $SaveDocument = new Documentos($dataUploadFile);
        $SaveDocument->save();


      }

    }

    public function createDirectory(Request $request){
      $data = facedesrequest::all();
      $nameDirectorie = $request->name_carpeta_new;

      $fileUrl =  $request->_url;
      $fileUrl2 =  $request->_url2;
      $fileUrl3 =  $request->_url3;
      $fileUrl4 =  $request->_url4;
      $fileUrl5 =  $request->_url5;

      #Si la descarga proviene del primer folder que seleccione
      if($fileUrl == '' && $fileUrl2 == ''&& $fileUrl3 == '' && $fileUrl4 == '' && $fileUrl5 == ''){

        \Storage::disk('ubUploadsChange')->makeDirectory('documents-admin/'.$nameDirectorie.'');

        $dataUploadFile = array(
          'nombre_archivo' => $nameDirectorie,
          'type_upload' => 'carpeta',
          'ubicacion_anterior' => 'documents-admin/',
          'ubicacion_archivo' => '/'.$nameDirectorie.'',
        );
        $SaveDocument = new Documentos($dataUploadFile);
        $SaveDocument->save();

        Session::flash('Create_directorie', "La carpeta ha sido creada");
        return back()->withInput();
      }
      #Si la descarga proviene del primer folder que seleccione
      if($fileUrl != '' && $fileUrl2 == ''&& $fileUrl3 == '' && $fileUrl4 == '' && $fileUrl5 == ''){

        \Storage::disk('ubUploadsChange')->makeDirectory('documents-admin/'.$fileUrl.'/'.$nameDirectorie.'');

        $dataUploadFile = array(
          'nombre_archivo' => $nameDirectorie,
          'type_upload' => 'carpeta',
          'ubicacion_anterior' => 'documents-admin/'.$fileUrl.'/',
          'ubicacion_archivo' => '/'.$fileUrl.'/'.$nameDirectorie.'',
        );
        $SaveDocument = new Documentos($dataUploadFile);
        $SaveDocument->save();

        Session::flash('Create_directorie', "La carpeta ha sido creada");
        return back()->withInput();
      }
      #Si la descarga proviene del segundo folder que seleccione
      elseif($fileUrl != '' && $fileUrl2 != '' && $fileUrl3 == '' && $fileUrl4 == '' && $fileUrl5 == ''){  

        \Storage::disk('ubUploadsChange')->makeDirectory('documents-admin/'.$fileUrl.'/'.$fileUrl2.'/'.$nameDirectorie.'');

        $dataUploadFile = array(
          'nombre_archivo' => $nameDirectorie,
          'type_upload' => 'carpeta',
          'ubicacion_anterior' => 'documents-admin/'.$fileUrl.'/'.$fileUrl2.'/',
          'ubicacion_archivo' => '/'.$fileUrl.'/'.$fileUrl2.'/'.$nameDirectorie.'',
        );
        $SaveDocument = new Documentos($dataUploadFile);
        $SaveDocument->save();

        Session::flash('Create_directorie', "La carpeta ha sido creada");
        return back()->withInput();
      }
      #Sis la descarga proviene del tercer folder que seleccione
      elseif($fileUrl != '' && $fileUrl2 != '' && $fileUrl3 != '' && $fileUrl4 == '' && $fileUrl5 == ''){

        \Storage::disk('ubUploadsChange')->makeDirectory('documents-admin/'.$fileUrl.'/'.$fileUrl2.'/'.$fileUrl3.'/'.$nameDirectorie.'');

        $dataUploadFile = array(
          'nombre_archivo' => $nameDirectorie,
          'type_upload' => 'carpeta',
          'ubicacion_anterior' => 'documents-admin/'.$fileUrl.'/'.$fileUrl2.'/'.$fileUrl3.'/',
          'ubicacion_archivo' => '/'.$fileUrl.'/'.$fileUrl2.'/'.$fileUrl3.'/'.$nameDirectorie.'',
        );
        $SaveDocument = new Documentos($dataUploadFile);
        $SaveDocument->save();


        Session::flash('Create_directorie', "La carpeta ha sido creada");
        return back()->withInput();
      }
      #Si la descarga proviene del cuarto folder que seleccione
      elseif($fileUrl != '' && $fileUrl2 != '' && $fileUrl3 != '' && $fileUrl4 != '' && $fileUrl5 == ''){ 

        \Storage::disk('ubUploadsChange')->makeDirectory('documents-admin/'.$fileUrl.'/'.$fileUrl2.'/'.$fileUrl3.'/'.$fileUrl4.'/'.$nameDirectorie.'');

        $dataUploadFile = array(
          'nombre_archivo' => $nameDirectorie,
          'type_upload' => 'carpeta',
          'ubicacion_anterior' => 'documents-admin/'.$fileUrl.'/'.$fileUrl2.'/'.$fileUrl3.'/'.$fileUrl4.'/',
          'ubicacion_archivo' => '/'.$fileUrl.'/'.$fileUrl2.'/'.$fileUrl3.'/'.$fileUrl4.'/'.$nameDirectorie.'',
        );
        $SaveDocument = new Documentos($dataUploadFile);
        $SaveDocument->save();

        Session::flash('Create_directorie', "La carpeta ha sido creada");
        return back()->withInput();
      }
      #Si la descarga proviene del quinto folder que seleccione
      elseif($fileUrl != '' && $fileUrl2 != '' && $fileUrl3 != '' && $fileUrl4 != '' && $fileUrl5 != ''){

        \Storage::disk('ubUploadsChange')->makeDirectory('documents-admin/'.$fileUrl.'/'.$fileUrl2.'/'.$fileUrl3.'/'.$fileUrl4.'/'.$fileUrl5.'/'.$nameDirectorie.'');

        $dataUploadFile = array(
          'nombre_archivo' => $nameDirectorie,
          'type_upload' => 'carpeta',
          'ubicacion_anterior' => 'documents-admin/'.$fileUrl.'/'.$fileUrl2.'/'.$fileUrl3.'/'.$fileUrl4.'/'.$fileUrl5.'/',
          'ubicacion_archivo' => '/'.$fileUrl.'/'.$fileUrl2.'/'.$fileUrl3.'/'.$fileUrl4.'/'.$fileUrl5.'/'.$nameDirectorie.'',
        );
        $SaveDocument = new Documentos($dataUploadFile);
        $SaveDocument->save();


        Session::flash('Create_directorie', "La carpeta ha sido creada");
        return back()->withInput();
      }

    }

    public function addAdps(Request $request){
      $data = facedesrequest::all();
      $UsersAdp = DatosPersonales::where('id_usuario', '=', $request->_id_usuario)->get();
      $idAsistencia = $request->_id_asistencia;

      #Configuramos la hora local
      date_default_timezone_set('America/Monterrey');
      $fechaActual = date('Y-m-d');

      $dataStoreAdp = array(
        'fecha' => $fechaActual,
        'id_adp' => $request->type_adp,
        'id_asistencias' => $idAsistencia,
        'id_usuario' => $request->_id_usuario,
      );

      $ColocacionAdp = new HistorialAdps($dataStoreAdp);
      $ColocacionAdp->save();
      
      Session::flash('Colocacion_Adp', $UsersAdp);
      return back()->withInput();
    }

    public function addAdpsInRanking(Request $request){
      $data = facedesrequest::all();
      $UsersAdp = DatosPersonales::where('id_usuario', '=', $request->_id_usuario)->get();

      #Configuramos la hora local
      date_default_timezone_set('America/Monterrey');
      $fechaActual = date('Y-m-d');

      $dataStoreAdp = array(
        'fecha' => $fechaActual,
        'id_adp' => $request->id_adp,
        'id_usuario' => $request->_id_usuario,
      );

      $ColocacionAdp = new HistorialAdps($dataStoreAdp);
      $ColocacionAdp->save();
      
      Session::flash('Colocacion_Adp_ranking', "La ADP ha sido colocada");
      return back()->withInput();
    }

    public function CreateNotificaciones(Request $request){
      $data = facedesrequest::all();

      $dataCreateNotify = array(
        'titulo_evento' => $request->title_notifi,
        'descripcion_evento' => $request->descrip_notify,
        'color_evento' => $request->color_notify,
      );

      $saveNotificaciones = new NotificacionesEventos($dataCreateNotify);
      $saveNotificaciones = $saveNotificaciones->save();

      Session::flash('Create_notify', "Tu notificación fue creada con exito");
      return back()->withInput();
    }

    public function getNotificaciones(){
      $AllTypeNotficaciones = NotificacionesEventos::all();
      return $AllTypeNotficaciones;
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

      #Get notificaciones
      $GetActividadesFechas = HistorialActividadesRecientes::orderBy('id', 'desc')->get();
      $totalNotifciaciones = $this->ValidaNotificaciones($GetActividadesFechas);

      return view('admin.partials.fields-previuw-detall', compact('JoinTableUserPosts','idusers','idpost','getPost','Likes','Coments','idUserLogin','arrayOfImages','ArrayOfDocuemnts','Activities','NotifisEventos','AllPost','ActivitiesNotifys','GetActividadesFechas','totalNotifciaciones'));
    }



}
