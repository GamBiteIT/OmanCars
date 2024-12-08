<?php

namespace App\Models;

use App\Models\Cars;
use App\Models\DailyFacturesItems;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Cars::class);
    }
    public function dailyfactures(): HasMany
    {
        return $this->hasMany(Dailyfactures::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(DailyFacturesItems::class);
    }
}
