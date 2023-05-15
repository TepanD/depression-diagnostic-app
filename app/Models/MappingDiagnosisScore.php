<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MappingDiagnosisScore extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'mapping_diagnosis_score';
    protected $primaryKey = 'mapds_id';
    public $incrementing = false; 
    protected $fillable = ['min_score', 'max_score', 'result_desc', 'result_additional_desc', 'is_active'];
    protected $dates = ['is_deleted'];
    const DELETED_AT = 'is_deleted';

    protected static function boot(){
        parent::boot();

        static::creating(function ($obj) {
            $lastMdsID = MappingDiagnosisScore::select('mapds_id')->withTrashed()->orderBy('mapds_id','desc')->first()?->mapds_id ?? 0;
            if($lastMdsID !== 0){
                $lastMdsID= (int) substr($lastMdsID , -3);
            }
            $newMdsID = (string) sprintf("mds%'.04d", $lastMdsID + 1);
            $obj->mapds_id = $newMdsID;
            $obj->create_operator = auth()->user()->getAuthIdentifier();
            
            // $obj->save();
        });

        // static::updating(function($obj){
        //     $obj->last_operator = auth()->user()->getAuthIdentifier();
        // });

        // static::deleting(function($obj){
        //     HeaderQuestion::where('is_deleted', null)->where('hdq_id', $obj->hdq_id)
        //                 ->update([
        //                     'last_operator'=> auth()->user()->getAuthIdentifier(),
        //                     'hdq_sequence'=> -1,
        //                     'is_active'=> 'F'
        //                 ]);
        // });
    }

}
