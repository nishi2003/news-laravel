<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\AddnewsMail;

class NewsController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request)
    {
        $query = News::query();

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('sort_by') && $request->filled('sort_order')) {
            $query->orderBy($request->sort_by, $request->sort_order);
        } else {
            // Default sorting
            $query->orderBy('created_at', 'desc');
        }

        $news = $query->paginate(10);
        $categories = Category::all();

        return view('news.list', compact('news', 'categories', 'request'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|min:3',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|min:5',
            'author' => 'required|min:3',
            'tag' => 'required|min:3',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('news.create')->withInput()->withErrors($validator);
        }

        $news = new News();
        $news->title = $request->title;
        $news->category_id = $request->category_id;
        $news->description = $request->description;
        $news->author = $request->author;
        $news->tag = $request->tag;
        $news->published = $request->has('published') ? 1 : 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/news'), $imageName);
            $news->image = $imageName;
        }

        $news->save();

        // Send email to all users
        if ($news->published) {
            $users = User::all();
            foreach ($users as $user) {
                Mail::to($user->email)->send(new AddnewsMail($news));
            }
        }

        return redirect()->route('news.index')->with('success', 'News added successfully.');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        $categories = Category::all();
        return view('news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $rules = [
            'title' => 'required|min:3',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|min:5',
            'author' => 'required|min:3',
            'tag' => 'required|min:3',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('news.edit', $news->id)->withInput()->withErrors($validator);
        }

        $news->title = $request->title;
        $news->category_id = $request->category_id;
        $news->description = $request->description;
        $news->author = $request->author;
        $news->tag = $request->tag;
        $news->published = $request->has('published') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($news->image) {
                File::delete(public_path('uploads/news/' . $news->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/news'), $imageName);
            $news->image = $imageName;
        }

        $news->save();

        return redirect()->route('news.index')->with('success', 'News updated successfully.');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        if ($news->image) {
            File::delete(public_path('uploads/news/' . $news->image));
        }

        $news->delete();
        return redirect()->route('news.index')->with('success', 'News deleted successfully.');
    }

        public function show(Request $request, $id)
    {
        $news = News::findOrFail($id);
        $data = $news->toArray();

        // Check if 'key' exists in $data array to prevent error
        $value = $data['key'] ?? 'default_value'; // Safely access 'key'

        return view('news.show', compact('value'));
    }
    // public function show($id)
    // {
    //     // Attempt to find the news article by its ID
    //     $news = News::find($id);

    //     // Check if the news article exists
    //     if ($news) {
    //         // If the article exists, pass it to the view
    //         return view('news.show', ['news' => $news]);
    //     } else {
    //         // If the article doesn't exist, redirect with an error message
    //         return redirect()->route('news.index')->with('error', 'News article not found.');
    //     }
    // }
}
