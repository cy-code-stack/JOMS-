<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accomplishment_report extends Model
{
    use HasFactory;
    public $timestamps=false;

    public function jobReq()
    {
        return $this->belongsTo(job_request::class,'job_id');
    }

}
