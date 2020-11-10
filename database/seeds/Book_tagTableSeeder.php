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
                'book_id' => 1,
                'tag_id' => 6,
            ],
            [
                'book_id' => 2,
                'tag_id' => 4,
            ],
            [
                'book_id' => 3,
                'tag_id' => 1,
            ]
            
        ]);
    }
}
