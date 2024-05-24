<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class technician_list extends Model
{
    use HasFactory;
    public $timestamps=false;

    public function jobReq()
    {
        return $this->hasMany(job_request::class);
    }

}
