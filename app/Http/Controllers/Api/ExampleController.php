<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
       // GET /api/example
       public function index()
       {
           return response()->json([
               'message' => 'data berhasil diambil',
               'data' => [
                   'contoh1',
                   'contoh2',
                   'contoh3'
               ]
           ]);
       }
    //
    public function store(Request $request)
    {
        return response()->json([
            'message' => 'berhasil'
        ]);
    }
}
