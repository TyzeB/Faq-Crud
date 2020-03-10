<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppController extends Controller
{
    function getCsrfToken()
    {
        return csrf_token();
    }
}
