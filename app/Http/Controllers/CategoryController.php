<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $categories = Category::orderBy('id')->get();

        return response()->json(['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->user()->tokenCan('add-category')) {
            return response()->json(['error' => 'Unauthorized access.'], 401);
        }

        $validator = Validator::make($request->all(), [
            'category' => 'required|min:3|max:50|unique:categories'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = new Category();
        $category->category = $request->category;
        $category->save();

        return response()->json(['category' => $category]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json(['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if (!$request->user()->tokenCan('edit-category')) {
            return response()->json(['error' => 'Unauthorized access.'], 401);
        }

        $validator = Validator::make($request->all(), [
            'category' => 'required|min:3|max:50|unique:categories'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category->category = $request->category;
        $category->save();

        return response()->json(['category' => $category]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['success' => 'deleted']);
    }
}
