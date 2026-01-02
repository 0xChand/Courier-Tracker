<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'tracking_number',
        'status',
        'package_weight',
        'sender_name',
        'receiver_name',
    ];

    public function request()
    {
        return $this->belongsTo(ShipmentRequest::class, 'request_id');
    }

    public function trackingUpdates()
    {
        return $this->hasMany(TrackingUpdate::class);
    }

    public function user()
    {
        return $this->request?->user();
    }
}
