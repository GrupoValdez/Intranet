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
               <p class="gasper"> {{$banderaLikes4 = 0}}</p>
               @foreach($Likes as $keyLikes => $likes)
                 @if( $PostImpar['id'] == $likes['id_publicacion'])
                   <p class="gasper"> {{ $banderaLikes4 = $banderaLikes4+1}}</p>
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
               @if($banderaLikes4 == 0)
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
                     <a href="profile-users/{{ $PostImpar['id_usuario'] }}"  class="user colorGrisMediumSuave fontMiriamProSemiBold">
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
           <input type="hidden" class="idUserPublicoPostComent" name="id_user_pub_post" value="{{ $PostImpar['id_usuario'] }}">
         </div>
         <a href="" class="dataComenyt"><p>Comentar</p></a>
       </form>
    </div>
  @endif
@endforeach