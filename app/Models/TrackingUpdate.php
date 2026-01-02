<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'status',
        'location',
        'notes',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
