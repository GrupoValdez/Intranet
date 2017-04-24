@extends('layouts.Template-chat-users')

@section('content')
<div class="container continerWithSite contaiNChatU">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7 captionPosteos captionChat">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ChatWithUser">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ChatWithUserDatas">
             <div class="label dataPrubeIm dataProfileAllUsersListChatSelect recibeSelectChat" ></div>
             <p class="colorBlack fontMiriamProSemiBold"></p>
           </div>
        </div>
        {{-- bloque chat --}}
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ChatCOntentUsers">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 userCOntentChat chat_box">    
              
          </div>
        </div>
        {{-- bloque enviar Mensaje --}}
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ChatSendUsers">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 userCOntentSend">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 contenTexaArea chat_box">
               <textarea name="" class="input_message form-control"  placeholder="Escribe aquí"></textarea>  
               <input type="hidden" class="input_id_user_logi" value="{{ Auth::user()->id }}" /> <form id='formuploadajax' class="chatFIles" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <div class="contenMoreImages">
                   <input type="file" class="fileInputImageChat1" name="fileInputImageChat[]" />
                  </div> 
               </form>           
               <input type="hidden" class="input_name DatIdUserChat" value="" />  
                      
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 contentActionSend chat_box">
               {{-- <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/adjuntarIco.png" alt=""> --}}
               <div class="anjunFoto">
                 <img class="img-responsive imImgaChat" onclick="chooseFileImageChat1();" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/adjuntarFoto.png" alt="">
               </div>
               <div class="anjunDocu">
                <img class="img-responsive img1DoChat" onclick="chooseFileDocuChat1()" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/adjuntarIco.png" alt="">
               </div>
                 
               <input type="submit" value="Enviar" class="input_send">
            </div>            
          </div>
        </div>

      </div>

      <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5 captionRecordNotas captionAllMessage">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 dataShoWmensajes">

            @foreach($GetUltimateMensage as $GetdataS)
              {{-- @if($GetdataS['id_user'] == $users->id_usuario or $GetdataS['id_user_conversation'] == $users->id_usuario ) --}}
                @if($GetdataS['id_user'] != Auth::user()->id and $GetdataS['userReceive'] == 1)
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 FriendWithChat">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 RemoveChatWithUser">
                     <form action="chatUsers_submit" method="get" accept-charset="utf-8">
                       <i class="fa fa-times" aria-hidden="true"></i>
                     </form>
                    </div>
                    @foreach($getUsers as $users)
                      @if($users->id_usuario == $GetdataS['id_user'])
                        <a href="#!" data-iduserchat="{{ $users->id_usuario }}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 vloqImageUser">
                            <p class="gasper">{{ $GetImage  = \Storage::disk('ubUploadsChange')->get('/profiles/'.$users->foto.'') }}</p>
                            <div class="label dataPrubeIm dataProfileAllUsersListChat" style="background-image: url('data:{{ $users->mime }};base64,{{ base64_encode($GetImage) }}')"></div>
                          </div>
                          <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 blqueDatasUser">
                            <p class="colorBlack fontMiriamProSemiBold TitleUserMen">{{ $users->name }} <span> dice: </span></p>
                            <p class="cont_previwMenSage">{{ $GetdataS['mensages'] }}...</p>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 TimeSendMenssage">
                           {{-- <p>6H</p> --}}
                          </div>
                        </a>
                      @endif
                    @endforeach
                   
                  </div>
                @elseif($GetdataS['id_user_conversation'] != Auth::user()->id and $GetdataS['userSend'] == 1)
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 FriendWithChat">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 RemoveChatWithUser">
                     <form action="chatUsers_submit" method="get" accept-charset="utf-8">
                       <i class="fa fa-times" aria-hidden="true"></i>
                     </form>
                    </div>
                    @foreach($getUsers as $users)
                      @if($users->id_usuario == $GetdataS['id_user_conversation'])
                        <a href="#!" data-iduserchat="{{ $users->id_usuario }}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 vloqImageUser">
                            <p class="gasper">{{ $GetImage  = \Storage::disk('ubUploadsChange')->get('/profiles/'.$users->foto.'') }}</p>
                            <div class="label dataPrubeIm dataProfileAllUsersListChat" style="background-image: url('data:{{ $users->mime }};base64,{{ base64_encode($GetImage) }}')"></div>
                          </div>
                          <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 blqueDatasUser">
                            <p class="colorBlack fontMiriamProSemiBold TitleUserMen">{{ $users->name }} <span> dice: </span></p>
                            <p class="cont_previwMenSage">Tu: {{ $GetdataS['mensages'] }}...</p>
                          </div>
                          {{-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 TimeSendMenssage">
                           <p>6H</p>
                          </div> --}}
                        </a>
                      @endif
                    @endforeach
                  </div>

                @endif
            @endforeach

        </div>

        {{-- BLOQUE CALENDAR --}}
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 listConection lineChat">
        {{-- CAPTION USER LIVES --}}
        <div class="captionUsersInLive">
          <div class="ui accordion">
            <h3 class="fontMiriamProRegular"><span class='estusLive'>•</span>En Linea</h3>
            <div class="title">
              <p class="gasper"> {{ $banderaOnline = 0}}</p>
              @foreach($AllOnlineUser as $onlineUsers)
                <p class="gasper"> {{ $banderaOnline = $banderaOnline+1 }}</p>
                <div class="captionCircleUser captionDenoews AlluserReegitradosPorBloque">
                  <a href="#!" class="userLive" data-idonline="{{ $onlineUsers['id_user'] }}" data-iduserchat="{{ $onlineUsers['id_user'] }}"> 
                    <div class="label dataPrubeIm vloqImageUser dataProfileAllUsersOnline styRos6" style="background-image: {{ $onlineUsers['foto'] }}"> 
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
            <div class="content">
              @foreach($AllOnlineUser as $onlineUsers)
                <p class="gasper"> {{ $banderaOnline = $banderaOnline+1 }}</p>                  
                @if($banderaOnline >= 4 )
                  <div class="captionCircleUser captionDenoews AlluserReegitradosPorBloque">
                    <a href="#!" class="userLive" data-idonline="{{ $onlineUsers['id_user'] }}" data-iduserchat="{{ $onlineUsers['id_user'] }}"> 
                      <div class="label dataPrubeIm vloqImageUser dataProfileAllUsersOnline styRos6" style="background-image: {{ $onlineUsers['foto'] }}"> 
                      </div>
                    </a>
                  </div>
                @endif
              @endforeach
            </div>
          </div>
        </div>

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ChatListAllUser">
            {{-- FILTAR BUISQUEDA --}}
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 SearchSection">
              <form action="" class="formSearchChat">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="input-group">
                      <input id="filtrar" type="text" class="form-control" >
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
              </form>
            </div>

              {{-- CHATS ALLS --}}
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 AlluserReegitrados columnChatss">

              @foreach($getUsers as $users)
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 AlluserReegitradosPorBloque">
                  <a href="#!" data-iduserchat="{{ $users->id_usuario }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 vloqImageUser">
                      <p class="gasper">{{ $GetImage  = \Storage::disk('ubUploadsChange')->get('/profiles/'.$users->foto.'') }}</p>
                      <div class="label dataPrubeIm dataProfileAllUsersListChat" style="background-image: url('data:{{ $users->mime }};base64,{{ base64_encode($GetImage) }}')"></div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 blqueDatasUser">
                      <p class="colorBlack fontMiriamProSemiBold TitleUserMen">{{ $users->name }}</p>
                    </div>             
                  </a>                
                </div>  
              @endforeach  

            </div>

            
          </div>

          <div class="col-md-12 datPublich">
            <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/IcoPublich.png" alt="" data-toggle="modal" data-target="#myModal">
            {{-- <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/chatGrupo.png" alt="" data-toggle="modal" data-target="#myModalCHat"> --}}
          </div>


        </div>
        
      </div>
    </div>

    </div>

    <!-- Modal -->
    @include('usuarios.partials.field-public-post')

    <!-- Modal chat -->
    <div class="modal fade" id="myModalCHat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog contPusblishDialogo" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="col-xs-12 col-sm-12 col-md-12 continPublish publichChat">
              <form action="home_submit" method="get" class="sectionPublichUser" accept-charset="utf-8">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionCreateCHat">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 selectActtions max example">
                    <select name="skills" multiple="" class="ui fluid dropdown">
                      <option value="">Agregar usuarios +</option>
                      <option value="angular">Angular</option>
                      <option value="css">CSS</option>
                      <option value="design">Graphic Design</option>
                      <option value="ember">Ember</option>
                      <option value="html">HTML</option>
                      <option value="ia">Information Architecture</option>
                      <option value="javascript">Javascript</option>
                      <option value="mech">Mechanical Engineering</option>
                      <option value="meteor">Meteor</option>
                      <option value="node">NodeJS</option>
                      <option value="plumbing">Plumbing</option>
                      <option value="python">Python</option>
                      <option value="rails">Rails</option>
                      <option value="react">React</option>
                      <option value="repair">Kitchen Repair</option>
                      <option value="ruby">Ruby</option>
                      <option value="ui">UI Design</option>
                      <option value="ux">User Experience</option>
                    </select>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 selectActtions max example">
                    <select name="skills" multiple="" class="ui fluid dropdown">
                      <option value="">Agregar por áreas</option>
                      <option value="angular">Angular</option>
                      <option value="css">CSS</option>
                      <option value="design">Graphic Design</option>
                      <option value="ember">Ember</option>
                      <option value="html">HTML</option>
                      <option value="ia">Information Architecture</option>
                      <option value="javascript">Javascript</option>
                      <option value="mech">Mechanical Engineering</option>
                      <option value="meteor">Meteor</option>
                      <option value="node">NodeJS</option>
                      <option value="plumbing">Plumbing</option>
                      <option value="python">Python</option>
                      <option value="rails">Rails</option>
                      <option value="react">React</option>
                      <option value="repair">Kitchen Repair</option>
                      <option value="ruby">Ruby</option>
                      <option value="ui">UI Design</option>
                      <option value="ux">User Experience</option>
                    </select>
                  </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                  <textarea name="" placeholder="Escribe un comentario"></textarea>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 bloquesActions">
                  <div class="col-md-6 actionpuBlish">
                    <div class="col-md-2 Adjuntar">
                      <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/adjuntarIco.png" alt="">
                    </div>
                    <div class="col-md-2 AdjuntarFoto">
                      <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/adjuntarFoto.png" alt="">
                    </div>
                    <div class="col-md-2 DestacarPuslish">
                      <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/destacarIco.png" alt="">
                    </div>
                    <div class="col-md-2 AlertPublish">
                      <img class="img-responsive" src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/avatar/alertIco.png" alt="">
                    </div>
                  </div>
                  <div class="col-md-6 ButtinPublish">
                    <input type="submit" value="Enviar"></input>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="alert alert-info dataClMoPosPEr" role="alert">¡Publicacion Agregada!</div>
{{-- Mensajes entrada salida --}}
@include('usuarios.partials.fields-entrada-salida-mensajes')

@endsection
