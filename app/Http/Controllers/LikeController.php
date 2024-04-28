<?php
namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use App\Http\Requests\UnlikeRequest;

class LikeController extends Controller
{
    public function like(LikeRequest $request)
    {
        $request->user()->like($request->likeable());

        if ($request->ajax()) {
            return response()->json([
                'likes' => $request->likeable()->likes()->count(),
            ]);
        }

        return redirect()->back();
    }

    public function unlike(UnlikeRequest $like)
    {
        $like->user()->unlike($like->likeable());

        if ($like->ajax()) {
            return response()->json([
                'likes' => $like->likeable()->likes()->count(),
            ]);
        }

        return redirect()->back();
    }
}

?>
