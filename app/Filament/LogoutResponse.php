<?php

namespace App\Filament;

use Filament\Auth\Http\Responses\LogoutResponse as BaseLogoutResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LogoutResponse extends BaseLogoutResponse
{
    public function toResponse($request): RedirectResponse
    {
        // redirect ke login page custom
        return redirect()->route('login');
        // atau: return redirect('/login');
    }
}
