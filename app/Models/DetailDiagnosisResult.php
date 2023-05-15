<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDiagnosisResult extends Model
{
    use HasFactory;
    
    protected $table = 'detail_diagnosis_result';
    protected $primaryKey = 'ddr_id';
    public $incrementing = false; 
    protected $fillable = ['hdr_id', 'hdq_id', 'dtq_id', 'score'];

    protected static function boot(){
        parent::boot();

        static::creating(function ($obj) {
            $lastDdrID = DetailDiagnosisResult::select('ddr_id')->orderBy('ddr_id','desc')->first()?->ddr_id ?? 0;
            if($lastDdrID !== 0){
                $lastDdrID= (int) substr($lastDdrID , -3);
            }
            $newDdrID = (string) sprintf("ddr%'.04d", $lastDdrID + 1);
            $obj->ddr_id = $newDdrID;
            $obj->create_operator = auth()->user()->getAuthIdentifier();
            $obj->user_id = auth()->user()->getAuthIdentifier();
            // $obj->save();
        });

    }

}
