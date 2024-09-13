<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Upload extends Model
{
    use HasFactory;
    use HasUuids;
    protected $table = 'upload';
    protected $guarded = ['id'];
}
