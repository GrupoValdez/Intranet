<!-- Modal -->
<div class="modal fade" id="myModalSolicitudRespuesta{{ $asis->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog contAcotionModlas" role="document">
    <div class="modal-content">
      <div class="modal-body captionBodySolicRespuesa">
        <div class="col-xs-12 col-sm-12 col-md-12 contRevibeSOlic">
          <div class="col-xs-12 col-sm-12 col-md-12 clAdpsCLo">
            <h5 class="aceptSol">¿Esta seguro que desea colocar ADP a {{ $datos->nombre }}?</h5>
            <div class="captionEvulveImg" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $datos->foto }}')">              
            </div>
            <h4 class="nameSoliUser">{{ $datos->nombre }} {{ $datos->apellidos }}</h4>
            <p class="AcepAdp">Aceptar</p>
            <p class="return" data-dismiss="modal">Regresar</p>
            <form action="adps" method="post" accept-charset="utf-8" class="placeADP">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               @foreach($ADPS as $adp)
                @if($adp->tipo_adp == 'Llegadas tarde')
                  <input type="hidden" value="{{ $adp->id }}" name="type_adp">                  
                  <input type="hidden" value="{{ $datos->id_usuario }}" name="_id_usuario">
                  <input type="hidden" value="{{ $asis->id }}" name="_id_asistencia">
                @endif                
               @endforeach
             </form>
          </div>          
        </div>
      </div>
    </div>
  </div>
</div>