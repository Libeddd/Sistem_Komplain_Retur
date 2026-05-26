<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'complaint_code',
        'user_id',
        'order_number',
        'product_name',
        'damage_category',
        'description',
        'refund_method',
        'proof_image_path',
        'unboxing_video_path',
        'status',
        'completed_at',
        'nomor_resi',
        'resi_at',
        'bukti_transfer_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
