<?php
declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Jānis Bērziņš',
            'email' => 'jb@gmail.com',
            'password' => '$2y$10$ASDrtjTtfXMDOUEgJ8FQH.Tbt/Xob6z6KwSiM8kvU09FnRPYjCcje',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Andris Krūmiņš',
            'email' => 'ak@gmail.com',
            'password' => '$2y$10$63UjKGkc4YzDnvC3NWJY4Os6U3KAQTmvd8ZNFAWVGQJYGGGAM5M3O',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('wallets')->insert([
            'id' => 1,
            'user_id' => 1,
            'name' => 'My wallet',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('wallets')->insert([
            'id' => 2,
            'user_id' => 2,
            'name' => 'My wallet',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('transactions')->insert([
            'id' => 1,
            'wallet_id' => 1,
            'description' => 'Wage',
            'amount' => 100000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('transactions')->insert([
            'id' => 2,
            'wallet_id' => 1,
            'description' => 'Lottery win',
            'amount' => 50000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('transactions')->insert([
            'id' => 3,
            'wallet_id' => 1,
            'description' => 'Train ticket',
            'amount' => -475,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('transactions')->insert([
            'id' => 4,
            'wallet_id' => 1,
            'description' => 'Grocery store',
            'amount' => -3350,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('transactions')->insert([
            'id' => 5,
            'wallet_id' => 2,
            'description' => 'Wage',
            'amount' => 50000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('transactions')->insert([
            'id' => 6,
            'wallet_id' => 2,
            'description' => 'Purchase',
            'amount' => -3350,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
