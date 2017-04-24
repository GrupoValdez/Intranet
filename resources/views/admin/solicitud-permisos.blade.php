@extends('layouts.Template-admin')

@section('content')
<div class="container continerWithSite">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionAdminContain">
    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
      
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 sectionCenterContenido secCetTitleS">
      <h1>{{ $CantidadPermisosNovistas }} Solicitudes</h1>
      @include('admin.partials.fields-name-admin-login')      

      <form action="search_solicitudes" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 formSearch" method="post" accept-charset="utf-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <i class="fa fa-search" aria-hidden="true"></i>
          <input type="text" name="user_search" placeholder="Buscar solicitud por nombre de usuario">
        </div>
      </form>
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


{{-- containe Sugerencias --}}
<section class="container-fluid sectionAdminNotifiMensa containSugerencias">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionSugerenciasData">
    @if(Session::has('Create_Comentario'))
      <p class="alert alert-success">{{Session::get('Create_Comentario')}}</p>
    @endif
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 menssagesBloques">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 allTextMensages captionSolicitudpermiso">
        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 chexAllsMensages dataSguerenciaDCheck">
          
          <form action="home_submit" method="get" accept-charset="utf-8" class="formCheallmensage">
            <input type="checkbox">                
          </form>
        </div>
        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 textAllsMensages dataSguerenciaD">
         <div class="col-xs-12 col-sm-4 col-md-6 col-lg-6 setionMensgaeAllSugere">
          <a href=""><span>{{ $CantidadPermisosNovistas }}</span> Solicitudes</a>
         </div>
         
          <div class="col-xs-12 col-sm-4 col-md-6 col-lg-6 dropsetionMensgae">
            <p><span>1</span>-5</p>
            <div class="dropdown dwropOptionMensgae">
              <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dLabel">
                <li>
                  <form action="sugerencias_group_delete" method="post" accept-charset="utf-8" class="formGrupoCheckData">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="submit" value="Eliminar">
                    </form>       
                </li>
                <li>
                  <form action="sugerencias_group_view" method="post" accept-charset="utf-8" class="formGrupoCheckData">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" value="Marca como leído">
                  </form>         
                </li>
              </ul>          
            </div>
          </div>
          
        </div>
      </div>
      <form action="admin/sugerencias_group" method="post" accept-charset="utf-8" enctype="multipart/form-data" class="formGrupoCheck">
        {{-- <input type="checkbox" name="check_sugerencia" class="dataSelecTSu{{ $Emergencias->id }}" value="{{ $Emergencias->id }}">                  --}}
      </form>


      @foreach($PermisosData as $Permisos)
        @foreach($UsersAlls as $userss)
          @if($Permisos->id_usuario == $userss->id_usuario)
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 contectAllMenssages">
              <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1 checkMEnsagge">
                <form action="" method="post" accept-charset="utf-8" class="selectMensage">
                  <input type="checkbox" name="check_sugerencia" class="dataSelecTSu{{ $Permisos->id }}" value="{{ $Permisos->id }}">                 
                </form>
              </div>
              <div class="col-xs-12 col-sm-11 col-md-11 col-lg-11 textAllsMensages">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fchaUisersMensage">
                  <p>{{ $Permisos->created_at->format('l j F Y H:i:s') }}</p>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1 secFotoUser" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $userss->foto }}')">
                </div>
                <div class="col-xs-12 col-sm-7 col-md-11 col-lg-11 sectioForMEnsagen secdataTextMensage">            
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nameUisersMensage">
                    @if($Permisos->solicitud_vista == 1)
                     <h3 class="vieCandidate">{{ $userss->nombre }} {{ $userss->apellidos }}
                    @else
                      <h3>{{ $userss->nombre }} {{ $userss->apellidos }}
                    @endif
                    
                    @if($Permisos->img_adjunta != '')
                      <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/adjuntarFoto.png" alt="" data-toggle="modal" data-target="#myModalswAdjunImg"></h3>

                      <div class="modal fade" id="myModalswAdjunImg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog dialoDataImgen" role="document">
                          <div class="modal-content">
                            <div class="modal-body">
                              <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/documents/{{ $Permisos->img_adjunta }}" alt="{{ $Permisos->img_adjunta }}">
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>

                    @endif
                    @if($Permisos->documentos_adjunto != '')
                      <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/adjuntarIco.png" alt=""></h3>
                    @endif
                     
                  </div>                  
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 typeUisersMensage">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 createMotive">
                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 motivePermiso">
                        <span> Motivo de permiso: </span>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 descriptMotivo">
                        <p>{{ $Permisos->motivo_descripcion }}</p>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 createMotive">
                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 motivePermiso">
                        <span> Fechas: </span>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 descriptMotivo">
                        <p>{{ $Permisos->fecha_permiso }} </p>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 createMotive">
                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 motivePermiso">
                        <span> Descuento en: </span>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 descriptMotivo">
                        @foreach($DescuentosSolicitudes as $descuento)
                          @if($descuento->id_detalles_solicitud == $Permisos->id)
                            @if($descuento->id_usuario == $userss->id_usuario)
                              @if($descuento->vacaciones == '1')
                                <p>Día de Vacación </p>
                              @elseif($descuento->dia_septimo == '1')
                                 <p>Día Septimo</p>
                              @elseif($descuento->sin_descuento == '1')
                                 <p>Sin descuento</p>
                              @endif                                 
                            @endif
                          @endif
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div> 
              </div>
              <div class="dataClicDEsplace deplaceDatSolictudes col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="ui accordion">
                  <div class="title">
                    <i class="fa fa-angle-down " aria-hidden="true" data-idsolicitud="{{ $Permisos->id }}"></i>
                  </div>
                  <div class="content conFormularioReturnMenSage">
                    
                    @foreach($ComentariosPermisos as $coments)
                      @if($coments->id_detalle_solicitud == $Permisos->id)
                        @foreach($UsersAlls as $user)
                          @if($coments->id_usuario == $user->id_usuario)
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 captionCOmetsReceibe captionComenSolicitud">
                              <div class="col-xs-12 col-sm-4 col-md-1 col-lg-1 captionCOmetsReceibeIMgUser">
                                <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1 secFotoUser" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $user->foto }}')">
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-8 col-md-11 col-lg-11 captionCOmetsReceibeDescriUserCOmen">
                                <h4>{{ $user->nombre }} {{ $user->apellidos }} 
                                @if($coments->documentos_adjuntos != '')
                                  <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/adjuntarIco.png" alt="" data-toggle="modal" data-target="#myModalswAdjunImgComen{{$coments->id}}"></h3>

                                  <div class="modal fade" id="myModalswAdjunImgComen{{$coments->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog dialoDataImgen" role="document">
                                      <div class="modal-content">
                                        <div class="modal-body">
                                          <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/documents/{{ $coments->documentos_adjuntos }}" alt="{{ $coments->documentos_adjuntos }}">
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                @endif
                                

                                </h4>
                                <p>{{ $coments->conversation }}</p>
                              </div>
                            </div>
                          @endif
                        @endforeach
                        
                      @endif
                    @endforeach
                    <p>Responder</p>
                    <div href="#!" class="clActiveMOdalS" data-toggle="modal" data-target="#myModalSolicitudRespuesta" style="display:none;"></div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 formsActions">

                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 trueSolicituc truwsolos @if($Permisos->solicitud_aceptada != null or $Permisos->solicitud_denegada != null) disabledbutton @endif">
                       
                        <a href="#!" data-idsolicitudacep="{{ $Permisos->id }}" data-idusersoli="{{ $userss->id_usuario }}">
                          @foreach($DescuentosSolicitudes as $descuento)
                            @if($descuento->id_detalles_solicitud == $Permisos->id)
                              @if($descuento->id_usuario == $userss->id_usuario)
                                @if($descuento->vacaciones == '1')
                                  <p data-tydescuento="1" class="gasper">Día de Vacación </p>
                                @elseif($descuento->dia_septimo == '1')
                                   <p data-tydescuento="2" class="gasper">Día Septimo</p>
                                @endif
                             @endif
                           @endif
                          @endforeach
                          Aceptar
                        </a>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 DenegeSolicituc densons @if($Permisos->solicitud_aceptada != null or $Permisos->solicitud_denegada != null) disabledbutton @endif">
                        <a href="#!" data-idsolicitudde="{{ $Permisos->id }}">
                          <p data-denegado="3" class="gasper">Día Septimo</p>
                          Denegar
                        </a>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 Sendmensage">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                          <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                              <h4 class="panel-title">
                                <a class="collapsed collapseDataPermisos" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                  Enviar mensaje
                                </a>
                              </h4>
                            </div>                      
                          </div>
                        </div>                  
                      </div>
                    </div>
                    <form action="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/sugerencias_submit" class="formReturnMennsage conteFormSolicitru" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 textAreaReturn">
                            <textarea name="descrip_comen_suge"></textarea>
                          </div>
                          <div class="contenMoreDocuments">
                            <input type="file" class="fileInputAdmin" name="fileinputdocuemnt" />
                          </div>

                          <div class="contenMoreImages">
                            <input type="file" class="fileInputAdminImage" name="fileinputimage" />
                          </div>

                          <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 submitSendSugerencia">
                            <input type="submit" value="Enviar">
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloqueImageretu">
                            <img class="img-responsive imImga" onclick="chooseFileImageSuAd();" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/adjuntarFoto.png" alt="">
                            <img class="img-responsive img1Do" onclick="chooseFileDocuSuAd()" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/adjuntarIco.png" alt="">
                          </div>
                        </div>
                        <input type="hidden" name="id_user_sugerencia" value="{{  Auth::user()->id  }}">
                        <input type="hidden" name="id_solicitudse" value="{{ $Permisos->id }}">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          @endif
        @endforeach   
      @endforeach
      
  
    </div>
  </div>

  <div class="col-md-12 datPublich publishChatAdmin publishSugerencias">
    <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/addpubliImgae.png" alt="" data-toggle="modal" data-target="#myModal">
    <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/AnuncioPublicAdmin.png" alt=""  data-toggle="modal" data-target="#myModalNotifications">
  </div>
</section>

<!-- Modal -->
@include('usuarios.partials.field-public-post')

<div class="alert alert-info dataClMoPosPEr" role="alert">¡Publicacion Agregada!</div>  

<!-- Modal -->
<div class="modal fade" id="myModalSolicitudRespuesta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog contAcotionModlas" role="document">
    <div class="modal-content">
      <div class="modal-body captionBodySolicRespuesa">
        <div class="col-xs-12 col-sm-12 col-md-12 contRevibeSOlic">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="captionEvulveImg" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/27028.jpg')">              
            </div>
            <h5 class="aceptSol">Has aceptado la solicitud de</h5>
            <h5 class="DeneSoli">Has denegado la solicitud de</h5>
            <h4 class="nameSoliUser">Lisseth Rivas</h4>
            <h6 class="DescripSoliUser">Se descontará el día septimo en la próxima planilla</h6>
            <h6 class="descuenDia">Se descontará un día de las vacaciones</h6>
            <div class="captionDiasvaciones col-md-12">
              <div class="col-md-12 capsubDays">
                <p>14</p>
              </div>
            </div>
            <p class="userDayFaltante">Lisseth tiene <span>14 días</span>  de vacaciones</p>
            <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
          </div>          
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal NOTIFICACIONES -->
@include('admin.partials.fields-modal-notificaciones')
  
@endsection
