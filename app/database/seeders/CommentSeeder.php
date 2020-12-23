<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'user_id' => '2',
            'post_id' => '13',
            'comment' => 'Lorem ipsum dolor sit amet quibusdam veniam.こんにちは、私の名前はアントニオ猪木と言います。危ぶめば道はなし。迷わず行けよ、行けばわかるさ',
            'comment_image_path' => '',
        ]);
        DB::table('comments')->insert([
            'user_id' => '2',
            'post_id' => '13',
            'comment' => 'Lorem ipsum dolor sit amet quibusdam veniam.こんにちは、私の名前はアントニオ猪木と言います。危ぶめば道はなし。迷わず行けよ、行けばわかるさ',
            'comment_image_path' => '',
        ]);
        DB::table('comments')->insert([
            'user_id' => '2',
            'post_id' => '13',
            'comment' => 'Lorem ipsum dolor sit amet quibusdam veniam.こんにちは、私の名前はアントニオ猪木と言います。危ぶめば道はなし。迷わず行けよ、行けばわかるさ',
            'comment_image_path' => '',
        ]);
        DB::table('comments')->insert([
            'user_id' => '2',
            'post_id' => '13',
            'comment' => 'Lorem ipsum dolor sit amet quibusdam veniam.こんにちは、私の名前はアントニオ猪木と言います。危ぶめば道はなし。迷わず行けよ、行けばわかるさ',
            'comment_image_path' => '',
        ]);
        DB::table('comments')->insert([
            'user_id' => '2',
            'post_id' => '13',
            'comment' => 'Lorem ipsum dolor sit amet quibusdam veniam.こんにちは、私の名前はアントニオ猪木と言います。危ぶめば道はなし。迷わず行けよ、行けばわかるさ',
            'comment_image_path' => '',
        ]);
        
    }
}
