<?php

namespace Database\Seeders;

use App\Enums\SystemMailEnum;
use App\Models\SystemMail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemMailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!SystemMail::whereName(SystemMailEnum::SUBSCRIPTION_EXPIRED->value)->exists()) {
            SystemMail::create([
                'name' => SystemMailEnum::SUBSCRIPTION_EXPIRED->value,
                'subject' => 'Строк дії підписки минув',
                'body' => '<p>Добрий день!</p><p>Цим листом повідомляємо вас про те, що строк дії вашої підписки минув. Вам більше не доступний платний функціонал</p>'
            ]);
        }
    }
}
