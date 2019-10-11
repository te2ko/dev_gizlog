<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->truncate();
        DB::table('questions')->insert([
            [
                'user_id' => 1,
                'tag_category_id' => 2,
                'title' => '質問掲示板',
                'content' => '内容',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::create(2019, 10, 9),
            ],
            [
                'user_id' => 2,
                'tag_category_id' => 2,
                'title' => 'Questions Bulletin board',
                'content' => 'laravel',
                'created_at' => Carbon::create(2019, 9, 5),
                'updated_at' => Carbon::create(2019, 10, 3),
            ],
            [
                'user_id' => 4,
                'tag_category_id' => 3,
                'title' => 'Questions Bulletin board',
                'content' => 'conent',
                'created_at' => Carbon::create(2019, 8, 5),
                'updated_at' => Carbon::create(2019, 9, 5),
            ],
            [
                'user_id' => 3,
                'tag_category_id' => 4,
                'title' => 'Question',
                'content' => 'test',
                'created_at' => Carbon::create(2019, 7, 5),
                'updated_at' => Carbon::create(2019, 7, 30),
            ],
            [
                'user_id' => 2,
                'tag_category_id' => 3,
                'title' => 'Question',
                'content' => 'test',
                'created_at' => Carbon::create(2019, 7, 5),
                'updated_at' => Carbon::create(2019, 7, 30),
            ],
            [
                'user_id' => 4,
                'tag_category_id' => 2,
                'title' => 'Question',
                'content' => 'test',
                'created_at' => Carbon::create(2019, 7, 5),
                'updated_at' => Carbon::create(2019, 7, 30),
            ],
            [
                'user_id' => 4,
                'tag_category_id' => 1,
                'title' => 'Jquery',
                'content' => 'test',
                'created_at' => Carbon::create(2019, 7, 5),
                'updated_at' => Carbon::create(2019, 7, 30),
            ],
            [
                'user_id' => 2,
                'tag_category_id' => 3,
                'title' => 'Question',
                'content' => 'test',
                'created_at' => Carbon::create(2019, 7, 5),
                'updated_at' => Carbon::create(2019, 7, 30),
            ],
            [
                'user_id' => 1,
                'tag_category_id' => 4,
                'title' => 'Question',
                'content' => 'test',
                'created_at' => Carbon::create(2019, 7, 5),
                'updated_at' => Carbon::create(2019, 7, 30),
            ],
            [
                'user_id' => 3,
                'tag_category_id' => 2,
                'title' => 'Question',
                'content' => 'test',
                'created_at' => Carbon::create(2019, 7, 5),
                'updated_at' => Carbon::create(2019, 7, 30),
            ],
        ]);
    }
}
