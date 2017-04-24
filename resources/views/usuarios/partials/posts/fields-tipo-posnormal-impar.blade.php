@foreach($JoinTableUserPosts as $dataUSe)


  @if($PostImpar['id_usuario'] == $dataUSe->id_usuario)
  <div class="col-md-12">
      <div class="ui feed uifeedAvatar">
        <div class="event">
          <p class="gasper">{{ $GetImage  = \Storage::disk('ubUploadsChange')->get('/profiles/'.$dataUSe->foto.'') }}</p>
          <div class="label dataPrubeIm" style="background-image: url('data:{{ $PostImpar['mime'] }};base64,{{ base64_encode($GetImage) }}')">
          </div>
          <div class="content">
            <div class="summary postPosss">
              <a href="profile-users/{{ $PostImpar['id_usuario'] }}"  class="user colorGrisMediumSuave fontMiriamProSemiBold">
                {{ $dataUSe->name }}
              </a>
              <div class="date fontMiriamProRegular colorGrisMediumSuave">
                @if($PostImpar['id_tipo_publicacion'] == 2)
                  <img class="img-responsve alertPost" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/icons/alertico.png" alt="">
                @endif
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
      @if($PostImpar['imagen'] != '')
        @foreach($PostImpar['imagen'] as $imagess) 
          <p class="gasper">{{ $storagePath  = \Storage::disk('ubUploadsChange')->get('/documents/'.$imagess.'') }}</p>
          <img class="img-responsive clImgView" src="data:{{ $PostImpar['mime'] }};base64,{{ base64_encode($storagePath) }}" data-toggle="modal" data-target="#myModalswPost" alt="{{ $storagePath }}">  
            
            <!-- Modal -->
            <div class="modal fade" id="myModalswPost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog dialoDataImgen" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <img class="img-responsive clImgView" src="data:{{ $PostImpar['mime'] }};base64,{{ base64_encode($storagePath) }}" data-toggle="modal" data-target="#myModalswPost" alt="{{ $storagePath }}"> 
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
        @endforeach
      @endif

      @if($PostImpar['documentos'] != '')
        @foreach($PostImpar['documentos'] as $docume)
          <p class="gasper">{{ $storagePath  = \Storage::disk('ubUploadsChange')->get('/documents/'.$docume.'') }}</p>
          <a href="data:{{ $PostImpar['mime'] }};base64,{{ base64_encode($storagePath) }}" class="dataDpcuCl" download="{{ $docume }}">
            <img class="img-responsive claa__cupo" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/bogIcoDocuments.png" />
          </a>
        @endforeach
      @endif                   
      
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
               
              
              <div class="date datePint fontMiriamProRegular colorGrisMediumSuave clickPostPerson">
                <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/pines-ico.png">
                <input type="hidden" class="idUserPostPersona" name="like_action_id" value="{{ Auth::user()->id }}">
                <input type="hidden" class="idPostPersona" name="like_publicacion_id" value="{{ $PostImpar['id'] }}">
                <input type="hidden" class="idUserPublicoPost" name="id_user_pub_post" value="{{ $PostImpar['id_usuario'] }}">
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 captionlokComen">
        <p class="gasper">{{ $TotalComent = 0 }}</p>
        @foreach($Coments as $datComents)
          @if($PostImpar['id'] == $datComents->id_publicacion)
            <p class="gasper">{{ $TotalComent = $TotalComent+1 }}</p>
          @endif
        @endforeach
        @if($TotalComent > 0)
          <a href="#!" class="getComents">
            <p>({{$TotalComent}}) Comentarios</p>
            <input type="hidden" class="postIdCom" name="id_post_coment" value="{{ $PostImpar['id'] }}">
          </a>
          <span class="lnvmodal lnvmodal-loadermin" style="opacity: 0.9;">
          </span>
        @endif        
      </div>                      
      <form class="ui form formComentUser">
        <div class="field">
          <textarea name="comentario_post" required></textarea>
          <input type="hidden" class="iduserComent" name="coment_action_id" value="{{ Auth::user()->id }}">
          <input type="hidden" class="idDataPost" name="data_id_post" value="{{ $PostImpar['id'] }}">
          <input type="hidden" class="idUserPublicoPostComent" name="id_user_pub_post" value="{{ $PostImpar['id_usuario'] }}">
        </div>
        <a href="" class="dataComenyt"><p>Comentar</p></a>
      </form>
  </div>
  @endif
@endforeach

