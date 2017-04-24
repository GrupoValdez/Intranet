<?php

namespace App\Http\Middleware;

use Closure;

class LogLastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}

/*$idUserlogiado = Auth::user()->id;
$getDataOnline = GetOnline::where('id_user_login','=',$idUserlogiado)->get();  

if(empty($getDataOnline)){
    
    $dataGetOnline = array(
     'id_user_login' => $idUserlogiado
    );
    $OnlineUserAdd = new GetOnline($dataGetOnline);  
    $OnlineUserAdd->save();
    return $next($request);
}else{
    $user = GetOnline::where('id_user_login','=',$idUserlogiado)->get();    
    $user->delete();
    return $next($request);
}*/