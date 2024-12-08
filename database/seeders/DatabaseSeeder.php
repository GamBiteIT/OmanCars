<?php

namespace Database\Seeders;

use App\Models\Cars;
use App\Models\User;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $account = Account::create(['name' => 'Oman Cars']);

        User::factory()->create([
            'account_id' => $account->id,
            'first_name' => 'Oman',
            'last_name' => 'Cars',
            'email' => 'admin@omancars.co',
            'password' => '123456789',
            'owner' => true,
        ]);

        User::factory()->create([
            'account_id' => $account->id,
            'first_name' => 'Saber',
            'last_name' => 'Noah',
            'email' => 'saber@omancars.co',
            'password' => '123456789',
            'owner' => true,
        ]);

        Cars::factory()->create([
'brand' => 'Toyota',
'model' => 'Corolla',
'registration_number'   => 'OMC-1234',
'year' => 2020,
'color' => 'Red',
'price_per_day'  => 20000,
'price_per_month'  => 60000,
'price_per_week'  => 720000,
'km_day'   => 200,
'km_week'  => 1000,
'km_month' => 4000,
'rent_out_price'=>500,
'account_id' => $account->id,

        ]);


        $organizations = Organization::factory(100)
            ->create(['account_id' => $account->id]);

        Contact::factory(100)
            ->create(['account_id' => $account->id])
            ->each(function ($contact) use ($organizations) {
                $contact->update(['organization_id' => $organizations->random()->id]);
            });
    }
}
