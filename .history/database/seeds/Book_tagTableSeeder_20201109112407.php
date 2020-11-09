<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Book_tagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book_tag')->delete();

        DB::table('book_tag')->insert([
            [
                'id' => 1,
                'book_id' => 1,
                'tag_id' => 6,
            ],
            [
                'id' => 2,
                'book_id' => 2,
                'tag_id' => 4,
            ],
            [
                'id' => 3,
                'book_id' => 3,
                'tag_id' => 1,
            ]
            
        ]);
    }
}
