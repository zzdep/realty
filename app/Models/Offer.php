<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\OfferItems;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offer';
    public $timestamps = true;

    protected $fillable = [
        'uuid',
        'b24_contact_id',
        'b24_deal_id',
        'b24_manager_id',
        'manager',
        'position',
        'phone',
        'avatar',
        'status',
        'date_end',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OfferItems::class);
    }
}
