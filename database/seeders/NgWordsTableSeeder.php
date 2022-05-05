<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NgWord;

class NgWordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $words = [
            '死', '糞', 'クソ', '無職', '童貞', '気違い', 'キチガイ', 'クズ', 'ゴミ', '無能'
        ];

        foreach ($words as $word) {
            NgWord::create([
                'ng_word' => $word
            ]);
        }
    }
}
