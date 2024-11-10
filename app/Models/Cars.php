<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cars extends Model
{
    use HasFactory;
    protected $fillable = ['brand','model','registration_number','color','year','price_per_day','price_per_week','price_per_month','km_day','km_week','km_month','rent_out_price','photo_path'];


    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }


    public function scopeOrderByName($query)
    {
        $query->orderBy('name');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('brand', 'like', '%'.$search.'%')->orWhere('model', 'like', '%'.$search.'%')->orWhere('registration_number', 'like', '%'.$search.'%')
                    ->orWhere('year', 'like', '%'.$search.'%');
            });
    });
}}
