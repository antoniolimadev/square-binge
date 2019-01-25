<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

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
            [
                'name' => 'adminer',
                'email' => 'admin@squarebinge.com',
                'password' => bcrypt('adminer'),
            ],[
                'name' => 'betatester',
                'email' => 'beta@squarebinge.com',
                'password' => bcrypt('betatester'),
            ]
        ]);

        DB::table('item_types')->insert([
            [
                'name' => 'Show',
                'keyword' => 'tv',
            ],[
                'name' => 'Movie',
                'keyword' => 'movie',
            ],[
                'name' => 'People',
                'keyword' => 'person',
            ]
        ]);

        DB::table('user_lists')->insert([
            [
                'name' => 'Following',
                'private' => true,
                'user_id' => 1,
                'description' => 'What I\'m following',
                'removable' => false,
            ],[
                'name' => 'Watchlist',
                'private' => true,
                'user_id' => 1,
                'description' => 'My watchlist',
                'removable' => false,
            ],[
                'name' => 'Following',
                'private' => true,
                'user_id' => 2,
                'description' => 'What I\'m following',
                'removable' => false,
            ],[
                'name' => 'Watchlist',
                'private' => true,
                'user_id' => 2,
                'description' => 'My watchlist',
                'removable' => false,
            ]
        ]);
        DB::table('list_items')->insert([
            [
                'user_list_id' => 1,
                'moviedb_id' => 60625,
                'item_type_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'user_list_id' => 1,
                'moviedb_id' => 67744,
                'item_type_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'user_list_id' => 1,
                'moviedb_id' => 48866,
                'item_type_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'user_list_id' => 1,
                'moviedb_id' => 39852,
                'item_type_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'user_list_id' => 1,
                'moviedb_id' => 60059,
                'item_type_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'user_list_id' => 1,
                'moviedb_id' => 1415,
                'item_type_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'user_list_id' => 1,
                'moviedb_id' => 70513,
                'item_type_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'user_list_id' => 2,
                'moviedb_id' => 64230,
                'item_type_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'user_list_id' => 2,
                'moviedb_id' => 80730,
                'item_type_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'user_list_id' => 2,
                'moviedb_id' => 60059,
                'item_type_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
