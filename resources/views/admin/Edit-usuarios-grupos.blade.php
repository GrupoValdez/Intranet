@extends('layouts.Template-admin-edit-users')

@section('content')
<div class="container continerWithSite">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionAdminContain">
    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
      
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 sectionCenterContenido secCetTitleS">
      <h1>Editar usuario</h1>
      @include('admin.partials.fields-name-admin-login')      
      @include('admin.partials.fields-search-usuarios')

    </div>
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
      <ul class="nav navbar-nav navbar-right navulRIght">
          <!-- Authentication Links -->
          @if (Auth::guest())
            <li><a href="{{ url('/login') }}">Login</a></li>
            <li><a href="{{ url('/register') }}">Register</a></li>
          @else
            <li>
               <a href="{{ url('/logout') }}"
                 onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                 Salir
               </a>
               <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                   {{ csrf_field() }}
               </form>
             </li>
          @endif
      </ul>
    </div>
  </div>
</div>


{{-- SECTION BLOQUE NOTIFICACION Y MENSAJES --}}
<section class="container-fluid sectionAdminNotifiMensa">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">

    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 OtherUserEdit">
      
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 sectionCenterContenido sectionCenEdituser">
      @if(Session::has('Update_UsersGroup'))
        <p class="alert alert-success">{{Session::get('Update_UsersGroup')}}</p>
      @endif
      
      <form action="SaveEdit" method="post" accept-charset="utf-8" class="formEditUser formSaveEditGruop">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{-- BLOCK EDIT USER --}}
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 dataBloquesForEdit">
          <h3 class="editAs">Editar todos los usuarios</h3>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 dataImgAndranking datarankingGropu">
            <p class="gasper">{{ $cantidadUserEdit = count($idsUserGroup) }}</p>
            @foreach($UsersAlls as $users)
              @for($i = 0; $i<= $cantidadUserEdit-1; $i++)
                @if($users->id_usuario == $idsUserGroup[$i])
                  <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 imgProfiEdit">
                    {{-- <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/profile-user-circle.png" alt=""> --}}
                    <div class="label dataPrubeIm dataProfileEditGroup" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $users->foto }}')"></div>
                    <input type="hidden" name="id_user_group[]" value="{{ $users->id_usuario }}">
                    {{-- <div class="rectangle"></div> --}}
                  </div>
                @endif
              @endfor
            @endforeach
            
                        
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 DataformPersonales">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 formInputsDats">
              <label for="">Departamento al que pertenece</label>
              <select name="data_departamento_edit">
                 @foreach($dataAreas as $GetAreas)
                    <option value="{{ $GetAreas->area }}">{{ $GetAreas->area }}</option>       
                  @endforeach                    
              </select>          
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 formInputsDats">
              <label for="">Cargo</label>
              <input type="text" name="data_cargo_edit">            
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 formInputsDats">
              <label for="">Jefe Inmediato</label>
              <select name="data_jefe_edit" >
                @foreach($UsersAlls as $GetuserJefes)
                   <option value="{{ $GetuserJefes->id_usuario }}">{{ $GetuserJefes->nombre }} {{ $GetuserJefes->apellidos }}</option>     
                 @endforeach    
               </select>         
            </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 DataformPersonales dataInformationPersonal">
            <h3>Información personal</h3>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 formInputsDats">
              <label for="">Género</label>
              <select name="data_genero_edit" >
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>              
              </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 formInputsDats">
              <label for="">Estado civil</label>
              <input type="text" name="data_estado_civil_edit">            
            </div>

          </div>
        </div>

        {{-- END BLOCK EDIT USER --}}

        {{-- BLOCK CLOCK --}}
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 databLoquOclock">

          {{-- HORARIOS DIAS COMPLETOS --}}
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 databLoquOclockDetallDiasCompleto">
            <h3>Horario</h3>
            <h4>Días completos</h4>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueHorarioCompletos bloOONes">
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataEntrada">
                 <div class="form-group">
                     <h4>Entrada</h4>
                     <div class="clearfix">
                         <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                             <input type="text" class="form-control" value="">
                             <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                             </span>
                         </div>
                     </div>
                 </div>              
              </div>

               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataSalida">
                 <div class="form-group">
                     <h4>Salida</h4>
                     <div class="clearfix">
                         <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                             <input type="text" class="form-control" value="">
                             <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                             </span>
                         </div>
                     </div>
                 </div>
              </div> 

              <p class="mnsAlertVacio">Debes seleccionar hora de entrada y salida</p>

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 DaysOfSelect">
                <div class="form-group formSelectDays formseledDiasCOmple">
                    <h4>Repetir</h4>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  bloqueDayss">
                      <div class='DayForDay domin' data-time="" data-day="Domingo">
                        d
                      </div>
                      <div class='DayForDay lune' data-time="" data-day="Lunes">
                        l
                      </div>
                      <div class='DayForDay marte' data-time="" data-day="Martes">
                        m
                      </div>
                      <div class='DayForDay mierco' data-time="" data-day="Miercoles">
                        m
                      </div>
                      <div class='DayForDay jueve' data-time="" data-day="Jueves">
                        j
                      </div>
                      <div class='DayForDay vierne' data-time="" data-day="Viernes">
                        v
                      </div>
                      <div class='DayForDay saba' data-time="" data-day="Sabado">
                        s
                      </div>
                    </div>
                 </div>                    
               </div> 

            </div>     

            {{-- 2BLOQUE HORARIO COMPLETE --}}
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueHorarioCompletos block2">
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataEntrada">
                 <div class="form-group">
                     <h4>Entrada</h4>
                     <div class="clearfix">
                         <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                             <input type="text" class="form-control" value="">
                             <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                             </span>
                         </div>
                     </div>
                 </div>              
              </div>

               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataSalida">
                 <div class="form-group">
                     <h4>Salida</h4>
                     <div class="clearfix">
                         <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                             <input type="text" class="form-control" value="">
                             <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                             </span>
                         </div>
                     </div>
                 </div>
              </div> 

              <p class="mnsAlertVacio">Debes seleccionar hora de entrada y salida</p>

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 DaysOfSelect">
                <div class="form-group formSelectDays formseledDiasCOmple">
                    <h4>Repetir</h4>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  bloqueDayss">
                      <div class='DayForDay domin' data-time="" data-day="Domingo">
                        d
                      </div>
                      <div class='DayForDay lune' data-time="" data-day="Lunes">
                        l
                      </div>
                      <div class='DayForDay marte' data-time="" data-day="Martes">
                        m
                      </div>
                      <div class='DayForDay mierco' data-time="" data-day="Miercoles">
                        m
                      </div>
                      <div class='DayForDay jueve' data-time="" data-day="Jueves">
                        j
                      </div>
                      <div class='DayForDay vierne' data-time="" data-day="Viernes">
                        v
                      </div>
                      <div class='DayForDay saba' data-time="" data-day="Sabado">
                        s
                      </div>
                    </div>
                 </div>                    
               </div> 
            </div>

            {{-- 3BLOQUE HORARIO COMPLETE --}}
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueHorarioCompletos block3">
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataEntrada">
                 <div class="form-group">
                     <h4>Entrada</h4>
                     <div class="clearfix">
                         <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                             <input type="text" class="form-control" value="">
                             <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                             </span>
                         </div>
                     </div>
                 </div>              
              </div>

               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataSalida">
                 <div class="form-group">
                     <h4>Salida</h4>
                     <div class="clearfix">
                         <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                             <input type="text" class="form-control" value="">
                             <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                             </span>
                         </div>
                     </div>
                 </div>
              </div> 

              <p class="mnsAlertVacio">Debes seleccionar hora de entrada y salida</p>

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 DaysOfSelect">
                <div class="form-group formSelectDays formseledDiasCOmple">
                    <h4>Repetir</h4>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  bloqueDayss">
                      <div class='DayForDay domin' data-time="" data-day="Domingo">
                        d
                      </div>
                      <div class='DayForDay lune' data-time="" data-day="Lunes">
                        l
                      </div>
                      <div class='DayForDay marte' data-time="" data-day="Martes">
                        m
                      </div>
                      <div class='DayForDay mierco' data-time="" data-day="Miercoles">
                        m
                      </div>
                      <div class='DayForDay jueve' data-time="" data-day="Jueves">
                        j
                      </div>
                      <div class='DayForDay vierne' data-time="" data-day="Viernes">
                        v
                      </div>
                      <div class='DayForDay saba' data-time="" data-day="Sabado">
                        s
                      </div>
                    </div>
                 </div>                    
               </div> 

            </div>
            
            <a href="#!" class="newHorario">
              <p>Agregar nuevo Horario</p>
            </a>      
          </div>  
          {{-- END HORARIOS DIAS COMPLETOS --}}

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 databLoquOclockDetallMedioDia">
            <h4>Medio día</h4>

            {{-- PRIMER BLOQUE MEDIO DIA --}}
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueHorarioCompletos blockMedio1">
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataEntrada">
                 <div class="form-group">
                     <h4>Entrada</h4>
                     <div class="clearfix">
                         <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                             <input type="text" class="form-control" value="">
                             <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                             </span>
                         </div>
                     </div>
                 </div>              
              </div>

               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataSalida">
                 <div class="form-group">
                     <h4>Salida</h4>
                     <div class="clearfix">
                         <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                             <input type="text" class="form-control" value="">
                             <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                             </span>
                         </div>
                     </div>
                 </div>
              </div> 

              <p class="mnsAlertVacio">Debes seleccionar hora de entrada y salida</p>

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 DaysOfSelect">
                <div class="form-group formSelectDays formseledDiasCOmple">
                    <h4>Repetir</h4>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  bloqueDayss">
                      <div class='DayForDay domin' data-time="" data-day="Domingo">
                        d
                      </div>
                      <div class='DayForDay lune' data-time="" data-day="Lunes">
                        l
                      </div>
                      <div class='DayForDay marte' data-time="" data-day="Martes">
                        m
                      </div>
                      <div class='DayForDay mierco' data-time="" data-day="Miercoles">
                        m
                      </div>
                      <div class='DayForDay jueve' data-time="" data-day="Jueves">
                        j
                      </div>
                      <div class='DayForDay vierne' data-time="" data-day="Viernes">
                        v
                      </div>
                      <div class='DayForDay saba' data-time="" data-day="Sabado">
                        s
                      </div>
                    </div>
                 </div>                    
               </div> 

            </div>

            {{-- SEGUNDO BLOQUE MEDIO DIA --}}
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueHorarioCompletos blockMedio2">
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataEntrada">
                 <div class="form-group">
                     <h4>Entrada</h4>
                     <div class="clearfix">
                         <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                             <input type="text" class="form-control" value="">
                             <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                             </span>
                         </div>
                     </div>
                 </div>              
              </div>

               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataSalida">
                 <div class="form-group">
                     <h4>Salida</h4>
                     <div class="clearfix">
                         <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                             <input type="text" class="form-control" value="">
                             <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                             </span>
                         </div>
                     </div>
                 </div>
              </div> 

              <p class="mnsAlertVacio">Debes seleccionar hora de entrada y salida</p>

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 DaysOfSelect">
                <div class="form-group formSelectDays formseledDiasCOmple">
                    <h4>Repetir</h4>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  bloqueDayss">
                      <div class='DayForDay domin' data-time="" data-day="Domingo">
                        d
                      </div>
                      <div class='DayForDay lune' data-time="" data-day="Lunes">
                        l
                      </div>
                      <div class='DayForDay marte' data-time="" data-day="Martes">
                        m
                      </div>
                      <div class='DayForDay mierco' data-time="" data-day="Miercoles">
                        m
                      </div>
                      <div class='DayForDay jueve' data-time="" data-day="Jueves">
                        j
                      </div>
                      <div class='DayForDay vierne' data-time="" data-day="Viernes">
                        v
                      </div>
                      <div class='DayForDay saba' data-time="" data-day="Sabado">
                        s
                      </div>
                    </div>
                 </div>                    
               </div> 

            </div>

            {{-- TERCER BLOQUE MEDIO DIA --}}
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueHorarioCompletos blockMedio3">
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataEntrada">
                 <div class="form-group">
                     <h4>Entrada</h4>
                     <div class="clearfix">
                         <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                             <input type="text" class="form-control" value="">
                             <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                             </span>
                         </div>
                     </div>
                 </div>              
              </div>

               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 daataSalida">
                 <div class="form-group">
                     <h4>Salida</h4>
                     <div class="clearfix">
                         <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                             <input type="text" class="form-control" value="">
                             <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                             </span>
                         </div>
                     </div>
                 </div>
              </div> 

              <p class="mnsAlertVacio">Debes seleccionar hora de entrada y salida</p>

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 DaysOfSelect">
                <div class="form-group formSelectDays formseledDiasCOmple">
                    <h4>Repetir</h4>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  bloqueDayss">
                      <div class='DayForDay domin' data-time="" data-day="Domingo">
                        d
                      </div>
                      <div class='DayForDay lune' data-time="" data-day="Lunes">
                        l
                      </div>
                      <div class='DayForDay marte' data-time="" data-day="Martes">
                        m
                      </div>
                      <div class='DayForDay mierco' data-time="" data-day="Miercoles">
                        m
                      </div>
                      <div class='DayForDay jueve' data-time="" data-day="Jueves">
                        j
                      </div>
                      <div class='DayForDay vierne' data-time="" data-day="Viernes">
                        v
                      </div>
                      <div class='DayForDay saba' data-time="" data-day="Sabado">
                        s
                      </div>
                    </div>
                 </div>                    
               </div> 

            </div>


            <a href="#!" class="newHorarioMedio">
              <p>Agregar nuevo Horario</p>
            </a> 

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueAddHorarios">
              
            </div>
          </div>
        </div>

        {{-- END BLOCK CLOCK --}}
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 submitEditU">
          <input type="submit" value='Aceptar'>
        </div>
            
      </form>
    </div>
  </div>
</section>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog contPusblishDialogo" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="col-xs-12 col-sm-12 col-md-12 continPublish">
          <form action="home_submit" method="get" class="sectionPublichUser" accept-charset="utf-8">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <textarea name="" placeholder="Escribe un comentario"></textarea>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 bloquesActions">
              <div class="col-md-6 actionpuBlish">
                <div class="col-md-2 Adjuntar">
                  <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/adjuntarIco.png" alt="">
                </div>
                <div class="col-md-2 AdjuntarFoto">
                  <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/adjuntarFoto.png" alt="">
                </div>
                <div class="col-md-2 DestacarPuslish">
                  <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/destacarIco.png" alt="">
                </div>
                <div class="col-md-2 AlertPublish">
                  <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/alertIco.png" alt="">
                </div>
              </div>
              <div class="col-md-6 ButtinPublish">
                <input type="submit" value="Enviar"></input>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
  
@endsection
