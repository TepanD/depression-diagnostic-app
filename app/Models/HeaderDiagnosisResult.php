<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HeaderDiagnosisResult extends Model
{
    use HasFactory;

    protected $table = 'header_diagnosis_result';
    protected $primaryKey = 'hdr_id';
    public $incrementing = false; 
    protected $fillable = ['result_score', 'mapds_id'];

    protected static function boot(){
        parent::boot();

        static::creating(function ($obj) {
            $lastHdrID = HeaderDiagnosisResult::select('hdr_id')->orderBy('hdr_id','desc')->first()?->hdr_id ?? 0;
            if($lastHdrID !== 0){
                $lastHdrID= (int) substr($lastHdrID , -3);
            }
            $newHdrID = (string) sprintf("hdr%'.04d", $lastHdrID + 1);
            $obj->hdr_id = $newHdrID;
            $obj->create_operator = auth()->user()->getAuthIdentifier();
            $obj->user_id = auth()->user()->getAuthIdentifier();
            $obj->user_name = auth()->user()->name;
            $obj->result_date = DB::raw('CURRENT_TIMESTAMP');
            // $obj->save();
        });

    }

}
