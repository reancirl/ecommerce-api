<?php

declare(strict_types=1);

namespace App\Http\Responses;

use App\Models\User;
use App\Traits\HttpResponses;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{
    use HttpResponses;

    public function toResponse($request): Response
    {
        return $request->wantsJson()
                    ? $this->success([
                    ],'Logged out successfully!')
                    : redirect()->intended(Fortify::redirects('login'));
    }
}