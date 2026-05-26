<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redis;

use Illuminate\Http\Request;

class VisitController extends Controller
{
    //
    public function setLastVisit(Request $request)
    {
        $sessionId = $request->session()->getId();

        $data = [
            'time' => now()->toDateTimeString(),
            'ip' => $request->ip(),
        ];

        Redis::set(
            "user:last_visit:$sessionId",
            json_encode($data)
        );

        return response()->json([
            'message' => 'Last visit saved',
            'data' => $data
        ]);
    }

    // =========================
    // GET LAST VISIT
    // =========================
    public function getLastVisit(Request $request)
    {
        $sessionId = $request->session()->getId();

        $data = Redis::get("user:last_visit:$sessionId");

        if (!$data) {
            return response()->json([
                'message' => 'No visit data found (first visit)',
                'data' => null
            ]);
        }

        return response()->json([
            'message' => 'Last visit found',
            'data' => json_decode($data, true)
        ]);
    }
}
