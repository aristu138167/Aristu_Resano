<?php

namespace App\Infrastructure\Controllers;

use App\Application\UserDataSource\UserDataSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Psy\Util\Str;

class GetUserController extends BaseController
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
            return response()->json([
                'id' => $user->getId(),
                'email'=> $user->getEmail()
            ], 200);
        }
    }
}
