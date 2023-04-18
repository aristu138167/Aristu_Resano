<?php

namespace App\Infrastructure\Controllers;

use App\Application\UserDataSource\UserDataSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Psy\Util\Str;

class GetGlobalProviderUsersController extends BaseController
{
    private  UserDataSource $userDataSource;

    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource=$userDataSource;
    }

    public function __invoke(): JsonResponse
    {
        $users=$this->userDataSource->getAll();
        //return response()->
        if(is_null($users)){
            return response()->json([], 200);
        }
        else{
            $array=array();
            foreach ($users as $user){
                if(strpos($user->getEmail(),"@gmail.") or strpos($user->getEmail(),"@hotmail.")){
                    $respuesta = [
                        'id' => $user->getId(),
                        'email' => $user->getEmail()
                    ];
                    array_push($array, $respuesta);
                }
            }
            return response()->json($array, 200);
        }

    }
}
