<div class="col-xs-12 col-sm-6 col-md-7 col-lg-7 captionPosteos">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
      @foreach($DataArrayPostImpar as $dataArrPostImpar => $PostImpar)
        @foreach($PostPersonalizados as $verfiPost)
          @if($PostImpar['id'] == $verfiPost->id_posts && $verfiPost->id_usuario == Auth::user()->id )
            @if($PostImpar['id_tipo_publicacion'] == 1 && $PostImpar['imagen'] != '')
              @foreach($JoinTableUserPosts as $dataUSe)
                @if($PostImpar['id_usuario'] == $dataUSe->id_usuario)
                <div class="col-md-12">
                    <div class="ui feed uifeedAvatar">
                      <div class="event">
                        <div class="label dataPrubeIm" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataUSe->foto }}')">
                        </div>
                        <div class="content">
                          <div class="summary">
                            <a class="user colorGrisMediumSuave fontMiriamProSemiBold">
                              {{ $dataUSe->name }}
                            </a>
                            <div class="date fontMiriamProRegular colorGrisMediumSuave">
                              <p class="gasper">{{ $carbon = new \Carbon\Carbon() }}</p>
                              <p class="gasper">{{ $fechaActual = $carbon->now()->format('Y-m-d') }}</p>
                              <p class="gasper">{{ $horaActual = $carbon->now()->format('H:i:s') }}</p>
                              <p class="gasper">{{ $date = new \Carbon\Carbon($PostImpar['created_at']) }}</p>
                              <p class="gasper">{{ $dayPost = $date->format('Y-m-d') }}</p>
                              <p class="gasper">{{ $HoraPost = $date->format('H:i:s') }}</p>
                              @if($fechaActual == $dayPost)
                                 {{ date('H:i',strtotime($horaActual) - strtotime($HoraPost)) }}
                               @else
                                 {{ $dayPost }}
                               
                              @endif                                 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <p class="textCOment fontMiriamProRegular colorGrisMediumSuave">{{ $PostImpar['descripcion'] }}</p>
                    @foreach($PostImpar['imagen'] as $imagess)                     
                      <img class="img-responsive clImgView" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/documents/{{ $imagess }}" alt="{{ $imagess }}"  data-toggle="modal" data-target="#myModalswPost">
                        
                        <!-- Modal -->
                        <div class="modal fade" id="myModalswPost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog dialoDataImgen" role="document">
                            <div class="modal-content">
                              <div class="modal-body">
                                <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/documents/{{ $imagess }}" alt="{{ $imagess }}">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    @endforeach
                    <div class="ui feed uifeedActions">
                      <div class="event">
                        <div class="label">
                          <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/etiqueta-ico.png">
                        </div>
                        <div class="content contLike">
                          <p class="gasper"> {{$banderaLikes = 0}}</p>
                          <div class="summary">
                            <p class="gasper"> {{$banderaLikes = 0}}</p>
                            @foreach($Likes as $keyLikes => $likes)
                              @if( $PostImpar['id'] == $likes['id_publicacion'])
                              <p class="gasper"> {{ $banderaLikes = $banderaLikes+1}}</p>
                                <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                  @if(in_array(Auth::user()->id, $likes['id_usuarios_likes']))
                                    Atí y a {{ $likes['total_likes']-1 }} les gusta
                                    <input type="hidden" class="dislike" name="dislike_action_id" value="{{ Auth::user()->id }}">
                                  @else
                                    {{ $likes['total_likes']}} Me gusta
                                    <input type="hidden" class="dislike" name="dislike_action_id" value="">
                                  @endif    
                                  <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                  <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostImpar['id'] }}">
                                  <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostImpar['id_usuario'] }}">
                                </a>
                              @endif
                            @endforeach
                            @if($banderaLikes == 0)
                              <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                0 Me gusta
                                <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostImpar['id'] }}">
                                <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostImpar['id_usuario'] }}">
                              </a>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 captionlokComen">
                      @foreach($Coments as $datComents)
                        @if($PostImpar['id'] == $datComents->id_publicacion)
                          <div class="ui feed uifeedComnetUser">
                            <div class="event">
                              <div class="label dataPrubeIm" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $datComents->foto }}')">
                              </div>
                              <div class="content">
                                <div class="summary">
                                  <a class="user colorGrisMediumSuave fontMiriamProSemiBold">
                                    {{ $datComents->name }}
                                  </a>
                                  <div class="date fontMiriamProRegular colorGrisMediumSuave comentUser">
                                    {{ $datComents->comentarios }}
                                  </div>                           
                                </div>
                              </div>
                            </div>
                          </div>
                        @endif
                      @endforeach
                    </div>                      
                    <form class="ui form formComentUser">
                      <div class="field">
                        <textarea name="comentario_post" required></textarea>
                        <input type="hidden" class="iduserComent" name="coment_action_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" class="idDataPost" name="data_id_post" value="{{ $PostImpar['id'] }}">
                      </div>
                      <a href="" class="dataComenyt"><p>Comentar</p></a>
                    </form>
                </div>
                @endif
              @endforeach
              
              

              @elseif($PostImpar['id_tipo_publicacion'] == 1 && $PostImpar['documentos'] != '')
                @foreach($JoinTableUserPosts as $dataUSe)
                  @if($PostImpar['id_usuario'] == $dataUSe->id_usuario)
                  <div class="col-md-12">
                      <div class="ui feed uifeedAvatar">
                        <div class="event">
                          <div class="label dataPrubeIm" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataUSe->foto }}')">
                          </div>
                          <div class="content">
                            <div class="summary">
                              <a class="user colorGrisMediumSuave fontMiriamProSemiBold">
                                {{ $dataUSe->name }}
                              </a>
                              <div class="date fontMiriamProRegular colorGrisMediumSuave">
                                <p class="gasper">{{ $carbon = new \Carbon\Carbon() }}</p>
                                <p class="gasper">{{ $fechaActual = $carbon->now()->format('Y-m-d') }}</p>
                                <p class="gasper">{{ $horaActual = $carbon->now()->format('H:i:s') }}</p>
                                <p class="gasper">{{ $date = new \Carbon\Carbon($PostImpar['created_at']) }}</p>
                                <p class="gasper">{{ $dayPost = $date->format('Y-m-d') }}</p>
                                <p class="gasper">{{ $HoraPost = $date->format('H:i:s') }}</p>
                                @if($fechaActual == $dayPost)
                                   {{ date('H:i',strtotime($horaActual) - strtotime($HoraPost)) }}
                                 @else
                                   {{ $dayPost }}
                                 
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <p class="textCOment fontMiriamProRegular colorGrisMediumSuave">{{ $PostImpar['descripcion'] }}</p>
                      @foreach($PostImpar['documentos'] as $docume)
                        <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/documents/{{ $docume }}" class="dataDpcuCl" download="{{ $docume }}">
                          <img class="img-responsive claa__cupo" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/bogIcoDocuments.png" />
                        </a>
                      @endforeach
                      
                      <div class="ui feed uifeedActions">
                        <div class="event">
                          <div class="label">
                            <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/etiqueta-ico.png">
                          </div>
                          <div class="content contLike">
                            <div class="summary">
                              <p class="gasper"> {{$banderaLikes = 0}}</p>
                              @foreach($Likes as $keyLikes => $likes)
                                @if( $PostImpar['id'] == $likes['id_publicacion'])
                                <p class="gasper"> {{ $banderaLikes = $banderaLikes+1}}</p>
                                  <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                    @if(in_array(Auth::user()->id, $likes['id_usuarios_likes']))
                                      Atí y a {{ $likes['total_likes']-1 }} les gusta
                                      <input type="hidden" class="dislike" name="dislike_action_id" value="{{ Auth::user()->id }}">
                                    @else
                                      {{ $likes['total_likes']}} Me gusta
                                    @endif    
                                    <input type="hidden" class="dislike" name="dislike_action_id" value="">
                                    <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostImpar['id'] }}">
                                    <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostImpar['id_usuario'] }}">
                                  </a>
                                @endif
                              @endforeach
                              @if($banderaLikes == 0)
                                <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                  0 Me gusta
                                  <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                  <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostImpar['id'] }}">
                                  <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostImpar['id_usuario'] }}">
                                </a>
                              @endif
                              
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 captionlokComen">
                        @foreach($Coments as $datComents)
                          @if($PostImpar['id'] == $datComents->id_publicacion)
                            <div class="ui feed uifeedComnetUser">
                              <div class="event">
                                <div class="label dataPrubeIm" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $datComents->foto }}')">
                                </div>
                                <div class="content">
                                  <div class="summary">
                                    <a class="user colorGrisMediumSuave fontMiriamProSemiBold">
                                      {{ $datComents->name }}
                                    </a>
                                    <div class="date fontMiriamProRegular colorGrisMediumSuave comentUser">
                                      {{ $datComents->comentarios }}
                                    </div>                           
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endif
                        @endforeach
                      </div>
                      <form class="ui form formComentUser">
                        <div class="field">
                          <textarea name="comentario_post" required></textarea>
                          <input type="hidden" class="iduserComent" name="coment_action_id" value="{{ Auth::user()->id }}">
                          <input type="hidden" class="idDataPost" name="data_id_post" value="{{ $PostImpar['id'] }}">
                        </div>
                        <a href="" class="dataComenyt"><p>Comentar</p></a>
                      </form>
                  </div>
                  @endif
                @endforeach
                
              @elseif($PostImpar['id_tipo_publicacion'] == 1 && $PostImpar['imagen'] == '' && $PostImpar['documentos'] == '')
              @foreach($JoinTableUserPosts as $dataUSe)
                @if($PostImpar['id_usuario'] == $dataUSe->id_usuario)
                <div class="col-md-12">
                  <div class="ui feed uifeedAvatar">
                    <div class="event">
                      <div class="label dataPrubeIm" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataUSe->foto }}')">
                      </div>
                      <div class="content">
                        <div class="summary">
                          <a class="user colorGrisMediumSuave fontMiriamProSemiBold">
                            {{ $dataUSe->name }}
                          </a>
                          <div class="date fontMiriamProRegular colorGrisMediumSuave">
                            <p class="gasper">{{ $carbon = new \Carbon\Carbon() }}</p>
                            <p class="gasper">{{ $fechaActual = $carbon->now()->format('Y-m-d') }}</p>
                            <p class="gasper">{{ $horaActual = $carbon->now()->format('H:i:s') }}</p>
                            <p class="gasper">{{ $date = new \Carbon\Carbon($PostImpar['created_at']) }}</p>
                            <p class="gasper">{{ $dayPost = $date->format('Y-m-d') }}</p>
                            <p class="gasper">{{ $HoraPost = $date->format('H:i:s') }}</p>
                            @if($fechaActual == $dayPost)
                              {{ date('H:i',strtotime($horaActual) - strtotime($HoraPost)) }}
                             @else
                               {{ $dayPost }}
                             
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <p class="textCOment fontMiriamProRegular colorGrisMediumSuave">{{ $PostImpar['descripcion'] }}</p>
                  <div class="ui feed uifeedActions">
                    <div class="event">
                      <div class="label">
                        <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/etiqueta-ico.png">
                      </div>
                      <div class="content contLike">
                        <div class="summary">
                          <p class="gasper"> {{$banderaLikes = 0}}</p>
                          @foreach($Likes as $keyLikes => $likes)
                            @if( $PostImpar['id'] == $likes['id_publicacion'])
                            <p class="gasper"> {{ $banderaLikes = $banderaLikes+1}}</p>
                              <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                @if(in_array(Auth::user()->id, $likes['id_usuarios_likes']))
                                  Atí y a {{ $likes['total_likes']-1 }} les gusta
                                  <input type="hidden" class="dislike" name="dislike_action_id" value="{{ Auth::user()->id }}">
                                @else
                                  {{ $likes['total_likes']}} Me gusta
                                @endif    
                                <input type="hidden" class="dislike" name="dislike_action_id" value="">
                                <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostImpar['id'] }}">
                                <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostImpar['id_usuario'] }}">
                              </a>
                            @endif
                          @endforeach
                          @if($banderaLikes == 0)
                            <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                              0 Me gusta
                              <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                              <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostImpar['id'] }}">
                              <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostImpar['id_usuario'] }}">
                            </a>
                          @endif
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 captionlokComen">
                    @foreach($Coments as $datComents)
                      @if($PostImpar['id'] == $datComents->id_publicacion)
                        <div class="ui feed uifeedComnetUser">
                          <div class="event">
                            <div class="label dataPrubeIm" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $datComents->foto }}')">
                            </div>
                            <div class="content">
                              <div class="summary">
                                <a class="user colorGrisMediumSuave fontMiriamProSemiBold">
                                  {{ $datComents->name }}
                                </a>
                                <div class="date fontMiriamProRegular colorGrisMediumSuave comentUser">
                                  {{ $datComents->comentarios }}
                                </div>                           
                              </div>
                            </div>
                          </div>
                        </div>
                      @endif
                    @endforeach
                  </div>
                  <form class="ui form formComentUser">
                    <div class="field">
                      <textarea name="comentario_post" required></textarea>
                      <input type="hidden" class="iduserComent" name="coment_action_id" value="{{ Auth::user()->id }}">
                      <input type="hidden" class="idDataPost" name="data_id_post" value="{{ $PostImpar['id'] }}">
                    </div>
                    <a href="" class="dataComenyt"><p>Comentar</p></a>
                  </form>
                </div>
                @endif
              @endforeach
              
            {{-- Si el post es tipo vacaciones --}}
            @elseif($PostImpar['id_tipo_publicacion'] == 4)
              @foreach($JoinTableUserPosts as $dataUSe)
                @if($PostImpar['id_usuario'] == $dataUSe->id_usuario)
                  <div class="col-md-12 typeEventEspecial">
                     <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/ico-vacaciones.jpg">
                     <h4 class="fontCovered">¡Felices vacaciones!</h4>
                     <h5 class="fontMiriamProRegular">Te desea Valdez Mobile</h5>
                     <div class="ui feed uifeedActions">
                       <div class="event">
                         <div class="label">
                           <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/etiqueta-ico.png">
                         </div>
                         <div class="content contLike">
                           <div class="summary">
                             <p class="gasper"> {{$banderaLikes = 0}}</p>
                             @foreach($Likes as $keyLikes => $likes)
                               @if( $PostImpar['id'] == $likes['id_publicacion'])
                               <p class="gasper"> {{ $banderaLikes = $banderaLikes+1}}</p>
                                 <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                   @if(in_array(Auth::user()->id, $likes['id_usuarios_likes']))
                                     Atí y a {{ $likes['total_likes']-1 }} les gusta
                                     <input type="hidden" class="dislike" name="dislike_action_id" value="{{ Auth::user()->id }}">
                                   @else
                                     {{ $likes['total_likes']}} Me gusta
                                   @endif    
                                   <input type="hidden" class="dislike" name="dislike_action_id" value="">
                                   <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                   <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostImpar['id'] }}">
                                   <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostImpar['id_usuario'] }}">
                                 </a>
                               @endif
                             @endforeach
                             @if($banderaLikes == 0)
                               <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                 0 Me gusta
                                 <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                 <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostImpar['id'] }}">
                                 <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostImpar['id_usuario'] }}">
                               </a>
                             @endif
                           </div>
                         </div>
                       </div>
                     </div>
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 captionlokComen">
                       @foreach($Coments as $datComents)
                         @if($PostImpar['id'] == $datComents->id_publicacion)
                           <div class="ui feed uifeedComnetUser">
                             <div class="event">
                               <div class="label dataPrubeIm" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $datComents->foto }}')">
                               </div>
                               <div class="content">
                                 <div class="summary">
                                   <a class="user colorGrisMediumSuave fontMiriamProSemiBold">
                                     {{ $datComents->name }}
                                   </a>
                                   <div class="date fontMiriamProRegular colorGrisMediumSuave comentUser">
                                     {{ $datComents->comentarios }}
                                   </div>                           
                                 </div>
                               </div>
                             </div>
                           </div>
                         @endif
                       @endforeach
                     </div>
                     <form class="ui form formComentUser">
                       <div class="field">
                         <textarea name="comentario_post"></textarea>
                         <input type="hidden" class="iduserComent" name="coment_action_id" value="{{ Auth::user()->id }}">
                       </div>
                       <a href=""><p>Comentar</p></a>
                     </form>
                  </div>
                @endif
              @endforeach
              

              @elseif($PostImpar['id_tipo_publicacion'] == 5)
                @foreach($JoinTableUserPosts as $dataUSe)
                  @if($PostImpar['id_usuario'] == $dataUSe->id_usuario)
                    <div class="col-md-12 typeEventCumpleanos">
                      <a href="" class="removeComent">
                        <i class="fa fa-times" aria-hidden="true"></i>
                      </a> 
                      <div class="bgHappy">
                        <img class="img-responsive PeopleHappy" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataUSe->foto }}">
                      </div>
                      <h4 class="fontCovered">¡Feliz cumpleaños {{ $dataUSe->name }}!</h4>
                      <h5 class="fontMiriamProRegular">Te desea Valdez Mobile</h5>
                      <div class="ui feed uifeedActions">
                        <div class="event">
                          <div class="label">
                            <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/etiqueta-ico.png">
                          </div>
                          <div class="content contLike">
                            <div class="summary">
                              <p class="gasper"> {{$banderaLikes = 0}}</p>
                              @foreach($Likes as $keyLikes => $likes)
                                @if( $PostImpar['id'] == $likes['id_publicacion'])
                                <p class="gasper"> {{ $banderaLikes = $banderaLikes+1}}</p>
                                  <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                    @if(in_array(Auth::user()->id, $likes['id_usuarios_likes']))
                                      Atí y a {{ $likes['total_likes']-1 }} les gusta
                                      <input type="hidden" class="dislike" name="dislike_action_id" value="{{ Auth::user()->id }}">
                                    @else
                                      {{ $likes['total_likes']}} Me gusta
                                    @endif    
                                    <input type="hidden" class="dislike" name="dislike_action_id" value="">
                                    <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostImpar['id'] }}">
                                    <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostImpar['id_usuario'] }}">
                                  </a>
                                @endif
                              @endforeach
                              @if($banderaLikes == 0)
                                <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                  0 Me gusta
                                  <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                  <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostImpar['id'] }}">
                                  <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostImpar['id_usuario'] }}">
                                </a>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 captionlokComen">
                        @foreach($Coments as $datComents)
                          @if($PostImpar['id'] == $datComents->id_publicacion)
                            <div class="ui feed uifeedComnetUser">
                              <div class="event">
                                <div class="label dataPrubeIm" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $datComents->foto }}')">
                                </div>
                                <div class="content">
                                  <div class="summary">
                                    <a class="user colorGrisMediumSuave fontMiriamProSemiBold">
                                      {{ $datComents->name }}
                                    </a>
                                    <div class="date fontMiriamProRegular colorGrisMediumSuave comentUser">
                                      {{ $datComents->comentarios }}
                                    </div>                           
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endif
                        @endforeach
                      </div>
                      <form class="ui form formComentUser">
                        <div class="field">
                          <textarea name="comentario_post" required></textarea>
                          <input type="hidden" class="iduserComent" name="coment_action_id" value="{{ Auth::user()->id }}">
                          <input type="hidden" class="idDataPost" name="data_id_post" value="{{ $PostImpar['id'] }}">
                        </div>
                        <a href="" class="dataComenyt"><p>Comentar</p></a>
                      </form>
                    </div>
                  @endif
                @endforeach
            @endif
          @endif
        @endforeach
        
      @endforeach
    </div>

    {{-- BLOQUE LATERAL --}}
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">    
      @foreach($DataArrayPostPar as $dataArrPostPar => $PostPar)
        @foreach($PostPersonalizados as $verfiPost)
          @if($PostPar['id'] == $verfiPost->id_posts && $verfiPost->id_usuario == Auth::user()->id)
            @if($PostPar['id_tipo_publicacion'] == 1 && $PostPar['imagen'] != '')
              @foreach($JoinTableUserPosts as $dataUSe)
                @if($PostPar['id_usuario'] == $dataUSe->id_usuario)
                  <div class="col-md-12">
                      <div class="ui feed uifeedAvatar">
                        <div class="event">
                          <div class="label dataPrubeIm" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataUSe->foto }}')">
                          </div>
                          <div class="content">
                            <div class="summary">
                              <a class="user colorGrisMediumSuave fontMiriamProSemiBold">
                                {{ $dataUSe->name }}
                              </a>
                              <div class="date fontMiriamProRegular colorGrisMediumSuave">
                                <p class="gasper">{{ $carbon = new \Carbon\Carbon() }}</p>
                                <p class="gasper">{{ $fechaActual = $carbon->now()->format('Y-m-d') }}</p>
                                <p class="gasper">{{ $horaActual = $carbon->now()->format('H:i:s') }}</p>
                                <p class="gasper">{{ $date = new \Carbon\Carbon($PostPar['created_at']) }}</p>
                                <p class="gasper">{{ $dayPost = $date->format('Y-m-d') }}</p>
                                <p class="gasper">{{ $HoraPost = $date->format('H:i:s') }}</p>
                                @if($fechaActual == $dayPost)
                                   {{ date('H:i',strtotime($horaActual) - strtotime($HoraPost)) }}
                                 @else
                                   {{ $dayPost }}
                                 
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <p class="textCOment fontMiriamProRegular colorGrisMediumSuave">{{ $PostPar['descripcion'] }}</p>
                      @foreach($PostPar['imagen'] as $imagess)                     
                        <img class="img-responsive clImgView" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/documents/{{ $imagess }}" alt="{{ $imagess }}"  data-toggle="modal" data-target="#myModalswPost">
                          
                          <!-- Modal -->
                          <div class="modal fade" id="myModalswPost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog dialoDataImgen" role="document">
                              <div class="modal-content">
                                <div class="modal-body">
                                  <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/documents/{{ $imagess }}" alt="{{ $imagess }}">
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                      @endforeach                     
                      <div class="ui feed uifeedActions">
                        <div class="event">
                          <div class="label">
                            <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/etiqueta-ico.png">
                          </div>
                          <div class="content contLike">
                            <div class="summary">
                              <p class="gasper"> {{$banderaLikes = 0}}</p>
                              @foreach($Likes as $keyLikes => $likes)
                                @if( $PostPar['id'] == $likes['id_publicacion'])
                                <p class="gasper"> {{ $banderaLikes = $banderaLikes+1}}</p>
                                  <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                    @if(in_array(Auth::user()->id, $likes['id_usuarios_likes']))
                                      Atí y a {{ $likes['total_likes']-1 }} les gusta
                                      <input type="hidden" class="dislike" name="dislike_action_id" value="{{ Auth::user()->id }}">
                                    @else
                                      {{ $likes['total_likes']}} Me gusta
                                    @endif    
                                    <input type="hidden" class="dislike" name="dislike_action_id" value="">
                                    <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostPar['id'] }}">
                                    <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostPar['id_usuario'] }}">
                                  </a>
                                @endif
                              @endforeach
                              @if($banderaLikes == 0)
                                <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                  0 Me gusta
                                  <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                  <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostPar['id'] }}">
                                  <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostPar['id_usuario'] }}">
                                </a>
                              @endif
                              
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 captionlokComen">
                        @foreach($Coments as $datComents)
                          @if($PostPar['id'] == $datComents->id_publicacion)
                            <div class="ui feed uifeedComnetUser">
                              <div class="event">
                                <div class="label dataPrubeIm" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $datComents->foto }}')">
                                </div>
                                <div class="content">
                                  <div class="summary">
                                    <a class="user colorGrisMediumSuave fontMiriamProSemiBold">
                                      {{ $datComents->name }}
                                    </a>
                                    <div class="date fontMiriamProRegular colorGrisMediumSuave comentUser">
                                      {{ $datComents->comentarios }}
                                    </div>                           
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endif
                        @endforeach
                      </div>
                      <form class="ui form formComentUser">
                        <div class="field">
                          <textarea name="comentario_post" required></textarea>
                          <input type="hidden" class="iduserComent" name="coment_action_id" value="{{ Auth::user()->id }}">
                          <input type="hidden" class="idDataPost" name="data_id_post" value="{{ $PostPar['id'] }}">
                        </div>
                        <a href="" class="dataComenyt"><p>Comentar</p></a>
                      </form>
                  </div>
                @endif
              @endforeach              

              @elseif($PostPar['id_tipo_publicacion'] == 1 && $PostPar['documentos'] != '')
                @foreach($JoinTableUserPosts as $dataUSe)
                  @if($PostPar['id_usuario'] == $dataUSe->id_usuario)
                    <div class="col-md-12">
                        <div class="ui feed uifeedAvatar">
                          <div class="event">
                            <div class="label dataPrubeIm" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataUSe->foto }}')">
                            </div>
                            <div class="content">
                              <div class="summary">
                                <a class="user colorGrisMediumSuave fontMiriamProSemiBold">
                                  {{ $dataUSe->name }}
                                </a>
                                <div class="date fontMiriamProRegular colorGrisMediumSuave">
                                  <p class="gasper">{{ $carbon = new \Carbon\Carbon() }}</p>
                                  <p class="gasper">{{ $fechaActual = $carbon->now()->format('Y-m-d') }}</p>
                                  <p class="gasper">{{ $horaActual = $carbon->now()->format('H:i:s') }}</p>
                                  <p class="gasper">{{ $date = new \Carbon\Carbon($PostImpar['created_at']) }}</p>
                                  <p class="gasper">{{ $dayPost = $date->format('Y-m-d') }}</p>
                                  <p class="gasper">{{ $HoraPost = $date->format('H:i:s') }}</p>
                                  @if($fechaActual == $dayPost)
                                     {{ date('H:i',strtotime($horaActual) - strtotime($HoraPost)) }}
                                   @else
                                     {{ $dayPost }}
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        </a>
                        <p class="textCOment fontMiriamProRegular colorGrisMediumSuave">{{ $PostPar['descripcion'] }}</p>
                        @foreach($PostPar['documentos'] as $docume)
                          <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/documents/{{ $docume }}" class="dataDpcuCl" download="{{ $docume }}">
                            <img class="img-responsive claa__cupo" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/bogIcoDocuments.png" />
                          </a>
                        @endforeach
                        <div class="ui feed uifeedActions">
                          <div class="event">
                            <div class="label">
                              <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/etiqueta-ico.png">
                            </div>
                            <div class="content contLike">
                              <div class="summary">
                                <p class="gasper"> {{$banderaLikes = 0}}</p>
                                @foreach($Likes as $keyLikes => $likes)
                                  @if( $PostPar['id'] == $likes['id_publicacion'])
                                  <p class="gasper"> {{ $banderaLikes = $banderaLikes+1}}</p>
                                    <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                      @if(in_array(Auth::user()->id, $likes['id_usuarios_likes']))
                                        Atí y a {{ $likes['total_likes']-1 }} les gusta
                                        <input type="hidden" class="dislike" name="dislike_action_id" value="{{ Auth::user()->id }}">
                                      @else
                                        {{ $likes['total_likes']}} Me gusta
                                      @endif    
                                      <input type="hidden" class="dislike" name="dislike_action_id" value="">
                                      <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                      <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostPar['id'] }}">
                                      <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostPar['id_usuario'] }}">
                                    </a>
                                  @endif
                                @endforeach
                                @if($banderaLikes == 0)
                                  <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                    0 Me gusta
                                    <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostPar['id'] }}">
                                    <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostPar['id_usuario'] }}">
                                  </a>
                                @endif
                                                                
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 captionlokComen">
                          @foreach($Coments as $datComents)
                            @if($PostPar['id'] == $datComents->id_publicacion)
                              <div class="ui feed uifeedComnetUser">
                                <div class="event">
                                  <div class="label dataPrubeIm" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $datComents->foto }}')">
                                  </div>
                                  <div class="content">
                                    <div class="summary">
                                      <a class="user colorGrisMediumSuave fontMiriamProSemiBold">
                                        {{ $datComents->name }}
                                      </a>
                                      <div class="date fontMiriamProRegular colorGrisMediumSuave comentUser">
                                        {{ $datComents->comentarios }}
                                      </div>                           
                                    </div>
                                  </div>
                                </div>
                              </div>
                            @endif
                          @endforeach
                        </div>
                        <form class="ui form formComentUser">
                          <div class="field">
                            <textarea name="comentario_post" required></textarea>
                            <input type="hidden" class="iduserComent" name="coment_action_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" class="idDataPost" name="data_id_post" value="{{ $PostPar['id'] }}">
                          </div>
                          <a href="" class="dataComenyt"><p>Comentar</p></a>
                        </form>
                    </div>
                  @endif
                @endforeach
                

              @elseif($PostPar['id_tipo_publicacion'] == 1 && $PostPar['imagen'] == '' && $PostPar['documentos'] == '')
                @foreach($JoinTableUserPosts as $dataUSe)
                  @if($PostPar['id_usuario'] == $dataUSe->id_usuario)
                    <div class="col-md-12">
                      <div class="ui feed uifeedAvatar">
                        <div class="event">
                          <div class="label dataPrubeIm" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataUSe->foto }}')">
                          </div>
                          <div class="content">
                            <div class="summary">
                              <a class="user colorGrisMediumSuave fontMiriamProSemiBold">
                                {{ $dataUSe->name }}
                              </a>
                              <div class="date fontMiriamProRegular colorGrisMediumSuave">
                                <p class="gasper">{{ $carbon = new \Carbon\Carbon() }}</p>
                                <p class="gasper">{{ $fechaActual = $carbon->now()->format('Y-m-d') }}</p>
                                <p class="gasper">{{ $horaActual = $carbon->now()->format('H:i:s') }}</p>
                                <p class="gasper">{{ $date = new \Carbon\Carbon($PostPar['created_at']) }}</p>
                                <p class="gasper">{{ $dayPost = $date->format('Y-m-d') }}</p>
                                <p class="gasper">{{ $HoraPost = $date->format('H:i:s') }}</p>
                                @if($fechaActual == $dayPost)
                                   {{ date('H:i',strtotime($horaActual) - strtotime($HoraPost)) }}
                                 @else
                                   {{ $dayPost }}
                                 
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <p class="textCOment fontMiriamProRegular colorGrisMediumSuave">{{ $PostPar['descripcion'] }}</p>
                      <p class="textCOment fontMiriamProRegular colorGrisMediumSuave">{{ $PostPar['descripcion'] }}</p>
                      <div class="ui feed uifeedActions">
                        <div class="event">
                          <div class="label">
                            <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/etiqueta-ico.png">
                          </div>
                          <div class="content contLike">
                            <div class="summary">
                              <p class="gasper"> {{$banderaLikes = 0}}</p>
                              @foreach($Likes as $keyLikes => $likes)
                                @if( $PostPar['id'] == $likes['id_publicacion'])
                                <p class="gasper"> {{ $banderaLikes = $banderaLikes+1}}</p>
                                  <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                    @if(in_array(Auth::user()->id, $likes['id_usuarios_likes']))
                                      Atí y a {{ $likes['total_likes']-1 }} les gusta
                                      <input type="hidden" class="dislike" name="dislike_action_id" value="{{ Auth::user()->id }}">
                                    @else
                                      {{ $likes['total_likes']}} Me gusta
                                    @endif    
                                    <input type="hidden" class="dislike" name="dislike_action_id" value="">
                                    <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostPar['id'] }}">
                                    <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostPar['id_usuario'] }}">
                                  </a>
                                @endif
                              @endforeach
                              @if($banderaLikes == 0)
                                <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                  0 Me gusta
                                  <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                  <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostPar['id'] }}">
                                  <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostPar['id_usuario'] }}">
                                </a>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 captionlokComen">
                        @foreach($Coments as $datComents)
                          @if($PostPar['id'] == $datComents->id_publicacion)
                            <div class="ui feed uifeedComnetUser">
                              <div class="event">
                                <div class="label dataPrubeIm" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $datComents->foto }}')">
                                </div>
                                <div class="content">
                                  <div class="summary">
                                    <a class="user colorGrisMediumSuave fontMiriamProSemiBold">
                                      {{ $datComents->name }}
                                    </a>
                                    <div class="date fontMiriamProRegular colorGrisMediumSuave comentUser">
                                      {{ $datComents->comentarios }}
                                    </div>                           
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endif
                        @endforeach
                      </div>
                      <form class="ui form formComentUser">
                        <div class="field">
                          <textarea name="comentario_post" required></textarea>
                          <input type="hidden" class="iduserComent" name="coment_action_id" value="{{ Auth::user()->id }}">
                          <input type="hidden" class="idDataPost" name="data_id_post" value="{{ $PostPar['id'] }}">
                        </div>
                        <a href="" class="dataComenyt"><p>Comentar</p></a>
                      </form>
                    </div>
                  @endif
                @endforeach
            {{-- Si el post es tipo vacaciones --}}
            @elseif($PostPar['id_tipo_publicacion'] == 4)
              @foreach($JoinTableUserPosts as $dataUSe)
                @if($PostPar['id_usuario'] == $dataUSe->id_usuario)
                  <div class="col-md-12 typeEventEspecial">
                     <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/ico-vacaciones.jpg">
                     <h4 class="fontCovered">¡Felices vacaciones!</h4>
                     <h5 class="fontMiriamProRegular">Te desea Valdez Mobile</h5>
                     <div class="ui feed uifeedActions">
                       <div class="event">
                         <div class="label">
                           <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/etiqueta-ico.png">
                         </div>
                         <div class="content contLike">
                           <div class="summary">
                             <p class="gasper"> {{$banderaLikes = 0}}</p>
                             @foreach($Likes as $keyLikes => $likes)
                               @if( $PostPar['id'] == $likes['id_publicacion'])
                               <p class="gasper"> {{ $banderaLikes = $banderaLikes+1}}</p>
                                 <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                   @if(in_array(Auth::user()->id, $likes['id_usuarios_likes']))
                                     Atí y a {{ $likes['total_likes']-1 }} les gusta
                                     <input type="hidden" class="dislike" name="dislike_action_id" value="{{ Auth::user()->id }}">
                                   @else
                                     {{ $likes['total_likes']}} Me gusta
                                   @endif    
                                   <input type="hidden" class="dislike" name="dislike_action_id" value="">
                                   <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                   <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostPar['id'] }}">
                                   <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostPar['id_usuario'] }}">
                                 </a>
                               @endif
                             @endforeach
                             @if($banderaLikes == 0)
                               <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                 0 Me gusta
                                 <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                 <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostPar['id'] }}">
                                 <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostPar['id_usuario'] }}">
                               </a>
                             @endif
                           </div>
                         </div>
                       </div>
                     </div>
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 captionlokComen">
                       @foreach($Coments as $datComents)
                         @if($PostPar['id'] == $datComents->id_publicacion)
                           <div class="ui feed uifeedComnetUser">
                             <div class="event">
                               <div class="label dataPrubeIm" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $datComents->foto }}')">
                               </div>
                               <div class="content">
                                 <div class="summary">
                                   <a class="user colorGrisMediumSuave fontMiriamProSemiBold">
                                     {{ $datComents->name }}
                                   </a>
                                   <div class="date fontMiriamProRegular colorGrisMediumSuave comentUser">
                                     {{ $datComents->comentarios }}
                                   </div>                           
                                 </div>
                               </div>
                             </div>
                           </div>
                         @endif
                       @endforeach
                     </div>
                     <form class="ui form formComentUser">
                       <div class="field">
                         <textarea name="comentario_post" required></textarea>
                         <input type="hidden" class="iduserComent" name="coment_action_id" value="{{ Auth::user()->id }}">
                         <input type="hidden" class="idDataPost" name="data_id_post" value="{{ $PostPar['id'] }}">
                       </div>
                       <a href="" class="dataComenyt"><p>Comentar</p></a>
                     </form>
                  </div>
                @endif
              @endforeach
              

              @elseif($PostPar['id_tipo_publicacion'] == 5)
                @foreach($JoinTableUserPosts as $dataUSe)
                  @if($PostPar['id_usuario'] == $dataUSe->id_usuario)
                    <div class="col-md-12 typeEventCumpleanos">
                      <a href="" class="removeComent">
                        <i class="fa fa-times" aria-hidden="true"></i>
                      </a> 
                      <div class="bgHappy">
                        <img class="img-responsive PeopleHappy" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataUSe->foto }}">
                      </div>
                      <h4 class="fontCovered">¡Feliz cumpleaños {{ $dataUSe->name }}!</h4>
                      <h5 class="fontMiriamProRegular">Te desea Valdez Mobile</h5>
                      <div class="ui feed uifeedActions">
                        <div class="event">
                          <div class="label">
                            <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/etiqueta-ico.png">
                          </div>
                          <div class="content contLike">
                            <div class="summary">
                              <p class="gasper"> {{$banderaLikes = 0}}</p>
                              @foreach($Likes as $keyLikes => $likes)
                                @if( $PostPar['id'] == $likes['id_publicacion'])
                                <p class="gasper"> {{ $banderaLikes = $banderaLikes+1}}</p>
                                  <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                    @if(in_array(Auth::user()->id, $likes['id_usuarios_likes']))
                                      Atí y a {{ $likes['total_likes']-1 }} les gusta
                                      <input type="hidden" class="dislike" name="dislike_action_id" value="{{ Auth::user()->id }}">
                                    @else
                                      {{ $likes['total_likes']}} Me gusta
                                    @endif    
                                    <input type="hidden" class="dislike" name="dislike_action_id" value="">
                                    <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostPar['id'] }}">
                                    <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostPar['id_usuario'] }}">
                                  </a>
                                @endif
                              @endforeach
                              @if($banderaLikes == 0)
                                <a class="user colorGrisMediumSuave fontMiriamProSemiBold clkLike">
                                  0 Me gusta
                                  <input type="hidden" class="idUseLike" name="like_action_id" value="{{ Auth::user()->id }}">
                                  <input type="hidden" class="idPubliLike" name="like_publicacion_id" value="{{ $PostPar['id'] }}">
                                  <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostPar['id_usuario'] }}">
                                </a>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 captionlokComen">
                        @foreach($Coments as $datComents)
                          @if($PostPar['id'] == $datComents->id_publicacion)
                            <div class="ui feed uifeedComnetUser">
                              <div class="event">
                                <div class="label dataPrubeIm" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $datComents->foto }}')">
                                </div>
                                <div class="content">
                                  <div class="summary">
                                    <a class="user colorGrisMediumSuave fontMiriamProSemiBold">
                                      {{ $datComents->name }}
                                    </a>
                                    <div class="date fontMiriamProRegular colorGrisMediumSuave comentUser">
                                      {{ $datComents->comentarios }}
                                    </div>                           
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endif
                        @endforeach
                      </div>
                      <form class="ui form formComentUser">
                        <div class="field">
                          <textarea name="comentario_post" required></textarea>
                          <input type="hidden" class="iduserComent" name="coment_action_id" value="{{ Auth::user()->id }}">
                          <input type="hidden" class="idDataPost" name="data_id_post" value="{{ $PostPar['id'] }}">
                        </div>
                        <a href="" class="dataComenyt"><p>Comentar</p></a>
                      </form>
                    </div>
                  @endif
                @endforeach
            @endif
          @endif
        @endforeach
        
      @endforeach
  </div>
</div>