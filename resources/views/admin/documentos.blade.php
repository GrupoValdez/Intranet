@extends('layouts.Template-admin')

@section('content')
<div class="container continerWithSite">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionAdminContain">
    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
      
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 sectionCenterContenido secCetTitleS">
      <h1>Documentos</h1>
      @include('admin.partials.fields-name-admin-login') 

      <form action="home_submit" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 formSearch" method="get" accept-charset="utf-8">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <i class="fa fa-search" aria-hidden="true"></i>
          <input type="text" placeholder="Buscar">
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

{{-- SECTION MENU INTERNO HOME --}}
<section class="container-fluid">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionMenuInterno">
    <ul class="listActionDocuemntps">
        @if($idurl6 == '')
          <li>
            <a href="#!" class="createCarpeta">Crear carpeta</a>
          </li>
             <form action="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/documentCreateDirectorie" method="post" accept-charset="utf-8" class="createNewDirec" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_url" value="{{ $idurl }}">
                <input type="hidden" name="_url2" value="{{ $idurl2 }}">
                <input type="hidden" name="_url3" value="{{ $idurl3 }}">
                <input type="hidden" name="_url4" value="{{ $idurl4 }}">
                <input type="hidden" name="_url5" value="{{ $idurl5 }}">
                <input type="hidden" class="CreateNewActionDirective" name="name_carpeta_new" />
            </form>
          <li>
             <a href="#!" onclick="FileNewDocu()">Subir</a>
          </li>
          <form action="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/documentUpload" method="post" accept-charset="utf-8" class="uploadArchivoNew2" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_url" value="{{ $idurl }}">
            <input type="hidden" name="_url2" value="{{ $idurl2 }}">
            <input type="hidden" name="_url3" value="{{ $idurl3 }}">
            <input type="hidden" name="_url4" value="{{ $idurl4 }}">
            <input type="hidden" name="_url5" value="{{ $idurl5 }}">
            <input type="file" class="fileInputUploadDocu2" name="file_input_docuemnt_upload" />
          </form>
        @endif
        
        {{-- <li><a href="">Descargar</a></li> --}}
        <li class="dreopDocument">
          <div class="dropdown dwropOptionMensgae">
            <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dLabel">
              <li>
                <form action="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/documentRemove" method="get" accept-charset="utf-8" class="removeElement">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="_url" value="{{ \Request::url() }}">
                  <input type="submit" value="Eliminar">
                </form>       
              </li>
              {{-- <li>
                <form action="documentDowload" method="post" accept-charset="utf-8" class="moveELements">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="_url" value="{{ \Request::url() }}">
                  <input type="submit" value="Descargar">
                </form>         
              </li> --}}
            </ul>          
          </div>
        </li>
    </ul>
  </div>
</section>


{{-- SECTION BLOQUE NOTIFICACION Y MENSAJES --}}
<section class="container-fluid sectionAdminNotifiMensa">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
      
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 sectionCenterContenido sectionContenidoDocuemnts">
      @if(Session::has('Remove_documentos'))
        <p class="alert alert-success">{{Session::get('Remove_documentos')}}</p>
      @endif
      @if(Session::has('Upload_document'))
        <p class="alert alert-success">{{Session::get('Upload_document')}}</p>
      @endif
      @if(Session::has('Create_directorie'))
        <p class="alert alert-success">{{Session::get('Create_directorie')}}</p>
      @endif
      {{-- En esta pagina vamos obtener los archivos del directorio carpeta admin --}}
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bloquesAdjuntoArchives">
        @foreach($ArrayCarpetas as $carpetas => $valueCarpeta)
          @if($valueCarpeta['VaueContenido'] == '1')
            <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2" data-identificador="{{$valueCarpeta['identiFI']}}">          
               <i class="fa fa-check noneIcon direCar" aria-hidden="true"></i>
              <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/documentos{{ $valueCarpeta['nameCarpeta2'] }}">
                <img class="img-responsive" id="contenedor" ondrop="drop(this, event)" ondragenter="return false" ondragover="return false" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/icons/carpetaVacia.png" alt="">
                <p class="namedataCarpeta" data-ubicacarpeta="{{ $valueCarpeta['nameCarpeta2'] }}">{{ $valueCarpeta['nameCarpeta'] }}</p>
              </a>
            </div>
          @else
            <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2 " data-identificador="{{$valueCarpeta['identiFI']}}">          
               <i class="fa fa-check noneIcon direCar" aria-hidden="true"></i>
              <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/documentos{{ $valueCarpeta['nameCarpeta2'] }}">
                <img class="img-responsive" id="contenedor" ondrop="drop(this, event)" ondragenter="return false" ondragover="return false" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/icons/carpetaLlena.png" alt="">
                <p>{{ $valueCarpeta['nameCarpeta'] }}</p>
              </a>
            </div>
          @endif
        @endforeach

         @foreach($getDirectoryArchivos as $archivos)
          <p class="gasper">{{ $randomNmm = rand(5, 12323352) }}</p>
           <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2 dataDowload" data-identificador="cla{{$randomNmm}}" id="parrafo{{$randomNmm}}" draggable="true" ondragstart="drag(this, event)">
              <i class="fa fa-check noneIcon FilCa" aria-hidden="true"></i>
             <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/icons/dcumento.png" alt="">
             <form action="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/documentDowload" method="post" accept-charset="utf-8" class="dewoDowloas">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <input type="hidden" name="_url" value="{{ $idurl }}">
               <input type="hidden" name="_url2" value="{{ $idurl2 }}">
               <input type="hidden" name="_url3" value="{{ $idurl3 }}">
               <input type="hidden" name="_url4" value="{{ $idurl4 }}">
               <input type="hidden" name="_url5" value="{{ $idurl5 }}">
               <input type="hidden" name="_name_archivo" value="{{ $archivos->nombre_archivo }}">
             </form> 
             <a href="#!">
               <p data-element="{{ $archivos->id }}" data-ubicaciom="{{ $archivos->ubicacion_archivo }}">{{ $archivos->nombre_archivo }}</p>
             </a>
           </div>
         @endforeach
        
        
        <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2 fileUploDat">
          <img class="img-responsive" onclick="FileNewDocu()" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/icons/addFile.png" alt="">
          <form action="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/documentUpload" method="post" accept-charset="utf-8" class="uploadArchivoNew" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_url" value="{{ $idurl }}">
            <input type="hidden" name="_url2" value="{{ $idurl2 }}">
            <input type="hidden" name="_url3" value="{{ $idurl3 }}">
            <input type="hidden" name="_url4" value="{{ $idurl4 }}">
            <input type="hidden" name="_url5" value="{{ $idurl5 }}">
            <input type="file" class="fileInputUploadDocu" name="file_input_docuemnt_upload" />
          </form> 
        </div>
      </div>

      {{-- end section notificaciones --}}
      

    </div>
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 ">

    </div>
    <div class="col-md-12 datPublich publishChatAdmin publichDocuemnts">
      <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/addpubliImgae.png" alt="" data-toggle="modal" data-target="#myModal">
      <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/AnuncioPublicAdmin.png" alt=""  data-toggle="modal" data-target="#myModalNotifications">
    </div>
  </div>
</section>


<!-- Modal -->
@include('usuarios.partials.field-public-post')

<!-- Modal NOTIFICACIONES -->
@include('admin.partials.fields-modal-notificaciones')


<div class="alert alert-info dataClMoPosPEr" role="alert">¡Publicacion Agregada!</div>  
  
@endsection
