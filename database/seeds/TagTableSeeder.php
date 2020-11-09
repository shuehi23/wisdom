<?php


use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->delete();

        DB::table('tags')->insert([
            'id' => 1,
            'name' => 'ビジネス書',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tags')->insert([
            'id' => 2,
            'name' => '自己啓発',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tags')->insert([
            'id' => 3,
            'name' => 'マーケティング',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tags')->insert([
            'id' => 4,
            'name' => 'マネー',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tags')->insert([
            'id' => 5,
            'name' => '心理学',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('tags')->insert([
            'id' => 6,
            'name' => 'プログラミング',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tags')->insert([
            'id' => 7,
            'name' => 'スポーツ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tags')->insert([
            'id' => 8,
            'name' => '芸能',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tags')->insert([
            'id' => 9,
            'name' => '恋愛',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tags')->insert([
            'id' => 10,
            'name' => '小説',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tags')->insert([
            'id' => 11,
            'name' => 'コミックス',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
           // 1レコード
//        $tag = new \App\Tag([
//            'name' => 'ビジネス書'
//        ]);
//        $tag->save();
//        // 2レコード
//        $tag = new \App\Tag([
//            'name' => 'マネー'
//        ]);
//        $tag->save();
//        // 3レコード
//        $tag = new \App\Tag([
//            'name' => '小説'
//        ]);
//        $tag->save();
//        // 4レコード
//        $tag = new \App\Tag([
//            'name' => 'エッセイ'
//        ]);
//        $tag->save();
//        // 5レコード
//        $tag = new \App\Tag([
//            'name' => '映画'
//        ]);
//        $tag->save();
//        // 6レコード
//        $tag = new \App\Tag([
//            'name' => '仕事'
//        ]);
//        $tag->save();
//        // 7レコード
//        $tag = new \App\Tag([
//            'name' => 'お金'
//        ]);
//        $tag->save();
//        // 8レコード
//        $tag = new \App\Tag([
//            'name' => '人生'
//        ]);
//        $tag->save();
//        // 9レコード
//        $tag = new \App\Tag([
//            'name' => '恋愛'
//        ]);
//        $tag->save();
//
//        $this->call(TagTableSeeder::class);
    }
}
