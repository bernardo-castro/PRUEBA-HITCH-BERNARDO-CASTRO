<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BonusController extends Controller
{
    /**
     * @OA\Get(
     *     path="/punto-extra",
     *     summary="Consumir API externa JSONPlaceholder",
     *     @OA\Response(response="200", description="Muestra los usuarios de la API externa"),
     * )
     */
    public function index()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/users');
        $users = $response->json();
        
        return view('payments.bonus', compact('users'));
    }
}
