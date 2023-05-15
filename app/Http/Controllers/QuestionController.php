<?php

namespace App\Http\Controllers;

use App\Http\Requests\HeaderQuestionRequest;
use App\Models\DetailQuestion;
use App\Models\HeaderQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headerQuestions = HeaderQuestion::all();

        return view('questions.index', compact('headerQuestions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HeaderQuestionRequest $request)
    {
        $duplicate = HeaderQuestion::where('hdq_sequence', $request->input('hdq_sequence'))
                        ->where('is_active', 'T')->count();

        if($duplicate > 0){
            return back()->withInput()->with('error', 'sequence already exists');
        }

        HeaderQuestion::create([
            'hdq_name'=>$request->input('hdq_name'),
            'hdq_sequence'=>$request->input('hdq_sequence'),
            'is_active'=>$request->has('is_active')? "T" : "F"
        ]);

        return redirect()->route('questions.index')->with('success', 'HeaderQuestion created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $hdq_id)
    {
        $headerQuestion = HeaderQuestion::findOrFail($hdq_id);
        return view('questions.edit', compact('headerQuestion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HeaderQuestionRequest $request, string $hdq_id)
    {
        $headerQuestion = HeaderQuestion::findOrFail($hdq_id);

        $duplicate = HeaderQuestion::where('hdq_sequence', $request->input('hdq_sequence'))
        ->where('is_active', 'T')->whereNot('hdq_id', $hdq_id)->count();

        if($duplicate > 0){
            return back()->withInput()->with('error', 'sequence already exists');
        }

        $headerQuestion->update([
            'hdq_name'=>  $request->input('hdq_name'),
            'hdq_sequence'=>  $request->input('hdq_sequence'),
            'is_active'=> $request->has("is_active") == true ? 'T' : 'F'
        ]);

        return redirect()->route('questions.index')->with('success', 'HeaderQuestion updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $headerQuestion = HeaderQuestion::find($request->input('hidHdqID'));
        //pake softdelete di modelnya.
        $headerQuestion->delete();

        return back()->with('success', 'Header Question deleted successfully.');
    }

    /**
     * Get detail question by hdq_id
     */
    public function fetch_detail_question(Request $request) 
    {
        if($request->ajax()){
            $detailQuestions = DetailQuestion::where('hdq_id', $request->hdq_id)->get();
            return response()->json($detailQuestions);
        }
    }

    /**
     * Crete detail question
     */
    public function store_detail_question(Request $request) 
    {
        if($request->ajax()){
            $detailQuestion = array(
                'dtq_name'=> $request->dtq_name,
                'dtq_sequence'=> $request->dtq_sequence,
                'score'=> $request->score,
                'hdq_id'=>$request->hdq_id,
            );
            DetailQuestion::create($detailQuestion);
            echo 'DetailQuestion created';
        }
    }

    /**
     * Update detail question
     */
    public function update_detail_question(Request $request) 
    {
        if($request->ajax()){
            $detailQuestion = array(
                $request->column_name=> $request->column_value
            );

            DetailQuestion::where('dtq_id', $request->dtq_id)->update($detailQuestion);
            echo 'DetailQuestion updated';
        }
    }

    /**
     * delete detail question
     */
    public function destroy_detail_question(Request $request) 
    {
        if($request->ajax()){
            DetailQuestion::where('dtq_id', $request->dtq_id)->delete();
            echo 'DetailQuestion deleted';
        }
    }
}
