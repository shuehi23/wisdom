<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->delete();

        $faker = Faker::create('ja_JP');

        DB::table('books')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'title' => 'スラスラ読める JavaScript ふりがなプログラミング',
                'title_img_path' => 'https://res.cloudinary.com/dojqb6g4z/image/upload/v1601866229/javascript%E6%9C%AC/javascript_q1ayii.jpg',
                'phrase' => 'スラスラ読めるJavaScript',
                'impression' => '初心者でもJavaScriptを分かりやすく解説しているので初学者にはおすすめです。',
                'created_at' => $faker->dateTimeBetween('-1 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'title' => '稼ぐ話術「すぐできる」コツ―――明日、あなたが話すと、「誰もが真剣に聞く」ようになる',
                'title_img_path' => 'https://res.cloudinary.com/dojqb6g4z/image/upload/v1601867410/%E5%96%B6%E6%A5%AD%E6%9C%AC/%E5%96%B6%E6%A5%AD_b5r5hw.jpg',
                'phrase' => '数字のないビジネストークはただの雑談',
                'impression' => '「グサり」と心に刺さった言葉の1つ。ビジネストークの中（特にミーティングの時など）や他のメンバーに詰められた時に数字を持ち出せていない場合が多々あった気がする。つまり「雑談」をかなりしてしまっていたし、イマイチ周りからのきっちりした評価ももらえていなかった気がする。最近はマシになってきたと思うが・・・。やっぱり普段から使っていかないと、いざって時にまた同じことの繰り返しになってしまうので、直近のミーティングからまずは意識的にやってみる',
                'created_at' => $faker->dateTimeBetween('-1 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'title' => '新世界',
                'title_img_path' => 'https://res.cloudinary.com/dojqb6g4z/image/upload/v1603416238/%E3%83%93%E3%82%B8%E3%83%8D%E3%82%B9%E6%9B%B8/61KQJU708OL_o8zljv.jpg',
                'phrase' => '信用を監禁する流れはもう止まらない',
                'impression' => '困っている人を助けたい時、きっとチカラになってくれる本です。なぜなら、本書にはそのアイデアや手法がひとつのウソなく載っているからです。私は「はれのひ事件」の裏側で行われていた『リベンジ成人式』のニュースを見た時に「良いことしはるな。。」と思いました。ところが別の意見で「西野いやらしいわ〜。」とあって「被害者の子らからしたらめっちゃ嬉しいと思える事してるのに何でそんなん言われなアカンねんな。」と感じてました。本書読むまで知らなかったんですが、それを考えて中心になって動いていたのは被害者と同じく女性の田村Pさんだったんですね。勘違いされてしまうことはあっても善意は大事にしていきたいものです。',
                'created_at' => $faker->dateTimeBetween('-1 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ],
        ]);
    }
}
?>