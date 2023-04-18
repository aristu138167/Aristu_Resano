<?php

namespace App\Infrastructure\Controllers;

use App\Application\UserDataSource\UserDataSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Psy\Util\Str;

class GetEarlyAdopterController extends BaseController
{
    private  UserDataSource $userDataSource;

    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource=$userDataSource;
    }

    public function __invoke(String $email): JsonResponse
    {
        $user=$this->userDataSource->findByEmail($email);
        if(is_null($user)){
            return response()->json([
                'error' => 'usuario no encontrado',
            ], 404);
        }
        else{
            $id= $user->getId();
            if ($id<1000){
                return response()->json([
                    'El usuario es early adopter',
                ], 200);
            }
            else{
                return response()->json([
                    'El usuario no es early adopter',
                ], 200);
            }
        }
    }
}
