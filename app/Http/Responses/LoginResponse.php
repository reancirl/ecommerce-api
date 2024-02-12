<?php

declare(strict_types=1);

namespace App\Http\Responses;

use App\Models\User;
use App\Traits\HttpResponses;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    use HttpResponses;

    public function toResponse($request): Response
    {
        $user = User::where('email',$request->email)->select('name','email')->first();
        $token = $request->user()->createToken('API Token');
        return $request->wantsJson()
                    ? $this->success([
                        'token' => $token->plainTextToken,
                        'user' => $user
                    ],'Logged in successfully!')
                    : redirect()->intended(Fortify::redirects('login'));
    }
}