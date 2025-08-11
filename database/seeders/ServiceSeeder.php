<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'title' => 'Контурная пластика губ',
                'description' => 'Изменение формы, поднятие уголков и увеличение объема губ. Активное вещество вводится по контуру улыбки, делая губы максимально пухлыми и соблазнительными.',
                'image' => '/img/service__img/lips_card.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Биоревитализация',
                'description' => 'Омоложение кожи, устранение следов постакне и возрастных изменений с помощью гиалуроновой кислоты. Процедура безопасна и проводится тонкими иглами.',
                'image' => '/img/service__img/face_card.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Инъекции Липолитиков',
                'description' => 'Липолитики активизируют процессы распада жиров, помогая избавиться от локальных жировых отложений и улучшить контуры лица и тела.',
                'image' => '/img/service__img/body_card.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Мезотерапия',
                'description' => 'Насыщение кожи витаминами, минералами и аминокислотами для борьбы с недостатками и первыми возрастными изменениями.',
                'image' => '/img/service__img/meza_card.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
} 