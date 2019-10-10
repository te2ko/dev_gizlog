<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->truncate();
        DB::table('comments')->insert([
            [
                'user_id' => 1,
                'question_id' => 1,
                'comment' => 'I want to help, but I do not understand at all.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::create(2019, 10, 9),
            ],
            [
                'user_id' => 2,
                'question_id' => 2,
                'comment' => 'I want to help, but I do not understand at all.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::create(2019, 10, 9),
            ],
            [
                'user_id' => 3,
                'question_id' => 4,
                'comment' => 'I want to help, but I do not understand at all.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::create(2019, 10, 9),
            ],
            [
                'user_id' => 4,
                'question_id' => 4,
                'comment' => 'I want to help, but I do not understand at all.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::create(2019, 10, 9),
            ],
            [
                'user_id' => 1,
                'question_id' => 5,
                'comment' => 'I want to help, but I do not understand at all.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::create(2019, 10, 9),
            ],
            [
                'user_id' => 2,
                'question_id' => 6,
                'comment' => 'I want to help, but I do not understand at all.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::create(2019, 10, 9),
            ],
            [
                'user_id' => 3,
                'question_id' => 7,
                'comment' => 'I want to help, but I do not understand at all.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::create(2019, 10, 9),
            ],
            [
                'user_id' => 4,
                'question_id' => 8,
                'comment' => 'I want to help, but I do not understand at all.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::create(2019, 10, 9),
            ],
            [
                'user_id' => 1,
                'question_id' => 9,
                'comment' => 'I want to help, but I do not understand at all.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::create(2019, 10, 9),
            ],
        ]);
    }
}
