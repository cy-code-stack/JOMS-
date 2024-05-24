<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers_list extends Model
{
    use HasFactory;
    public $timestamps=false;
    
    public function jobRequest()
    {
        return $this->hasOne(job_request::class);
    }
}
