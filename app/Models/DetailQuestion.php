<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailQuestion extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $primaryKey = 'dtq_id';
    public $incrementing = false; 
    protected $fillable = ['dtq_name', 'dtq_sequence', 'score', 'hdq_id'];

    protected $dates = ['is_deleted'];
    const DELETED_AT = 'is_deleted';

    protected static function boot(){
        parent::boot();

        static::creating(function ($obj) {
            $lastDtqID = DetailQuestion::select('dtq_id')->orderBy('dtq_id','desc')->first()?->dtq_id ?? 0;
            if($lastDtqID !== 0){
                $lastDtqID= (int) substr($lastDtqID , -3);
            }
            $newDtqId = (string) sprintf("dtq%'.04d", $lastDtqID + 1);
            $obj->dtq_id = $newDtqId;
            $obj->create_operator = auth()->user()->getAuthIdentifier();
        });

        static::updating(function($obj){
            $obj->last_operator = auth()->user()->getAuthIdentifier();
        });

        static::deleting(function($obj){
            HeaderQuestion::where('is_deleted', null)->where('dtq_id', $obj->dtq_id)
                        ->update([
                            'last_operator'=> auth()->user()->getAuthIdentifier(),
                            'dtq_sequence'=> -1,
                            'score'=> -1,
                            'is_active'=> 'F'
                        ]);
        });
    }
}
