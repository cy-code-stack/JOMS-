<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job_request extends Model
{
    use HasFactory;
    public $timestamps=false;

    public function customer()
    {
        return $this->belongsTo(customers_list::class);
    }

    public function techList()
    {
        return $this->belongsTo(technician_list::class,'technician_id');
    }
    
     public function accomplishment()
    {
        return $this->hasOne(accomplishment_report::class);
    }

}
