<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relative extends Model
{
    use HasFactory;
    public $timestamps=false;
    public $table="relative";
    public $primaryKey="relative_id";
}
