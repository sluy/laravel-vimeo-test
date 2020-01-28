<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class VimeoController extends Controller
{
    public function index()
    {
        return response()->json([
            [
                'name' => 'hola',
                'status' => true,
            ],
        ]);
    }
}
