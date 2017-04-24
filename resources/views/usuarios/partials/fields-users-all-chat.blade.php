<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <div class="liveDataHome">
    <div class="ui accordion">
      <h3 class="fontMiriamProRegular">Usuarios</h3>
      <a href="#!" class="loadUserJa">
        <p>Cargar</p>
      </a>
      <div class="title">
        <p class="gasper"> {{ $banderaOnline = 0}}</p>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 AlluserReegitrados columnChatss captionLikechatsFlotante getUserLoad">
          <span class="lnvmodal lnvmodal-loadermin" style="opacity: 0.9;">
          </span> 
        </div>                            
      </div>
      <div class="content">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 AlluserReegitrados columnChatss captionLikechatsFlotante">
          {{-- @foreach($getUsers as $users)
            <p class="gasper"> {{ $banderaOnline = $banderaOnline+1 }}</p>   
            @if($banderaOnline >= 4 )
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 AlluserReegitradosPorBloque">
                <a href="#!" data-iduserchat="{{ $users->id_usuario }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 vloqImageUser" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $users->foto }}')">
                  </div>            
                </a>                
              </div>  
            @endif
          @endforeach  --}} 
        </div>
      </div>
    </div>
  </div>
</div>