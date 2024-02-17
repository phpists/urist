<?php

namespace Database\Seeders;

use App\Enums\SettingEnum;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'name' => SettingEnum::ADMIN_EMAIL,
                'title' => 'Email адреса адміна',
                'value' => 'admin@example.com'
            ],
            [
                'name' => SettingEnum::CRIMINAL_ARTICLES_PER_PAGE,
                'title' => 'К-сть статтей на сторінці збірника',
                'value' => 100
            ],
            [
                'name' => SettingEnum::KPK_MODULE_BTN,
                'title' => 'Посилання для "Модуль КПК"',
                'value' => route('user.articles.index')
            ],
            [
                'name' => SettingEnum::KK_MODULE_BTN,
                'title' => 'Посилання для "Модуль КК"',
                'value' => route('user.articles.index')
            ],
        ];

        foreach ($settings as $setting) {
            if (!Setting::whereName($setting['name'])->exists()) {
                Setting::create($setting);
            }
        }

    }
}
