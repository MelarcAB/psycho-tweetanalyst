<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Atymic\Twitter\Facade\Twitter;
use App\Models\Gpt;

class HomeController extends Controller
{
    //
    function index()
    {

        $test = "hola";
        return view('app', ['test' => $test]);
    }
}
