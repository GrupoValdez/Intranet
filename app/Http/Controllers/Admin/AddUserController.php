<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as facedesrequest;
use Illuminate\Support\Facades\Redirect;
use Session;
use Auth;

use App\User;
use App\DatosPersonales;
use App\FormacionAcademica;
use App\DatosEmpleados;
use App\Horarios;
use App\VacacionesUsers;


class AddUserController extends Controller
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

  /*
  |--------------------------------------------------------------------------
  | Creando Usuario
  |--------------------------------------------------------------------------
  |
  */

  public function DataCreateUser($request){

    $DataCreateUser = array(
      'name' => $request->name_user,
      'email' => $request->correo_corporativo,
      'password' => bcrypt($request->password),
      'password_respal' => $request->password,
      'type' => $request->type_user,
    );

    $NewUser = new User($DataCreateUser);  
    $NewUser->save();
    $idOfUserCreate = $NewUser->id;

    return $idOfUserCreate;
  }

  /*
    |--------------------------------------------------------------------------
    | Almacenando informacion personal del usuario
    |--------------------------------------------------------------------------
    |
  */

  public function DataInformationPersonal($request, $IdUserCreate){

    // Get data Foto
    $fileFoto = $request->file('foto_user');
    $nombreFoto = $fileFoto->getClientOriginalName();
    $fileNameFoto = rand(11,99999);
    $imageName = $fileNameFoto.'.'.$request->file('foto_user')->getClientOriginalExtension();
    $request->file('foto_user')->move(
        base_path() . '/public/assets/profiles/', $imageName
    );

    $dataInformationPersonal = array(
      'nombre' => $request->name_user,
      'last_name' => $request->two_name_user,
      'apellidos' => $request->apellidos_user,
      'genero' => $request->genere_user,
      'estado_civil' => $request->estado_civil_user,
      'direccion' => $request->direction_user,
      'departamento' => $request->departamento_user,
      'municipio' => $request->municipio_user,
      'correo_personal' => $request->email_user,
      'cumpleanos' => $request->cumple_user,
      'foto' => $imageName,
      'estado' => '1',
      'id_usuario' => $IdUserCreate,
    );

    $DataStorePersonal = new DatosPersonales($dataInformationPersonal);  
    $DataStorePersonal->save();

    return $DataStorePersonal;
  }

  /*
    |--------------------------------------------------------------------------
    | Almacenando Informacion academica del usuario
    |--------------------------------------------------------------------------
    |
  */

  public function DataFormacionAcademy($request, $IdUserCreate){

    $dataFormacionAcademi = array(
      'bachillerato' => $request->bachiller,
      'tecnico' => $request->tecnico,
      'superior' => $request->superior,
      'postgrado' => $request->posgrado,
      'diplomado' => $request->diplomado,
      'other_conocimiento' => $request->other_conoci,
      'habilidades' => $request->habilidades,
      'id_usuario' => $IdUserCreate,
    );

    $DataStoreFormationAcemy = new FormacionAcademica($dataFormacionAcademi);  
    $DataStoreFormationAcemy->save();

    return $DataStoreFormationAcemy;

  }

  /*
    |--------------------------------------------------------------------------
    | Almacenando Informacion del empleado
    |--------------------------------------------------------------------------
    |
  */

  public function DataInformacionEmpleado($request, $IdUserCreate){

    $dataInformacionEmpleado = array(
      'correo_corporativo' => $request->correo_corporativo,
      'celular' => $request->cel_user,
      'extencion' => $request->ext_user,
      'fecha_ingreso' => $request->fecha_ingreso_user,
      'area_departamento' => $request->area_user,
      'cargo' => $request->cargo_user,
      'jefe_inmediato' => $request->Jefe_inmediato_user,
      'id_marca' => $request->marca_user,
      'id_sucursal' => $request->sucursal_user,
      'id_usuario' => $IdUserCreate,
    );

    $DataStoreInformacionEmpleado = new DatosEmpleados($dataInformacionEmpleado);  
    $DataStoreInformacionEmpleado->save();

    return $DataStoreInformacionEmpleado;
  }

  /*
    |--------------------------------------------------------------------------
    | Almacenando Horarios del empleado
    |--------------------------------------------------------------------------
    |
  */

  public function DataHorarios($request, $IdUserCreate){

    $data = facedesrequest::all();
    $lunes = '';
    $martes = '';
    $miercoles = '';
    $jueves = '';
    $viernes = '';
    $sabado = '';
    $domingo = '';

    $getHorariosC1 = $request->get_horariosc1;
    $getHorariosC1Time = $request->get_horariosc1_time;
    $getHorariosC2 = $request->get_horariosc2;
    $getHorariosC2Time = $request->get_horariosc2_time;
    $getHorariosC3 = $request->get_horariosc3;
    $getHorariosC3Time = $request->get_horariosc3_time;
    $getHorariosM1 = $request->get_horariosm1;
    $getHorariosM1Time = $request->get_horariosm1_time;
    $getHorariosM2 = $request->get_horariosm2;
    $getHorariosM2Time = $request->get_horariosm2_time;
    $getHorariosM3 = $request->get_horariosm3;
    $getHorariosM3Time = $request->get_horariosm3_time;

    $DataArraysHorrarios = array(
      'bloq_horario1' => $getHorariosC1,
      'bloq_horario1Time' => $getHorariosC1Time,
      'bloq_horario2' => $getHorariosC2,
      'bloq_horario2Time' => $getHorariosC2Time,
      'bloq_horario3' => $getHorariosC3,
      'bloq_horario3Time' => $getHorariosC3Time,
      'bloq_horarioMedio1' => $getHorariosM1,
      'bloq_horarioMedio1Time' => $getHorariosM1Time,
      'bloq_horarioMedio2' => $getHorariosM2,
      'bloq_horarioMedio2Time' => $getHorariosM2Time,
      'bloq_horarioMedio3' => $getHorariosM3,
      'bloq_horarioMedio3Time' => $getHorariosM3Time,
      'id_usuario' => $IdUserCreate,
    );
    
    $DataStoreHorarios = new Horarios($DataArraysHorrarios);  
    $DataStoreHorarios->save();

    return $DataStoreHorarios;
  }

  /*
    |--------------------------------------------------------------------------
    | Almacenando las Vacaciones del usuario
    |--------------------------------------------------------------------------
    |
  */

  public function CreateDaysHolidays($request, $IdUserCreate){

    $fechaIngreso = $request->fecha_ingreso_user;
    $nuevafecha = strtotime('+1 year',strtotime ($fechaIngreso));
    $fechaVacaciones = date('Y-m-j',$nuevafecha);
    $dataVacaciones = array(
      'dias' => '15',
      'fecha_vacaciones' => $fechaVacaciones,
      'id_usuario' => $IdUserCreate,
    );

    $DataStoreVacaciones = new VacacionesUsers($dataVacaciones);  
    $DataStoreVacaciones->save();

    return $DataStoreVacaciones;
  }

  /*
    |--------------------------------------------------------------------------
    | Llamando a todos los metodos para almacenar el suaurio
    |--------------------------------------------------------------------------
    |
  */
  
  public function StoreAddUser(Request $request){
    
    $IdUserCreate = $this->DataCreateUser($request);
    $StorePersonalData = $this->DataInformationPersonal($request, $IdUserCreate);
    $StoreFormationAcademyData = $this->DataFormacionAcademy($request, $IdUserCreate);
    $StoreInformationEmpleado = $this->DataInformacionEmpleado($request, $IdUserCreate);
    $StoreDataHorarios = $this->DataHorarios($request, $IdUserCreate);
    $StoreCreateVacaciones = $this->CreateDaysHolidays($request, $IdUserCreate);
    
    Session::flash('Create_User', "El usuario ha sido creado");
    return back()->withInput();

  }

  #Get the profile photo of the user to update
  public function StoreUploadFotoEdit(Request $request, $id){
    $data = facedesrequest::all();

    // Get data Foto and id User
    $fileFoto = $request->file('myfile');
    $nombreFoto = $fileFoto->getClientOriginalName();
    $fileNameFoto = rand(11,99999);
    $imageName = $fileNameFoto.'.'.$request->file('myfile')->getClientOriginalExtension();
    $request->file('myfile')->move(
        base_path() . '/public/assets/profiles/', $imageName
    );

    $dataUpdateFotoProfileUser = array(
      'foto' => $imageName,
    );

    $UpdatePhotoProfile= \DB::table('datos_personales')
      ->where('id_usuario', '=', $id)
      ->update($dataUpdateFotoProfileUser);
    
    return;

  }

  public function saveEditUser(Request $request, $id){
    $data = facedesrequest::all();
    // DatosEmpleados

    $dataUpdateInformacionUser = array(
      'area_departamento' => $request->data_departamento_edit,
      'cargo' => $request->data_cargo_edit,
      'jefe_inmediato' => $request->data_jefe_edit,
      'correo_corporativo' => $request->data_correo_corpo_edit,
      'celular' => $request->data_celular_edit,
      'extencion' => $request->data_extencion_edit, 
    );

    $SaveUpdateEmpleado= \DB::table('datos_empleados')
      ->where('id_usuario', '=', $id)
      ->update($dataUpdateInformacionUser);

    $dataUpdateInfromacionPersonal = array(
      'genero' => $request->data_genero_edit,
      'estado_civil' => $request->data_estado_civil_edit,
      'cumpleanos' => $request->data_cumple_edit,
      'direccion' => $request->data_direccion_edit,
    );
    $SaveUpdateUserPersonal= \DB::table('datos_personales')
      ->where('id_usuario', '=', $id)
      ->update($dataUpdateInfromacionPersonal);


    $dataUpdateHorarios = array(
      'bloq_horario1' => $request->get_horariosc1,
      'bloq_horario1Time' => $request->get_horariosc1_time,
      'bloq_horario2' => $request->get_horariosc2,
      'bloq_horario2Time' => $request->get_horariosc2_time,
      'bloq_horario3' => $request->get_horariosc3,
      'bloq_horario3Time' => $request->get_horariosc3_time,
      'bloq_horarioMedio1' => $request->get_horarios_medioc1,
      'bloq_horarioMedio1Time' => $request->get_horariosc1_time_medio,
      'bloq_horarioMedio2' => $request->get_horarios_medioc2,
      'bloq_horarioMedio2Time' => $request->get_horariosc2_time_medio,
      'bloq_horarioMedio3' => $request->get_horariosc3_medio,
      'bloq_horarioMedio3Time' => $request->get_horariosc3_time_medio,
    );

    $SaveUpdateUserHorarios= \DB::table('horarios')
      ->where('id_usuario', '=', $id)
      ->update($dataUpdateHorarios);

    Session::flash('Update_User', "El usuario ha sido actualizado");
    return back()->withInput();

  }

  public function saveEditUserHorarios(Request $request, $id){
    $data = facedesrequest::all();
    $dataUpdateHorarios = array(
      'bloq_horario1' => $request->get_horariosc1,
      'bloq_horario1Time' => $request->get_horariosc1_time,
      'bloq_horario2' => $request->get_horariosc2,
      'bloq_horario2Time' => $request->get_horariosc2_time,
      'bloq_horario3' => $request->get_horariosc3,
      'bloq_horario3Time' => $request->get_horariosc3_time,
      'bloq_horarioMedio1' => $request->get_horarios_medioc1,
      'bloq_horarioMedio1Time' => $request->get_horariosc1_time_medio,
      'bloq_horarioMedio2' => $request->get_horarios_medioc2,
      'bloq_horarioMedio2Time' => $request->get_horariosc2_time_medio,
      'bloq_horarioMedio3' => $request->get_horariosc3_medio,
      'bloq_horarioMedio3Time' => $request->get_horariosc3_time_medio,
    );

    $SaveUpdateUserHorarios= \DB::table('horarios')
      ->where('id_usuario', '=', $id)
      ->update($dataUpdateHorarios);

    Session::flash('Update_User', "El usuario ha sido actualizado");
    return back()->withInput();

  }


  public function saveEditUsersGroup(Request $request)
  {
    $data = facedesrequest::all();
    // dd($data);
   $totalUsersEdit = count($request->id_user_group);
   for ($i=0; $i <=$totalUsersEdit-1; $i++) { 
      $DataIdUserEdit = $request->id_user_group[$i];

      $dataUpdateInformacionUser = array(
        'area_departamento' => $request->data_departamento_edit,
        'cargo' => $request->data_cargo_edit,
        'jefe_inmediato' => $request->data_jefe_edit,
      );
      $SaveUpdateEmpleado= \DB::table('datos_empleados')
        ->where('id_usuario', '=', $DataIdUserEdit)
        ->update($dataUpdateInformacionUser);

      $dataUpdateInfromacionPersonal = array(
        'genero' => $request->data_genero_edit,
        'estado_civil' => $request->data_estado_civil_edit,
      );
      $SaveUpdateUserPersonal= \DB::table('datos_personales')
        ->where('id_usuario', '=', $DataIdUserEdit)
        ->update($dataUpdateInfromacionPersonal);

      $dataUpdateHorarios = array(
        'bloq_horario1' => $request->get_horariosc1,
        'bloq_horario1Time' => $request->get_horariosc1_time,
        'bloq_horario2' => $request->get_horariosc2,
        'bloq_horario2Time' => $request->get_horariosc2_time,
        'bloq_horario3' => $request->get_horariosc3,
        'bloq_horario3Time' => $request->get_horariosc3_time,
        'bloq_horarioMedio1' => $request->get_horarios_medioc1,
        'bloq_horarioMedio1Time' => $request->get_horariosc1_time_medio,
        'bloq_horarioMedio2' => $request->get_horarios_medioc2,
        'bloq_horarioMedio2Time' => $request->get_horariosc2_time_medio,
        'bloq_horarioMedio3' => $request->get_horariosc3_medio,
        'bloq_horarioMedio3Time' => $request->get_horariosc3_time_medio,
      );

      $SaveUpdateUserHorarios= \DB::table('horarios')
        ->where('id_usuario', '=', $DataIdUserEdit)
        ->update($dataUpdateHorarios);
   }

   Session::flash('Update_UsersGroup', "Los usuario han sido actualizado");
   return back()->withInput();    

  }



}
