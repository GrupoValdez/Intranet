<form action="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/search_users" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 formSearch" method="post" accept-charset="utf-8">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <i class="fa fa-search" aria-hidden="true"></i>
    <input type="text" name="user_search" placeholder="Buscar por nombre de usuario">
  </div>
</form>