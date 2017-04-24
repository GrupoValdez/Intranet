<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 permission">
  <h3>Solicitudes de Sugerencias</h3>

  @foreach($PermisosData as $Permisos)
    @foreach($UsersAllsPersonalesData as $userss)
      @if($Permisos->id_usuario == $userss->id_usuario)
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 contectAllMenssages">
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
                    @foreach($UsersAllsPersonalesData as $user)
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
                 @if($Permisos->solicitud_aceptada == 1)
                  @foreach($DescuentosSolicitudes as $Type)
                    @if($Permisos->id == $Type->id_detalles_solicitud)
                      @if($Type->vacaciones == 1)
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 soliAceptadaD">
                          {{-- SOLICTUD ACEPTADA --}}
                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 solicitudAceptada">
                            <h1>¡Tu solicitud fue aceptada!</h1>
                            <h4>Se ha descontado un día de sus vacaciones anuales</h4>
                            {{-- Dias disponibles --}}
                            @include('usuarios.partials.fields-day-vacaciones-users')
                           </div>
                        </div>
                      @else
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 soliAceptadaD">
                          {{-- SOLICTUD ACEPTADA --}}
                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 solicitudAceptada">
                            <h1>¡Tu solicitud fue aceptada!</h1>
                            <h4>Se descontará el día septimo en la próxima planilla</h4>
                           </div>
                        </div>
                      @endif
                    @endif
                  @endforeach
                   
                 @elseif($Permisos->solicitud_denegada == 1)
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 soliDetemnegadae">
                     <p>Su Solicitud ha sido denegada</p>
                   </div>
                 @else
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 soliAceptadaD">
                     <p>Su Solicitud esta en proceso</p>
                   </div>
                 @endif
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
                <form action="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/sugerencias_submit" class="formReturnMennsage conteFormSolicitru" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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