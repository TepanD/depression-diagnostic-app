<?php

namespace App\Http\Controllers;

use App\Http\Requests\MappingDiagnosisScoreRequest;
use App\Models\MappingDiagnosisScore;
use Illuminate\Http\Request;

class MappingDiagnosisScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mappingDiagnosisScores = MappingDiagnosisScore::all();
        return view('mapping_diagnosis_score.index',compact('mappingDiagnosisScores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mapping_diagnosis_score.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        MappingDiagnosisScore::create([
            'min_score'=>$request->input('min_score'),
            'max_score'=>$request->input('max_score'),
            'result_desc'=>$request->input('result_desc'),
            'result_addtional_desc'=>$request->input('result_addtional_desc'),
            'is_active'=>$request->has('is_active')? "T" : "F"
        ]);

        return redirect()->route('mapping-diagnosis-score.index')->with('success', 'Mapping score created');
    }

    /**
     * Display the specified resource.
     */
    public function show(MappingDiagnosisScore $mappingDiagnosisScore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $mapds_id)
    {
        $mappingDiagnosisScore = MappingDiagnosisScore::findOrFail($mapds_id);
        return view('mapping_diagnosis_score.edit', compact('mappingDiagnosisScore'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MappingDiagnosisScoreRequest $request, MappingDiagnosisScore $mappingDiagnosisScore)
    {
        $mappingDiagnosisScore->update([
            'min_score'=>  $request->input('min_score'),
            'max_score'=>  $request->input('max_score'),
            'result_desc'=> $request->input('result_desc'),
            'result_additional_desc'=> $request->input('result_additional_desc'),
            'is_active'=> $request->has("is_active") == true ? 'T' : 'F'
        ]);

        return redirect()->route('mapping-diagnosis-score.index')->with('success', 'Mapping updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $mappingDiagnosisScore = MappingDiagnosisScore::find($request->input('hidMapDiagId'));
        //pake softdelete di modelnya.
        $mappingDiagnosisScore->delete();

        return back()->with('success', 'Mapping deleted successfully.');
    }

    /**
     * Activate or deactivate a score mapping
     */
    public function update_mapds_is_active(Request $request)
    {
        if($request->ajax()){
            $mappingDiagnosisScore = MappingDiagnosisScore::findOrFail($request->mapds_id);

            $mappingDiagnosisScore->update([
                'is_active'=> $request->is_active
            ]);

            echo "is_active update success";
        }
    }
}
