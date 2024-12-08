<?php

namespace App\Models;

use App\Models\Cars;
use App\Models\DailyFactures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyFacturesItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'facture_id',
        'cars_id',
        'reservation_id',
        'price',
        'is_price',
        'description',
        'date',
    ];

    /**
     * Get the facture that owns the facture item.
     */
    public function facture()
    {
        return $this->belongsTo(DailyFactures::class,'facture_id');
    }

    /**
     * Get the car associated with the facture item.
     */
    public function car()
    {
        return $this->belongsTo(Cars::class, 'cars_id');
    }
}
