<?php

namespace App\Http\Controllers;

use App\Models\DetailDiagnosisResult;
use App\Models\DetailQuestion;
use App\Models\HeaderDiagnosisResult;
use App\Models\HeaderQuestion;
use Illuminate\Http\Request;

class HeaderDiagnosisResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headerDiagnosisResults = HeaderDiagnosisResult::orderBy('result_date')->paginate(20);
        return view('diagnosis_result.index', compact('headerDiagnosisResults'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HeaderDiagnosisResult $headerDiagnosisResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeaderDiagnosisResult $headerDiagnosisResult)
    {
        //
    }

    public function fetch_detail_diagnosis_result_by_hdr_id(Request $request)
    {
        if($request->ajax()){
            $detailDiagnosisResults = DetailDiagnosisResult::where('hdr_id', $request->hdr_id)->get();
            return response()->json($detailDiagnosisResults);
        }
    }

}
