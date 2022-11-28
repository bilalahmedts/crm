<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMUSale extends Model
{
    use HasFactory;
    protected $table = 'cmu_sales';
    protected $fillable = ['hrms_id','project_code','count'];
}
