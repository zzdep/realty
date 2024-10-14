<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\OfferItems;
use App\Models\User;
use App\Models\UsersAuthMobile;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $u = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        UsersAuthMobile::create([
            'bearer' => UsersAuthMobile::createToken(),
            'users_id' => $u->id,
        ]);

        Offer::factory()->count(10)->create();

        OfferItems::factory()->count(50)->create();
    }
}
