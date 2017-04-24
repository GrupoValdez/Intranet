<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


/*
|--------------------------------------------------------------------------
| lllamar routas de login y registro
|--------------------------------------------------------------------------
|
*/
	Route::get('/', function () {
	    return view('auth.login');
	});
	Auth::routes();

	// Route::get('/chat', function () {
	//     return view('chat');
	// });

	// Route::get('/chatdemo', 'ChatController@index');

/*
|--------------------------------------------------------------------------
| Home Users
|--------------------------------------------------------------------------
|
*/
	Route::get('/home', 'HomeController@index');

/*
|--------------------------------------------------------------------------
| Route Logout
|--------------------------------------------------------------------------
|
*/
	Route::post('/datalogout', 'HomeController@DataLogout');
/*
|--------------------------------------------------------------------------
| Route Logout
|--------------------------------------------------------------------------
|
*/
	Route::post('/logout', 'HomeController@logOut');

/*
|--------------------------------------------------------------------------
| Route Online User
|--------------------------------------------------------------------------
|
*/
	Route::post('/onlineUser', 'HomeController@UsersOnlineAjax');


/*
|--------------------------------------------------------------------------
| Profile Users
|--------------------------------------------------------------------------
|
*/
	Route::get('/profile', 'HomeController@profile');
/*
|--------------------------------------------------------------------------
| Profile Del usuario
|--------------------------------------------------------------------------
|
*/
	Route::get('/profile-users/{id}', 'HomeController@profileOfUser');

	/*
	|--------------------------------------------------------------------------
	| Profile Users edit update
	|--------------------------------------------------------------------------
	|
	*/
		Route::get('/profileUpdateUser', 'HomeController@updateProfileUser');
		Route::post('/profileUpdateUser', 'HomeController@updateProfileUser');

/*
|--------------------------------------------------------------------------
| Ranking de Empleados
|--------------------------------------------------------------------------
|
*/
	// PENDIENTE
	Route::get('/ranking-empleados', 'HomeController@RankingEmpleados');


/*
|--------------------------------------------------------------------------
| Chat entre Empleados
|--------------------------------------------------------------------------
|
*/
	Route::get('/chatUsers', 'HomeController@ChatEmpleados');
	Route::post('/chatUsers', 'HomeController@storeChat');

	/*
	|--------------------------------------------------------------------------
	| Upload archivos
	|--------------------------------------------------------------------------
	|
	*/
		Route::get('/uploadArchive', 'HomeController@UploadArchivos');
		Route::post('/uploadArchive', 'HomeController@UploadArchivos');



/*
|--------------------------------------------------------------------------
| Calendario
|--------------------------------------------------------------------------
|
*/
	Route::get('/calendario', 'HomeController@Calendar');


/*
|--------------------------------------------------------------------------
| Solicitud de permiso
|--------------------------------------------------------------------------
|
*/
	Route::get('/solicitud-permiso', 'HomeController@SolicitudPermiso');
	/*
	|--------------------------------------------------------------------------
	| Send solicitud permiso
	|--------------------------------------------------------------------------
	|
	*/
	Route::post('/solicitud-permiso-send', 'HomeController@StoreSolicitudPermimso');
	Route::get('/solicitud-permiso-send', 'HomeController@StoreSolicitudPermimso');

/*
|--------------------------------------------------------------------------
| Permiso Emergencia
|--------------------------------------------------------------------------
|
*/
	Route::get('/emergencia', 'HomeController@SolicitudPermisoEmergencia');
	/*
	|--------------------------------------------------------------------------
	| Send Permiso Emergencia
	|--------------------------------------------------------------------------
	|
	*/
	Route::post('/emergencia-send', 'HomeController@StoreSolicitudEmergencia');
	Route::get('/emergencia-send', 'HomeController@StoreSolicitudEmergencia');

/*
|--------------------------------------------------------------------------
| Buzon Sugerencias
|--------------------------------------------------------------------------
|
*/
	Route::get('/buzon-sugerencias', 'HomeController@BuzonSugerencias');
	/*
	|--------------------------------------------------------------------------
	| Send Buzon Sugerencias
	|--------------------------------------------------------------------------
	|
	*/
	Route::post('/buzon-sugerencias-send', 'HomeController@StoreBuzonSugerencia');
	Route::get('/buzon-sugerencias-send', 'HomeController@StoreBuzonSugerencia');

/*
|--------------------------------------------------------------------------
| Detalles de solicitudes enviadas
|--------------------------------------------------------------------------
|
*/
	Route::get('/solicitudes-proceso', 'HomeController@DetallsSolicitudesInProceso');
	/*
	|--------------------------------------------------------------------------
	| Send solicitud permiso
	|--------------------------------------------------------------------------
	|
	*/
	Route::post('/solicitud-permiso-send', 'HomeController@StoreSolicitudPermimso');
	Route::get('/solicitud-permiso-send', 'HomeController@StoreSolicitudPermimso');

	/*
    |--------------------------------------------------------------------------
    | COmentarios sugerencias
    |--------------------------------------------------------------------------
    |
    */
	Route::get('/sugerencias_submit', 'HomeController@StoreComentsSugerencias');
	Route::post('/sugerencias_submit', 'HomeController@StoreComentsSugerencias');

/*
|--------------------------------------------------------------------------
| Evaluacion a personal
|--------------------------------------------------------------------------
|
*/
	Route::get('/evaluacion-a-personal', 'HomeController@EvaluationToPersonal');

/*
|--------------------------------------------------------------------------
| Evaluacion a personal detall 
|--------------------------------------------------------------------------
|
*/
	Route::get('/evaluacion-a-personal/{idEncargado}/{id}', 'HomeController@EvaluationToPersonalDetall');
	/*
	|--------------------------------------------------------------------------
	| Enviando evaluacion
	|--------------------------------------------------------------------------
	|
	*/
	Route::get('/send_evaluacion', 'HomeController@StoreEvaluation');
	Route::post('/send_evaluacion', 'HomeController@StoreEvaluation');

/*
|--------------------------------------------------------------------------
| Fin Evaluacion
|--------------------------------------------------------------------------
|
*/
	Route::get('/finish-evaluation', 'HomeController@FinishEvaluation');


/*
|--------------------------------------------------------------------------
| Evaluacion a personal evaluados 
|--------------------------------------------------------------------------
|
*/
	Route::get('/evaluacion-a-personal-evaluados', 'HomeController@EvaluationToPersonalEvaluados');



/*
/*
|--------------------------------------------------------------------------
| Public post 
|--------------------------------------------------------------------------
|
*/
	Route::get('/addPosts', 'PostController@StorePost');
	Route::post('/addPosts', 'PostController@StorePost');
/*

/*
|--------------------------------------------------------------------------
| Coment post 
|--------------------------------------------------------------------------
|
*/
	Route::get('/CcomentsUsers', 'LikeAndComentController@ComentariosPosts');
	Route::post('/CcomentsUsers', 'LikeAndComentController@ComentariosPosts');

/*
/*
|--------------------------------------------------------------------------
| Get COments post 
|--------------------------------------------------------------------------
|
*/
	Route::get('/getComents', 'LikeAndComentController@getComentsPost');
	Route::post('/getComents', 'LikeAndComentController@getComentsPost');
/*

/*
|--------------------------------------------------------------------------
| Get AJAX USERS
|--------------------------------------------------------------------------
|
*/
	Route::get('/getAllUse', 'HomeController@loadUserHome');
	Route::post('/getAllUse', 'HomeController@loadUserHome');
/*


/*
|--------------------------------------------------------------------------
| Route Ajax Like
|--------------------------------------------------------------------------
|
*/
	Route::post('/likeUserd', 'LikeAndComentController@StoreLikeUserPost');


/*
|--------------------------------------------------------------------------
| Route Ajax Post Personalizado
|--------------------------------------------------------------------------
|
*/
	Route::post('/postPersonalidadoUser', 'LikeAndComentController@PostPersonalizadoUser');

/*
|--------------------------------------------------------------------------
| Route Create Evento vista Usuario
|--------------------------------------------------------------------------
|
*/
	Route::post('/postCreateEvento', 'EventosController@StorEvent');

/*
|--------------------------------------------------------------------------
| Route Marcar entrada y salida
|--------------------------------------------------------------------------
|
*/
	Route::post('/marcarEntrada', 'HomeController@StoreEntrada');
	Route::post('/marcarSalida', 'HomeController@StoreSalida');


	Route::get('/preview-conte/data/viewDme/{idusers}/{idpost}', 'HomeController@previewContPost');
// previuw-detall

/*
|--------------------------------------------------------------------------
| Route Notificacion vista
|--------------------------------------------------------------------------
|
*/
	Route::get('/notifiViewHi', 'HomeController@notifyView');
	Route::post('/notifiViewHi', 'HomeController@notifyView');

/*
|--------------------------------------------------------------------------
| Change Color Portal User
|--------------------------------------------------------------------------
|
*/
	Route::get('/changeColorUser', 'HomeController@ChangeColorBGUser');
	Route::post('/changeColorUser', 'HomeController@ChangeColorBGUser');
	

/*
|--------------------------------------------------------------------------
| ADMMINISTRADOR GENERAL
|--------------------------------------------------------------------------
| Si el usuario no es Admin no puede accesder a las siguiente rutas
| 
*/


	Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
	{
	    Route::get('/produ', function()
	    {
	        return view('welcome');
	    });

	    Route::get('/admin/home', 'Admin\AdminController@Home');
		    /*
		    |--------------------------------------------------------------------------
		    | Route admin create recordatorio
		    |--------------------------------------------------------------------------
		    |
		    */
			Route::post('/admin/postCreateRecordatorio', 'Admin\AdminController@StorRecordatorio');\

			/*
		    |--------------------------------------------------------------------------
		    | Route admin eliminar recordatorio
		    |--------------------------------------------------------------------------
		    |
		    */
			Route::post('/admin/removeRecordatorio', 'Admin\AdminController@DeleteRecordatorio');
			

	    Route::get('/admin/board', 'Admin\AdminController@Board');
	    Route::get('/admin/chat', 'Admin\AdminController@ChatAdmin');
	    Route::get('/admin/sugerencias', 'Admin\AdminController@Sugerencias');
	    	/*
	        |--------------------------------------------------------------------------
	        | COmentarios sugerencias
	        |--------------------------------------------------------------------------
	        |
	        */
	    	Route::get('/admin/sugerencias_submit', 'Admin\AdminController@StoreComentsSugerencias');
	    	Route::post('/admin/sugerencias_submit', 'Admin\AdminController@StoreComentsSugerencias');
    		/*
    	    |--------------------------------------------------------------------------
    	    | View Sugerencia Admin
    	    |--------------------------------------------------------------------------
    	    |
    	    */
    	    Route::get('/admin/sugerencias_View', 'Admin\AdminController@StoreviewSugerenciaEmergenciaAndMore');
    	    Route::post('/admin/sugerencias_View', 'Admin\AdminController@StoreviewSugerenciaEmergenciaAndMore');
	    	/*
	        |--------------------------------------------------------------------------
	        | Croup cheebox sugerencias
	        |--------------------------------------------------------------------------
	        |
	        */
	        Route::get('/admin/sugerencias_group_view', 'Admin\AdminController@storeCheeboxGroup');
	        Route::post('/admin/sugerencias_group_view', 'Admin\AdminController@storeCheeboxGroup');
	        Route::get('/admin/sugerencias_group_delete', 'Admin\AdminController@storeCheeboxGroupDelete');
	        Route::post('/admin/sugerencias_group_delete', 'Admin\AdminController@storeCheeboxGroupDelete');

	    	Route::get('/admin/emergencias', 'Admin\AdminController@Emergencias');
	    		/*
	    	    |--------------------------------------------------------------------------
	    	    | View Fecha Emergwencia
	    	    |--------------------------------------------------------------------------
	    	    |
	    	    */
	    	Route::get('/admin/emergencias/data/fech/emergenci/{fechaemergenci}', 'Admin\AdminController@EmergenciasFechas');
	    	Route::get('/admin/emergencias/data/fech/emergenci/cont/{fechaemergenci}', 'Admin\AdminController@emergenciasTotalsFechas');
	    	Route::post('/admin/emergencias/data/fech/emergenci/cont/{fechaemergenci}', 'Admin\AdminController@emergenciasTotalsFechas');
	   		
	   		Route::get('/admin/solicitud-permisos', 'Admin\AdminController@SolicitudPermisos');
	   			/*
	   		    |--------------------------------------------------------------------------
	   		    | View Fecha Solicitud permiso
	   		    |--------------------------------------------------------------------------
	   		    |
	   		    */
	   		Route::get('/admin/solicitud-permisos/data/fech/permiso/{fechapermiso}', 'Admin\AdminController@SolicitudPermisosFecha');
	   		Route::get('/admin/solicitud-permisos/data/fech/permiso/coun/{fechapermiso}', 'Admin\AdminController@PermisosTotalsFechas');
	   		Route::post('/admin/solicitud-permisos/data/fech/permiso/coun/{fechapermiso}', 'Admin\AdminController@PermisosTotalsFechas');
	    	/*
	        |--------------------------------------------------------------------------
	        | Solicitud aceptada y denegada
	        |--------------------------------------------------------------------------
	        |
	        */
	        Route::get('/admin/solicitud_actiond', 'Admin\AdminController@storeActionSolicitud');
	        Route::post('/admin/solicitud_actiond', 'Admin\AdminController@storeActionSolicitud');
	        Route::get('/admin/solicitud_actiondenegada', 'Admin\AdminController@storeActionSolicitudDenegada');
	        Route::post('/admin/solicitud_actiondenegada', 'Admin\AdminController@storeActionSolicitudDenegada');
        	/*
	            |--------------------------------------------------------------------------
	            | Busqueda se solicitudes del usuario
	            |--------------------------------------------------------------------------
	            |
	            */
		        Route::get('/admin/search_solicitudes', 'Admin\AdminController@SearchSolicitudPermiso');
		        Route::post('/admin/search_solicitudes', 'Admin\AdminController@SearchSolicitudPermiso');
	        	/*
	            |--------------------------------------------------------------------------
	            | Busqueda se solicitudes de emergencias del usuario
	            |--------------------------------------------------------------------------
	            |
	            */
		        Route::get('/admin/search_solicitudes_emergencias', 'Admin\AdminController@SearchEmergencias');
		        Route::post('/admin/search_solicitudes_emergencias', 'Admin\AdminController@SearchEmergencias');
	        	/*
	            |--------------------------------------------------------------------------
	            | Busqueda se solicitudes de sugerencias del usuario
	            |--------------------------------------------------------------------------
	            |
	            */
		        Route::get('/admin/search_solicitudes_suegerencias', 'Admin\AdminController@SearchSugerencias');
		        Route::post('/admin/search_solicitudes_suegerencias', 'Admin\AdminController@SearchSugerencias');

        	/*
            |--------------------------------------------------------------------------
            | Ruta calendario
            |--------------------------------------------------------------------------
            |
            */
	    Route::get('/admin/calendario', 'Admin\AdminController@Calendar');

	    	/*
	        |--------------------------------------------------------------------------
	        | Ruta documentos
	        |--------------------------------------------------------------------------
	        |
	        */
	    Route::get('/admin/documentos', 'Admin\AdminController@Documentos');
	    Route::get('/admin/documentos/{idurl}', 'Admin\AdminController@DocumentosRutas1');
	    Route::get('/admin/documentos/{idurl}/{idurl2}', 'Admin\AdminController@DocumentosRutas2');
	    Route::get('/admin/documentos/{idurl}/{idurl2}/{idurl3}', 'Admin\AdminController@DocumentosRutas3');
	    Route::get('/admin/documentos/{idurl}/{idurl2}/{idurl3}/{idurl4}', 'Admin\AdminController@DocumentosRutas4');
	    Route::get('/admin/documentos/{idurl}/{idurl2}/{idurl3}/{idurl4}/{idurl5}', 'Admin\AdminController@DocumentosRutas5');
	    Route::get('/admin/documentos/{idurl}/{idurl2}/{idurl3}/{idurl4}/{idurl5}/{idurl6}', 'Admin\AdminController@DocumentosRutas6');
            	/*
                |--------------------------------------------------------------------------
                | Ajax change documents
                |--------------------------------------------------------------------------
                |
                */
    	        Route::get('/admin/upload_change_direct', 'Admin\AdminController@UploadChangeDirect');
    	        Route::post('/admin/upload_change_direct', 'Admin\AdminController@UploadChangeDirect');
    	        /*
                |--------------------------------------------------------------------------
                | change documents directory
                |--------------------------------------------------------------------------
                |
                */
    	        Route::get('/admin/documentMove', 'Admin\AdminController@UploadChangeDirectSnAJax');
    	        Route::post('/admin/documentMove', 'Admin\AdminController@UploadChangeDirectSnAJax');
    	        /*
                |--------------------------------------------------------------------------
                | remove documents directory
                |--------------------------------------------------------------------------
                |
                */
    	        Route::get('/admin/documentRemove', 'Admin\AdminController@RemoveDirectSnAJax');
    	        Route::post('/admin/documentRemove', 'Admin\AdminController@RemoveDirectSnAJax');
    	        /*
                |--------------------------------------------------------------------------
                | Dowload documents 
                |--------------------------------------------------------------------------
                |
                */
    	        Route::get('/admin/documentDowload', 'Admin\AdminController@documentsDowload');
    	        Route::post('/admin/documentDowload', 'Admin\AdminController@documentsDowload');
    	        /*
                |--------------------------------------------------------------------------
                | Upload documents 
                |--------------------------------------------------------------------------
                |
                */
    	        Route::get('/admin/documentUpload', 'Admin\AdminController@uploadNewArchivo');
    	        Route::post('/admin/documentUpload', 'Admin\AdminController@uploadNewArchivo');
    	        /*
                |--------------------------------------------------------------------------
                | Create new Directorie documents 
                |--------------------------------------------------------------------------
                |
                */
    	        Route::get('/admin/documentCreateDirectorie', 'Admin\AdminController@createDirectory');
    	        Route::post('/admin/documentCreateDirectorie', 'Admin\AdminController@createDirectory');

	    Route::get('/admin/ranking', 'Admin\AdminController@Ranking');
			    /*
			    |--------------------------------------------------------------------------
			    | Add Adp
			    |--------------------------------------------------------------------------
			    |
			    */
			    	Route::get('/admin/ranking_adp', 'Admin\AdminController@addAdpsInRanking');
			    	Route::post('/admin/ranking_adp', 'Admin\AdminController@addAdpsInRanking');

	    Route::get('/admin/history', 'Admin\AdminController@HistoryUsers');
			    /*
			    |--------------------------------------------------------------------------
			    | Agregar adp
			    |--------------------------------------------------------------------------
			    |
			    */
			    Route::get('/admin/adps', 'Admin\AdminController@addAdps');
			    Route::post('/admin/adps', 'Admin\AdminController@addAdps');

	    Route::get('/admin/history/{id}', 'Admin\AdminController@HistoryEntradaSalidaUsers');
	    Route::get('/admin/historys/data/allUsers', 'Admin\AdminController@HistoryEntradaSalidaUsersAlls');
			    /*
			    |--------------------------------------------------------------------------
			    | Historial de llegadas Fechas
			    |--------------------------------------------------------------------------
			    |
			    */
			    Route::get('/admin/HistoryLlegadas/histo/Asist/{fecha}', 'Admin\AdminController@HistoryUsersFechas');
			    Route::post('/admin/HistoryLlegadas/histo/Asist/{fecha}', 'Admin\AdminController@HistoryUsersFechas');
			    Route::get('/admin/HistoryLlegadas/histo/Asist/Date/{fecha}', 'Admin\AdminController@HistoryAyer');
			    Route::post('/admin/HistoryLlegadas/histo/Asist/Date/{fecha}', 'Admin\AdminController@HistoryAyer');

	    /*
	    |--------------------------------------------------------------------------
	    | Agregar usuario
	    |--------------------------------------------------------------------------
	    |
	    */
	   
	   		 Route::get('/admin/addUsers', 'Admin\AdminController@AddUsers');
	   		 Route::get('/admin/addUsersStore', 'Admin\AddUserController@StoreAddUser');
	   		 Route::post('/admin/addUsersStore', 'Admin\AddUserController@StoreAddUser');


   		 /*
   		 |--------------------------------------------------------------------------
   		 | All usuario
   		 |--------------------------------------------------------------------------
   		 |
   		 */
	    Route::get('/admin/usuarios', 'Admin\AdminController@UsersAll');
	   		 /*
	   		 |--------------------------------------------------------------------------
	   		 | Desactivar Usuario
	   		 |--------------------------------------------------------------------------
	   		 |
	   		 */
		    Route::get('/admin/Desactive_Users', 'Admin\AdminController@DescativeUser');
		    Route::post('/admin/Desactive_Users', 'Admin\AdminController@DescativeUser');
		    /*
            |--------------------------------------------------------------------------
            | Busqueda de usuario
            |--------------------------------------------------------------------------
            |
            */
	        Route::get('/admin/search_users', 'Admin\AdminController@SearchUsuarios');
	        Route::post('/admin/search_users', 'Admin\AdminController@SearchUsuarios');

	    /*
	    |--------------------------------------------------------------------------
	    | Editar usuario
	    |--------------------------------------------------------------------------
	    |
	    */
   		 Route::get('/admin/usuarios/edit/{id}', 'Admin\AdminController@EditUser');
		     /*
		     |--------------------------------------------------------------------------
		     | Upload Foto Edit
		     |--------------------------------------------------------------------------
		     |
		     */
		    
			 Route::get('/admin/usuarios/edit/{id}/uploadFotoProfile', 'Admin\AddUserController@StoreUploadFotoEdit');
			 Route::post('/admin/usuarios/edit/{id}/uploadFotoProfile', 'Admin\AddUserController@StoreUploadFotoEdit');

		     /*
		     |--------------------------------------------------------------------------
		     | Guardar edicion User
		     |--------------------------------------------------------------------------
		     |
		     */		    
			 Route::get('/admin/usuarios/edit/{id}/saveEdition', 'Admin\AddUserController@saveEditUser');
			 Route::post('/admin/usuarios/edit/{id}/saveEdition', 'Admin\AddUserController@saveEditUser');
		     

 	    /*
 	    |--------------------------------------------------------------------------
 	    | Editar Horario
 	    |--------------------------------------------------------------------------
 	    |
 	    */
    		 Route::get('/admin/usuarios/editHorario/{id}', 'Admin\AdminController@EditUserHorario');
		      /*
		      |--------------------------------------------------------------------------
		      | Guardar edicion User HORARIOS
		      |--------------------------------------------------------------------------
		      |
		      */		    
		 	 Route::get('/admin/usuarios/editHorario/{id}/saveEditionHorario', 'Admin\AddUserController@saveEditUserHorarios');
		 	 Route::post('/admin/usuarios/editHorario/{id}/saveEditionHorario', 'Admin\AddUserController@saveEditUserHorarios');	
		
		/*
		|--------------------------------------------------------------------------
		| Editando por grupos
		|--------------------------------------------------------------------------
		|
		*/		 
	    Route::get('/admin/usuarios/grupos/edit', 'Admin\AdminController@EditUserGrupos');
	    Route::post('/admin/usuarios/grupos/edit', 'Admin\AdminController@EditUserGrupos');
		    /*
		    |--------------------------------------------------------------------------
		    | Guardando edicion de grupos
		    |--------------------------------------------------------------------------
		    |
		    */
		    Route::get('/admin/usuarios/grupos/SaveEdit', 'Admin\AddUserController@saveEditUsersGroup');
		    Route::post('/admin/usuarios/grupos/SaveEdit', 'Admin\AddUserController@saveEditUsersGroup');

	    Route::get('/admin/evaluaciones-mensuales', 'Admin\AdminController@MonthlyEvaluations');
	    Route::get('/admin/evaluaciones-mensuales/{idEncargado}/{id}', 'Admin\AdminController@MonthlyEvaluationsDetall');

		    /*
		    |--------------------------------------------------------------------------
		    | Enviando evaluacion
		    |--------------------------------------------------------------------------
		    |
		    */
		    Route::get('/admin/send_evaluacion', 'Admin\AdminController@StoreEvaluation');
		    Route::post('/admin/send_evaluacion', 'Admin\AdminController@StoreEvaluation');

	    /*
	    |--------------------------------------------------------------------------
	    | Create Notificaciones de eventos
	    |--------------------------------------------------------------------------
	    |
	    */
	    Route::get('/admin/create_notify', 'Admin\AdminController@CreateNotificaciones');
	    Route::post('/admin/create_notify', 'Admin\AdminController@CreateNotificaciones');


	    Route::get('/demoRecive', 'Admin\AdminController@RankingWithAppAsesores');

	    /*
	    |--------------------------------------------------------------------------
	    | Route Notificacion fecha Anterior
	    |--------------------------------------------------------------------------
	    |
	    */
	    	Route::get('/admin/notifiViewAnterior', 'Admin\AdminController@ActivitiesRecientesPorFecha');
	    	Route::post('/admin/notifiViewAnterior', 'Admin\AdminController@ActivitiesRecientesPorFecha');

    	/*
    	|--------------------------------------------------------------------------
    	| Route Historial notificaciones
    	|--------------------------------------------------------------------------
    	|
    	*/
    		Route::get('/admin/HistoryNotify/{fecha}', 'Admin\AdminController@HistorialActividadesRecientes');
    		Route::post('/admin/HistoryNotify/{fecha}', 'Admin\AdminController@HistorialActividadesRecientes');
    		Route::get('/admin/HistoryNotify', 'Admin\AdminController@HistorialActividadesRecientesAll');
    		Route::post('/admin/HistoryNotify', 'Admin\AdminController@HistorialActividadesRecientesAll');

		/*
		|--------------------------------------------------------------------------
		| Route Previews de Post
		|--------------------------------------------------------------------------
		|
		*/

		Route::get('/admin/preview-conte/data/viewDme/{idusers}/{idpost}', 'Admin\AdminController@previewContPost');



	});
