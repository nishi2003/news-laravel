<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function list()
    {
        $newsList = News::select('id', 'title', 'description', 'image')
            ->get();

        return response()->json($newsList);
    }

    public function show($id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['error' => 'News not found'], 404);
        }

        return response()->json($news);
    }
}

