<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Offer;

class OfferItems extends Model
{
    use HasFactory;

    protected $table = 'offer_items';

    protected $casts = [
        'images' => 'array',
    ];

    protected $fillable = [
        'offer_id',
        'cid',
        'square',
        'complex',
        'house',
        'description',
        'images',
        'like',
    ];

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }
}
