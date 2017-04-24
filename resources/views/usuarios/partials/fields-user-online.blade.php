{{-- CAPTION USER LIVES --}}
<div class="captionUsersInLive">
  <div class="ui accordion">
    <h3 class="fontMiriamProRegular"><span class='estusLive'>•</span>En Linea</h3>
    <div class="title col-xs-12 col-sm-12 col-md-12 col-lg-12 AlluserReegitrados columnChatss captionLikechatsFlotante captionLikechatsFlotanteDta">
      <p class="gasper"> {{ $banderaOnline = 0}}</p>
        @foreach($AllOnlineUser as $onlineUsers)
          <p class="gasper"> {{ $banderaOnline = $banderaOnline+1 }}</p>
          <div class="captionCircleUser captionDenoews AlluserReegitradosPorBloque">
            <a href="#!" class="userLive" data-idonline='{{ $onlineUsers['id_user'] }}' data-iduserchat="{{ $onlineUsers['id_user'] }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="label dataPrubeIm vloqImageUser dataProfileAllUsersOnline" style="background-image: {{ $onlineUsers['foto'] }}">
              </div>
            </a>
          </div>
          @if($banderaOnline > 3 )
            <div class="captionCircleUser">
              <i class="fa fa-angle-down" aria-hidden="true"></i>
            </div> 
            <p class="gasper"> {{ $banderaOnline = 0 }}</p>
            @break
          @endif
        @endforeach
                                   
    </div>
    <div class="content col-xs-12 col-sm-12 col-md-12 col-lg-12 AlluserReegitrados columnChatss captionLikechatsFlotante captionLikechatsFlotanteDta">
      @foreach($AllOnlineUser as $onlineUsers)
        <p class="gasper"> {{ $banderaOnline = $banderaOnline+1 }}</p>                  
        @if($banderaOnline >= 4 )
          <div class="captionCircleUser captionDenoews AlluserReegitradosPorBloque">
            <a href="#!" class="userLive" data-idonline='{{ $onlineUsers['id_user'] }}' data-iduserchat="{{ $onlineUsers['id_user'] }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="label dataPrubeIm vloqImageUser dataProfileAllUsersOnline" style="background-image: {{ $onlineUsers['foto'] }}">
              </div>            
            </a>
          </div>
        @endif
      @endforeach
    </div>
  </div>
</div>