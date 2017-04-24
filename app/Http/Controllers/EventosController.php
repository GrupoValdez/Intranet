<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as facedesrequest;
use Auth;
use Session;
use App\User;
use App\EventosCalendario;
use App\DatosPersonales;
use App\HistorialActividadesRecientes;

class EventosController extends Controller
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

    

    public function StorEvent(Request $request){
      $data = facedesrequest::all();

      # Obteniendo informacion del evento
      $idUserPublicEvent = $request->id_user_evento;
      $fechaEvent = $request->fecha_start_evento;
      $DescripcionEvento = $request->evento_descript;

      # Los datos Obtenidos los almacenamos en un array 
      $dataEvento = array(
        'descripcion_evento' => $DescripcionEvento,
        'fecha_evento' => $fechaEvent,
        'id_usuario' => $idUserPublicEvent,
      );

      # Los datos Obtenidos los guardamos 
      $createNewEvent = new EventosCalendario($dataEvento);
      $createNewEvent->save();


      // CREATE ACTIVIDADES
      $usuarioPublic = $idUserPublicEvent;
      $idPostPublicado = '0';
      $tipoActividad = '13';
      $IdEvenCalendar = $createNewEvent->id;

      $Usuarios = DatosPersonales::where('id_usuario', '=', $usuarioPublic)->get();

      foreach ($Usuarios as $keyUsuarios) {
        if($usuarioPublic == $keyUsuarios->id_usuario){
          $nameUser = $keyUsuarios->nombre.' '.$keyUsuarios->apellidos;
          $DescriptActiviti = 'Agrego un nuevo evento';
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

      Session::flash('Create_Event', "El Evento ha sido creado");
      return back()->withInput();
    }


}
