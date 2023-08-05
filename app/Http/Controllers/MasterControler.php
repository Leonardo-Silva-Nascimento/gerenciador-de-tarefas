<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Exceptions\JWTException;

class MasterControler extends Controller
{

    public function apiLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = Auth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciais inválidas'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Falha ao criar o token'], 500);
        }

        return response()->json(['token' => $token]);
    }

    public function getFunc(Request $request, $control = null, $action = null)
    {

        if(!is_Null($control) && !is_Null($action))
            $endpoint = $request->path();
        else
            $endpoint = '';

        if(stripos($endpoint, 'API/') !== false){

            if(!$this->apiLogin($request))
                return 'Falha na verificação de credencial!';


            // Receba os nomes da controladora e função como strings
            $controllerName = "App\Http\Controllers\\" . $control;
            
            // Chame a controladora e função dinamicamente
            return App::call("$controllerName@$action");

        }
        
        if(stripos($endpoint, 'controler/') !== false){

            // Receba os nomes da controladora e função como strings
            $controllerName = "App\Http\Controllers\\" . $control;
            
            // Chame a controladora e função dinamicamente
            return App::call("$controllerName@$action");

        }

        if(stripos($endpoint, 'view/') !== false){

            // Receba os nomes da controladora e função como strings
            $controllerName = "App\Http\Controllers\\" . $control;
            
            // Chame a controladora e função dinamicamente
            return App::call("$controllerName@$action");

        }
        
        $controllerName = "App\Http\Controllers\HomeController";
        $action = 'view';
        // Chame a home se não cair for para outra view
        return App::call("$controllerName@$action");

    }
}
