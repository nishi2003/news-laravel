<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller{
    /**
     * Display a listing of the resource.
     */
    // public function __construct()
    // {
    //     $this->middleware('Auth');
    // }

    public function index(Request $request)
    {
        // $query = Category::query();
        // if ($request->filled('search')) {
        //     $search = $request->search;
        //     $query->where('category', 'like', '%' . $search . '%');
        // }

        // if ($request->filled('sort_by') && $request->filled('sort_order')) {
        //     $query->orderBy($request->sort_by, $request->sort_order);
        // }

        // $category = $query->paginate(10);
        // return view('categories.list', [
        //     'category' => $category,
        // ]);
        $sort_by = $request->get('sort_by', 'id');
        $sort_order = $request->get('sort_order', 'asc');

        $categories = Category::orderBy($sort_by, $sort_order)->paginate(10);

        return view('categories.list', compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'category' => 'required|min:3'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('categories.create')->withInput()->withErrors($validator);
        }
        $category = new Category();
        $category->category = $request->category;

        $category->save();
        return redirect()->route('categories.index')->with('success', 'category added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $rules = [
            'category' => 'required|min:3'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('categories.edit', $category->id)->withInput()->withErrors($validator);
        }
        $category->category = $request->category;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        //delete category from database
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'category deleted successfully.');
    }
}
