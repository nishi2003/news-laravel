<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function list()
    {
        $news = News::select('id', 'title', 'description', 'image')
            ->where('published', '1')
            ->get();

        return response()->json($news);
    }

    public function show($id)
    {
        $news = News::where('id', $id)
                    ->where('published','1')
                    ->first();

        if (!$news) {
            return response()->json(['error' => 'News not found or not published'], 404);
        }

        return response()->json($news);
    }
}
