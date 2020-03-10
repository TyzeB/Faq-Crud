<?php

namespace App\Http\Controllers;

use App\FAQ;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list($category)
    {

        $faqs = FAQ::where('category_id', $category)->orderBy('id')->paginate(5);

        return response()->json(['faqs' => $faqs]);
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
        if (!$request->user()->tokenCan('add-faq')) {
            return response()->json(['error' => 'Unauthorized access.'], 401);
        }

        $validator = Validator::make($request->all(), [
            'question' => 'required|unique:f_a_q_s',
            'answer' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $faq = new FAQ();
        $faq->question = $request->question;
        $faq->answer = nl2br(e($request->answer));
        $faq->category_id = $request->category_id;
        $faq->published = Carbon::now();

        $faq->save();

        return response()->json(['faq' => $faq]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function show($fAQ)
    {
        $faq = FAQ::find($fAQ);
        return response()->json(['faq' => $faq]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function edit(FAQ $fAQ)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fAQ)
    {
        if (!$request->user()->tokenCan('add-faq')) {
            return response()->json(['error' => 'Unauthorized access.'], 401);
        }

        $validator = Validator::make($request->all(), [
            'question' => 'required|unique:f_a_q_s',
            'answer' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $faq = FAQ::find($fAQ);
        $faq->update($request->all());

        return response()->json(['faq' => $faq]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function destroy($fAQ)
    {
        $faq = FAQ::find($fAQ);
        $faq->delete();

        return response()->json(['success' => 'deleted']);
    }
}
