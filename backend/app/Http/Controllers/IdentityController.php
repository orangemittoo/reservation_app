<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class IdentityController extends Controller
{
    public function __invoke()
    {
        return [
            'user' => Auth::user()
        ];
    }
}
