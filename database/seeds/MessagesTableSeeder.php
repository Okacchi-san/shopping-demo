<?php

use Illuminate\Database\Seeder;


class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 25; $i++) {
            DB::table('messages')->insert([
                'content' => 'test content ' . $i
            ]);
        }
    }
}
