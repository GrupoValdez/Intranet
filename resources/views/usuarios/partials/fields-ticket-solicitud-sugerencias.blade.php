<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 permission">
  <h3>Solicitudes de Sugerencias</h3>

  @foreach($SugerenciasData as $Sugerencias)
    @foreach($UsersAllsPersonalesData as $userss)
      @if($Sugerencias->id_usuario == $userss->id_usuario)
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 contectAllMenssages">
          <div class="col-xs-12 col-sm-11 col-md-11 col-lg-11 textAllsMensages">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fchaUisersMensage">
              <p>{{ $Sugerencias->created_at->format('l j F Y H:i:s') }}</p>
            </div>
            <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1 secFotoUser" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $userss->foto }}')">
            </div>
            <div class="col-xs-12 col-sm-7 col-md-11 col-lg-11 sectioForMEnsagen secdataTextMensage">            
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nameUisersMensage">
                @if($Sugerencias->solicitud_vista == 1)
                 <h3 class="vieCandidate">{{ $userss->nombre }} {{ $userss->apellidos }}
                @else
                  <h3>{{ $userss->nombre }} {{ $userss->apellidos }}
                @endif
                
                @if($Sugerencias->img_adjunta != '')
                  <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/adjuntarFoto.png" alt="" data-toggle="modal" data-target="#myModalswAdjunImg"></h3>

                  <div class="modal fade" id="myModalswAdjunImg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog dialoDataImgen" role="document">
                      <div class="modal-content">
                        <div class="modal-body">
                          <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/documents/{{ $Sugerencias->img_adjunta }}" alt="{{ $Sugerencias->img_adjunta }}">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

                @endif
                @if($Sugerencias->documentos_adjunto != '')
                  <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/adjuntarIco.png" alt=""></h3>
                @endif
                 
              </div>                  
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 typeUisersMensage">
                <p>{{ $Sugerencias->motivo_descripcion }}</p>
                
                
              </div>
            </div> 
          </div>
          <div class="dataClicDEsplace deplaceDatSolictudes col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="ui accordion">
              <div class="title">
                <i class="fa fa-angle-down " aria-hidden="true" data-idsolicitud="{{ $Sugerencias->id }}"></i>
              </div>
              <div class="content conFormularioReturnMenSage">
                
                @foreach($ComentariosSugerencias as $coments)
                  @if($coments->id_detalle_solicitud == $Sugerencias->id)
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
                  <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 Sendmensage">
                    <div class="panel-group" id="accordionq" role="tablist" aria-multiselectable="true">
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                          <h4 class="panel-title">
                            <a class="collapsed collapseDataPermisos" role="button" data-toggle="collapse" data-parent="#accordionq" href="#collapseTwoEmer" aria-expanded="false" aria-controls="collapseTwoEmer">
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
                    <input type="hidden" name="id_solicitudse" value="{{ $Sugerencias->id }}">
                </form>
              </div>
            </div>
          </div>
        </div>
      @endif
    @endforeach   
  @endforeach

</div>