<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Chats;

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
        $Users = User::all();
        return $Users;
    }
    
    public function index()
    {
        return view('usuarios.home');
    }

    public function profile()
    {
        return view('usuarios.profile');
    }

    public function profileOfUser()
    {
        return view('usuarios.profile-of-user');
    }

    public function RankingEmpleados()
    {
        return view('usuarios.ranking-empleados');
    }

    public function ChatEmpleados()
    {
        // $ChatWithUsers = User::all();
        $getUsers = $this->AllUsers();
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

        // $id_ForChat = $request->idForChat;
        $idUserLogin = Auth::user()->id;

        // $ConversationBetwwenUser = Chats::where('id_user','=',$idUserLogin)->where('id_user_conversation','=',$id_ForChat);

        $ConversationBetwwenUser = Chats::where('id_user','=',$idUserLogin)->get();
        $ConversationBetwwenUser2 = Chats::where('id_user_conversation','=',$idUserLogin)->get();

        foreach ($ConversationBetwwenUser as $keyConversationBetwwenUser) {
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
                    $newFechaConversation = array('id' => $keyConversationBetwwenUser->id,'id_user' => $keyConversationBetwwenUser->id_user,'id_user_conversation' => $keyConversationBetwwenUser->id_user_conversation,'fecha_conver' => $Fechas,'time_send' => $time,'userSend' => 1,'userReceive' => 0,'mensages' => $arrayMensages);
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
                              $newFechaConversation = array('id' => $keyConversationBetwwenUser->id,'id_user' => $keyConversationBetwwenUser->id_user,'id_user_conversation' => $keyConversationBetwwenUser->id_user_conversation,'fecha_conver' => $Fechas,'time_send' => $time,'userSend' => 1,'userReceive' => 0,'mensages' => $newGruopMensages);
                              array_push($arrayMensagesFechas,$newFechaConversation);

                           }
                        }
                    }else{
                        $arrayMensages = array();
                        $getMensages = $keyConversationBetwwenUser->conversations;
                        array_push($arrayMensages,$getMensages);
                        $getDates = $Fechas;
                        array_push($arrayGetDates,$getDates);
                        $newFechaConversation = array('id' => $keyConversationBetwwenUser->id,'id_user' => $keyConversationBetwwenUser->id_user,'id_user_conversation' => $keyConversationBetwwenUser->id_user_conversation,'fecha_conver' => $Fechas,'time_send' => $time,'userSend' => 1,'userReceive' => 0,'mensages' => $arrayMensages);
                        array_push($arrayMensagesFechas,$newFechaConversation);
                    }                                 
                }
        }
        

        foreach ($ConversationBetwwenUser2 as $keyConversationBetwwenUser2) {
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
                    $newFechaConversation2 = array('id' => $keyConversationBetwwenUser->id,'id_user' => $keyConversationBetwwenUser->id_user,'id_user_conversation' => $keyConversationBetwwenUser->id_user_conversation,'fecha_conver' => $Fechas2,'time_send' => $time2,'userReceive' => 1,'userSend' => 0,'mensages' => $arrayMensages2);
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
                              $newFechaConversation2 = array('id' => $keyConversationBetwwenUser->id,'id_user' => $keyConversationBetwwenUser->id_user,'id_user_conversation' => $keyConversationBetwwenUser->id_user_conversation,'fecha_conver' => $Fechas2,'time_send' => $time2,'userReceive' => 1,'userSend' => 0,'mensages' => $newGruopMensages2);
                              array_push($arrayMensagesFechas2,$newFechaConversation2);

                           }
                        }
                    }else{
                        $arrayMensages2 = array();
                        $getMensages2 = $keyConversationBetwwenUser2->conversations;
                        array_push($arrayMensages2,$getMensages2);
                        $getDates2 = $Fechas2;
                        array_push($arrayGetDates2,$getDates2);
                        $newFechaConversation2 = array('id' => $keyConversationBetwwenUser->id,'id_user' => $keyConversationBetwwenUser->id_user,'id_user_conversation' => $keyConversationBetwwenUser->id_user_conversation,'fecha_conver' => $Fechas2,'time_send' => $time2,'userReceive' => 1,'userSend' => 0,'mensages' => $arrayMensages2);
                        array_push($arrayMensagesFechas2,$newFechaConversation2);
                    }                                 
                }
        }

        /** Unimos las conversaciones y los ordenamos por fechas */
        $UnionConversation = array_merge_recursive($arrayMensagesFechas, $arrayMensagesFechas2);
        sort($UnionConversation);

        // Busco el total de posiciones
        foreach ($UnionConversation as $keyUnionConversation => $valueUnion) {
            $numeroPocicion =$keyUnionConversation;
        }

        $restandoUnaPocicion =$numeroPocicion-1;
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


        $ArrayNuevosMensajes = array();
        $banderaUltimeData = 0;
        $arrayGetIdCOnver = array();

             dd($SendAndRecive);
        foreach ($SendAndRecive as $keyarrayMensagesFechas => $valueSendAndRecive) {
            
            $getIdCOnver = $valueSendAndRecive['id_user_conversation'];
            $positionOfArrayConten =$keyarrayMensagesFechas;
            if($banderaUltimeData == 0){
                array_push($arrayGetIdCOnver,$getIdCOnver);

                $ultimeMensages = array('id' => $keyConversationBetwwenUser['id'],'id_user' => $keyConversationBetwwenUser['id_user'],'id_user_conversation' => $keyConversationBetwwenUser['id_user_conversation'],'conversation' => $keyConversationBetwwenUser['conversations'],'fecha_conver' => $Fechas2,'time_send' => $time2,'userReceive' => 1,'userSend' => 0,'mensages' => $arrayMensages2);
                array_push($ArrayNuevosMensajes,$ultimeMensages);

                $banderaUltimeData = $banderaUltimeData+1;
            }elseif($banderaUltimeData == 1){
                echo 'entro aca';
                if(in_array($getIdCOnver, $arrayGetIdCOnver)){
                    // dd($ArrayNuevosMensajes);
                    unset($ArrayNuevosMensajes[$positionOfArrayConten]);
                    $ultimeMensages = array('id' => $keyConversationBetwwenUser['id'],'id_user' => $keyConversationBetwwenUser['id_user'],'id_user_conversation' => $keyConversationBetwwenUser['id_user_conversation'],'conversation' => $keyConversationBetwwenUser['conversations'],'fecha_conver' => $Fechas2,'time_send' => $time2,'userReceive' => 1,'userSend' => 0,'mensages' => $arrayMensages2);
                    array_push($ArrayNuevosMensajes,$ultimeMensages);
                }else{
                    $ultimeMensages = array('id' => $keyConversationBetwwenUser['id'],'id_user' => $keyConversationBetwwenUser['id_user'],'id_user_conversation' => $keyConversationBetwwenUser['id_user_conversation'],'conversation' => $keyConversationBetwwenUser['conversations'],'fecha_conver' => $Fechas2,'time_send' => $time2,'userReceive' => 1,'userSend' => 0,'mensages' => $arrayMensages2);
                    array_push($ArrayNuevosMensajes,$ultimeMensages);
                }
            }
        }

        dd($ArrayNuevosMensajes);

        echo json_encode($SendAndRecive);

        return view('usuarios.chatUsers', compact('getUsers'));
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
                    /*Creamos primer array para iniciar*/
                    if($bande == 0){
                        /*Guardamos el mensaje en el array*/
                        $getMensages = $keyConversationBetwwenUser->conversations;
                        array_push($arrayMensages,$getMensages);
                        /*Guardamos la fechas en el array*/
                        $getDates = $Fechas;
                        array_push($arrayGetDates,$getDates);
                        /*Creamos nuestro bloque de fecha y mensajes enviados*/
                        $newFechaConversation = array('fecha_conver' => $Fechas,'time_send' => $time,'userSend' => 1,'userReceive' => 0,'mensages' => $arrayMensages);
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
                                  $newFechaConversation = array('fecha_conver' => $Fechas,'time_send' => $time,'userSend' => 1,'userReceive' => 0,'mensages' => $newGruopMensages);
                                  array_push($arrayMensagesFechas,$newFechaConversation);

                               }
                            }
                        }else{
                            $arrayMensages = array();
                            $getMensages = $keyConversationBetwwenUser->conversations;
                            array_push($arrayMensages,$getMensages);
                            $getDates = $Fechas;
                            array_push($arrayGetDates,$getDates);
                            $newFechaConversation = array('fecha_conver' => $Fechas,'time_send' => $time,'userSend' => 1,'userReceive' => 0,'mensages' => $arrayMensages);
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
                        $newFechaConversation2 = array('fecha_conver' => $Fechas2,'time_send' => $time2,'userReceive' => 1,'userSend' => 0,'mensages' => $arrayMensages2);
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
                                  $newFechaConversation2 = array('fecha_conver' => $Fechas2,'time_send' => $time2,'userReceive' => 1,'userSend' => 0,'mensages' => $newGruopMensages2);
                                  array_push($arrayMensagesFechas2,$newFechaConversation2);

                               }
                            }
                        }else{
                            $arrayMensages2 = array();
                            $getMensages2 = $keyConversationBetwwenUser2->conversations;
                            array_push($arrayMensages2,$getMensages2);
                            $getDates2 = $Fechas2;
                            array_push($arrayGetDates2,$getDates2);
                            $newFechaConversation2 = array('fecha_conver' => $Fechas2,'time_send' => $time2,'userReceive' => 1,'userSend' => 0,'mensages' => $arrayMensages2);
                            array_push($arrayMensagesFechas2,$newFechaConversation2);
                        }                                 
                    }
                }
            }

            /** Unimos las conversaciones y los ordenamos por fechas */
            $UnionConversation = array_merge_recursive($arrayMensagesFechas, $arrayMensagesFechas2);
            sort($UnionConversation);

            // Busco el total de posiciones
            foreach ($UnionConversation as $keyUnionConversation => $valueUnion) {
                $numeroPocicion =$keyUnionConversation;
            }

            $restandoUnaPocicion =$numeroPocicion-1;
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

            echo json_encode($SendAndRecive);
 
        }
    }

    public function Calendar()
    {
        return view('usuarios.calendario');
    }

    public function SolicitudPermiso()
    {
        return view('usuarios.solicitud-permiso');
    }

    public function SolicitudPermisoEmergencia()
    {
        return view('usuarios.motivo-emergencia');
    }

    public function BuzonSugerencias()
    {
        return view('usuarios.buzon-sugerencias');
    }

    public function EvaluationToPersonal()
    {
        return view('usuarios.evaluaciones-a-personal');
    }

    public function EvaluationToPersonalDetall($id)
    {
        return view('usuarios.evaluaciones-a-personal-detall');
    }

    public function EvaluationToPersonalEvaluados()
    {
        return view('usuarios.evaluaciones-a-personal-evaluados');
    }

    public function FinishEvaluation()
    {
        return view('usuarios.finish-evaluaction');
    }
}
