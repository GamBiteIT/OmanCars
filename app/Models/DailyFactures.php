<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyFactures extends Model
{
    use HasFactory;
    protected $fillable = ['date_facture','image'];

    public function items(): HasMany
    {
        return $this->hasMany(DailyFacturesItems::class, 'daily_factures_id');
    }
}
