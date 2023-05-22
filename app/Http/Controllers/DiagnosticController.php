<?php

namespace App\Http\Controllers;

use App\Models\DetailDiagnosisResult;
use App\Models\DetailQuestion;
use App\Models\HeaderDiagnosisResult;
use App\Models\HeaderQuestion;
use App\Models\MappingDiagnosisScore;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{

    /* 
    * Show the diagnostic page
    */
    public function show_diagnostic_page()
    {
        $headerQuestions = HeaderQuestion::orderBy('hdq_sequence', 'ASC')->where('is_active', 'T')->get();
        $detailQuestions = DetailQuestion::all();
        // $detailQuestions = DetailQuestion::where('is_active', 'T')->
        return view('test-diagnosis.index', compact('headerQuestions', 'detailQuestions'));
    }

    /*  
    * Store the diagnostic result
    */
    public function store_diagnostic_result(Request $request)
    {
        $mapdsIdResult = $this->store_all_diagnosis_result_to_db($request);
        $mappingDiagnosisResult = MappingDiagnosisScore::findOrFail($mapdsIdResult)->first(); 

        return back()->with('success', json_encode($mapdsIdResult));
    }

    private function store_all_diagnosis_result_to_db(Request $request)
    {
        $requestDtqIds = collect($request->except('_token'))->values();
        $chosenDetailQuestions = DetailQuestion::whereIn('dtq_id', $requestDtqIds)
        ->get(array('dtq_id', 'hdq_id', 'score'));
        
        $arrayResult = $this->store_header_diagnosis_result($chosenDetailQuestions);
        $this->store_detail_diagnosis_result($chosenDetailQuestions, $arrayResult['hdr_id']);

        return $arrayResult['mapds_id'];
    }

    private function store_header_diagnosis_result(Collection $chosenDetailQuestions)
    {        
        $totalScore = 0;
        $totalScore = $chosenDetailQuestions->sum('score');
        $mapDiagnosisResult = MappingDiagnosisScore::where('min_score', '<=', $totalScore)
            ->where('max_score', '>=', $totalScore)
            ->where('is_active', 'T')
            ->get();
        $savedHeaderDiagnosisResult = HeaderDiagnosisResult::create([
            'result_score'=>$totalScore,
            'mapds_id'=>$mapDiagnosisResult->mapds_id
        ]);

        $arrayResult = array('mapds_id'=>$mapDiagnosisResult->mapds_id,
                            'hdr_id'=>$savedHeaderDiagnosisResult->hdr_id);

        return $arrayResult;
    }

    private function store_detail_diagnosis_result(Collection $chosenDetailQuestions, string $hdr_id)
    {
        $chosenDetailQuestions->each(function ($detail) use ($hdr_id) {
            $detailDiagnosisResult = new DetailDiagnosisResult([
                'dtq_id' => $detail->dtq_id,
                'hdq_id' => $detail->hdq_id,
                'score' => $detail->score,
                'hdr_id' => $hdr_id,
            ]);
    
            $detailDiagnosisResult->save();
        });
    }
}
