<?php

namespace App\Http\Controllers;

use App\Models\DetailDiagnosisResult;
use App\Models\DetailQuestion;
use App\Models\HeaderDiagnosisResult;
use App\Models\HeaderQuestion;
use App\Models\MappingDiagnosisScore;
use Dompdf\Adapter\PDFLib;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PDF;

class DiagnosticController extends Controller
{
    

    /* 
    * Show the diagnostic page
    */
    public function show_diagnostic_page()
    {
        if(!session('is_read')){
            session(['is_read' => "false"]);
        }
        $headerQuestions = HeaderQuestion::orderBy('hdq_sequence', 'ASC')->where('is_active', 'T')->get();
        $detailQuestions = DetailQuestion::all();
        return view('diagnosis.index', compact('headerQuestions', 'detailQuestions'));
        //return view('test-diagnosis.index', compact('headerQuestions', 'detailQuestions'));
    }

    /*  
    * Store the diagnostic result
    */
    public function store_diagnostic_result(Request $request)
    {
        $arrayResult = $this->store_all_diagnosis_result_to_db($request);
        $mapdsIdResult = $arrayResult['mapds_id'];
        $totalScore = $arrayResult['total_score'];
        $mappingDiagnosisResult = MappingDiagnosisScore::findOrFail($mapdsIdResult); 
        $mappingDiagnosisResult->setAttribute('total_score', $totalScore);

        return back()->with('result', json_encode($mappingDiagnosisResult));
    }

    private function store_all_diagnosis_result_to_db(Request $request)
    {
        $requestDtqIds = collect($request->except('_token'))->values();
        $chosenDetailQuestions = DetailQuestion::whereIn('dtq_id', $requestDtqIds)
        ->get(array('dtq_id', 'hdq_id', 'score'));
        
        $arrayResult = $this->store_header_diagnosis_result($chosenDetailQuestions);
        $this->store_detail_diagnosis_result($chosenDetailQuestions, $arrayResult['hdr_id']);

        $this->generate_pdf($arrayResult['hdr_id'], $arrayResult['total_score']);

        return $arrayResult;
    }

    private function store_header_diagnosis_result(Collection $chosenDetailQuestions)
    {        
        $totalScore = 0;
        $totalScore = $chosenDetailQuestions->sum('score');
        
        $mapDiagnosisResult = MappingDiagnosisScore::where('min_score', '<=', $totalScore)
            ->where('max_score', '>=', $totalScore)
            ->where('is_active', 'T')
            ->first();

        $savedHeaderDiagnosisResult = HeaderDiagnosisResult::create([
            'result_score'=>$totalScore,
            'mapds_id'=>$mapDiagnosisResult->mapds_id
        ]);
        
        $arrayResult = array('mapds_id'=>$mapDiagnosisResult->mapds_id,
                            'hdr_id'=>$savedHeaderDiagnosisResult->hdr_id,
                            'total_score'=>$totalScore);

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

    public function demo_diagnostic_page(){
        $headerQuestions = HeaderQuestion::orderBy('hdq_sequence', 'ASC')->where('is_active', 'T')->get();
        $detailQuestions = DetailQuestion::all();
        return view('admin.test-diagnosis.index', compact('headerQuestions', 'detailQuestions'));
    }

    public function store_instruction_read_session(Request $request){
        if($request->ajax()){
            session(['is_read' => 'true']);
            echo "berhasil push session";
        }
    }

    public function generate_pdf($hdrId, $totalScore){
        $path = '/result_pdf/'.auth()->user()->getAuthIdentifier();
        Storage::deleteDirectory($path);
        Storage::makeDirectory($path);

        $detailDiagnosisResults = DetailDiagnosisResult::select('detail_diagnosis_result.score', 'header_questions.hdq_name', 'header_questions.hdq_sequence', 'detail_questions.dtq_name')
                                        ->leftJoin('header_questions', 'detail_diagnosis_result.hdq_id', '=', 'header_questions.hdq_id')
                                        ->leftJoin('detail_questions', 'detail_diagnosis_result.dtq_id', '=', 'detail_questions.dtq_id')
                                        ->where('hdr_id', $hdrId)
                                        ->get();

        $data = [
            'date'=> date('d-m-Y'),
            'user'=> auth()->user(),
            'detailDiagnosisResult' => $detailDiagnosisResults,
            'totalScore' => $totalScore
        ];

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('result_pdf.result_pdf', $data);
        $file = $pdf->output();
        Storage::put($path.'/questionnaire_result.pdf', $file);
    }

    public function download_pdf(){
        return Storage::download('/result_pdf/'.auth()->user()->getAuthIdentifier().'/questionnaire_result.pdf');
    }
}
