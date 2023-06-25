<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;
    public $timestamps=false;
    public $table="disease";
    public $primaryKey="disease_id";
}
