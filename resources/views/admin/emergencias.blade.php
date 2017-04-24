@extends('layouts.Template-admin')

@section('content')
<div class="container continerWithSite">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionAdminContain">
    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
      
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 sectionCenterContenido secCetTitleS">
      <h1>{{ $CantidadEmergenciasNovistas }} Emergencias</h1>
      @include('admin.partials.fields-name-admin-login')      

      <form action="search_solicitudes_emergencias" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 formSearch" method="post" accept-charset="utf-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <i class="fa fa-search" aria-hidden="true"></i>
          <input type="text" name="user_search" placeholder="Buscar solicitud de emergencia por nombre de usuario">
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


{{-- containe Emergencias --}}
<section class="container-fluid sectionAdminNotifiMensa containSugerencias">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionSugerenciasData">
    @if(Session::has('Create_Comentario'))
      <p class="alert alert-success">{{Session::get('Create_Comentario')}}</p>
    @endif
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 menssagesBloques">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 allTextMensages captionEmergencias">
        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 chexAllsMensages dataSguerenciaDCheck">
          
          <form action="home_submit" method="get" accept-charset="utf-8" class="formCheallmensage">
            <input type="checkbox">                
          </form>
        </div>
        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 textAllsMensages dataSguerenciaD">
         <div class="col-xs-12 col-sm-4 col-md-6 col-lg-6 setionMensgaeAllSugere">
          <a href=""><span>{{ $CantidadEmergenciasNovistas }}</span> Emergencias</a>
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

      @foreach($EmergenciasData as $Emergencias)
        @foreach($UsersAlls as $userss)
          @if($Emergencias->id_usuario == $userss->id_usuario)
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 contectAllMenssages">
              <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1 checkMEnsagge">
                <form action="" method="post" accept-charset="utf-8" class="selectMensage">
                  <input type="checkbox" name="check_sugerencia" class="dataSelecTSu{{ $Emergencias->id }}" value="{{ $Emergencias->id }}">                 
                </form>
              </div>
              <div class="col-xs-12 col-sm-11 col-md-11 col-lg-11 textAllsMensages">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fchaUisersMensage">
                  <p>{{ $Emergencias->created_at->format('l j F Y H:i:s') }}</p>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1 secFotoUser" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $userss->foto }}')">
                </div>

                <div class="col-xs-12 col-sm-7 col-md-11 col-lg-11 sectioForMEnsagen secdataTextMensage">
                  
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nameUisersMensage">
                    @if($Emergencias->solicitud_vista == 1)
                     <h3 class="vieCandidate">{{ $userss->nombre }} {{ $userss->apellidos }}
                    @else
                      <h3>{{ $userss->nombre }} {{ $userss->apellidos }}
                    @endif
                    
                    @if($Emergencias->img_adjunta != '')
                      <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/adjuntarFoto.png" alt="" data-toggle="modal" data-target="#myModalswAdjunImg"></h3>

                      <div class="modal fade" id="myModalswAdjunImg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog dialoDataImgen" role="document">
                          <div class="modal-content">
                            <div class="modal-body">
                              <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/documents/{{ $Emergencias->img_adjunta }}" alt="{{ $Emergencias->img_adjunta }}">
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>

                    @endif
                    @if($Emergencias->documentos_adjunto != '')
                      <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/adjuntarIco.png" alt=""></h3>
                    @endif
                     
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 typeUisersMensage">
                    <p>{{ $Emergencias->motivo_descripcion }}</p>

                    <div class="dataClicDEsplace">
                      <div class="ui accordion">
                        <div class="title">
                          <i class="fa fa-angle-down " aria-hidden="true" data-idsolicitud="{{ $Emergencias->id }}"></i>
                        </div>
                        <div class="content conFormularioReturnMenSage">
                          <p>Responder</p>
                          @foreach($ComentariosEmergencias as $coments)
                            @if($coments->id_detalle_solicitud == $Emergencias->id)
                              @foreach($UsersAlls as $user)
                                @if($coments->id_usuario == $user->id_usuario)
                                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 captionCOmetsReceibe">
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
                          <form action="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/sugerencias_submit" class="formReturnMennsage" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
                            <input type="hidden" name="id_solicitudse" value="{{ $Emergencias->id }}">
                          </form>
                        </div>
                      </div>

                    </div>
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


<!-- Modal NOTIFICACIONES -->
@include('admin.partials.fields-modal-notificaciones')

<div class="alert alert-info dataClMoPosPEr" role="alert">¡Publicacion Agregada!</div>  
  
@endsection
