<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeaderQuestion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'hdq_id';
    public $incrementing = false; 
    protected $fillable = ['hdq_name', 'hdq_sequence', 'is_active'];

    protected $dates = ['is_deleted'];
    const DELETED_AT = 'is_deleted';

    protected static function boot(){
        parent::boot();

        static::creating(function ($obj) {
            $lastHdqID = HeaderQuestion::select('hdq_id')->withTrashed()->orderBy('hdq_id','desc')->first()?->hdq_id ?? 0;
            if($lastHdqID !== 0){
                $lastHdqID= (int) substr($lastHdqID , -3);
            }
            $newHdqID = (string) sprintf("hdq%'.04d", $lastHdqID + 1);
            $obj->hdq_id = $newHdqID;
            $obj->create_operator = auth()->user()->getAuthIdentifier();
            // $obj->save();
        });

        static::updating(function($obj){
            $obj->last_operator = auth()->user()->getAuthIdentifier();
        });

        static::deleting(function($obj){
            HeaderQuestion::where('is_deleted', null)->where('hdq_id', $obj->hdq_id)
                        ->update([
                            'last_operator'=> auth()->user()->getAuthIdentifier(),
                            'hdq_sequence'=> -1,
                            'is_active'=> 'F'
                        ]);
        });
    }

}
