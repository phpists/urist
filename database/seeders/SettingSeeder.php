<?php

namespace Database\Seeders;

use App\Enums\CriminalArticleTypeEnum;
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
                'value' => route('user.articles.index', CriminalArticleTypeEnum::KPK->value)
            ],
            [
                'name' => SettingEnum::KK_MODULE_BTN,
                'title' => 'Посилання для "Модуль КК"',
                'value' => route('user.articles.index', CriminalArticleTypeEnum::KK->value)
            ],
            [
                'name' => SettingEnum::APPLE_STORE_URL,
                'title' => 'Посилання "Apple Store"',
                'value' => '#'
            ],
            [
                'name' => SettingEnum::GOOGLE_STORE_URL,
                'title' => 'Посилання "Google Play"',
                'value' => '#'
            ],
            [
                'name' => SettingEnum::FOOTER_TEXT,
                'title' => 'Футер',
                'value' => '2023 © Всі права захищено'
            ],
            [
                'name' => SettingEnum::DEFAULT_FOLDERS,
                'title' => 'Папки для нових користувачів (роздільник "|")',
                'value' => 'Папка|Інша папка'
            ],
            [
                'name' => SettingEnum::SUBSCRIPTION_TEXT_ACTIVE,
                'title' => 'Текст для активної підписки. Розділено символом "|". Змінні: {activePricePeriod} - сума/період (наприклад $60/рік); {activeExpiresAt} - дата закінчення оплаченого періоду/наступного платежа',
                'value' => 'Підписка дійсна, періодичність списання коштів - {activePricePeriod}|Наступний платіж {activeExpiresAt}'
            ],
            [
                'name' => SettingEnum::SUBSCRIPTION_TEXT_MISSING,
                'title' => 'Текст про відсутність підписки',
                'value' => 'Наразі у вас немає активної підписки!'
            ],
            [
                'name' => SettingEnum::SUBSCRIPTION_TEXT_FREE,
                'title' => 'Текст для безкоштовного доступу, наданого адміном. Розділено символом "|". Змінні: {activeExpiresAt} - дата закінчення оплаченого періоду/наступного платежа',
                'value' => 'Наразі діє безкоштовний період|Діє до {activeExpiresAt}'
            ],
            [
                'name' => SettingEnum::SUBSCRIPTION_TEXT_FREE_TRIAL,
                'title' => 'Текст для пробного доступу, який надається автоматично при реєстрації. Розділено символом "|". Змінні: {activeExpiresAt} - дата закінчення оплаченого періоду/наступного платежа',
                'value' => 'Наразі діє безкоштовний пробний період|Діє до {activeExpiresAt}'
            ],
            [
                'name' => SettingEnum::SUBSCRIPTION_TEXT_CANCELLED,
                'title' => 'Текст для скасованої підписки. Розділено символом "|". Змінні: {activeExpiresAt} - дата закінчення оплаченого періоду/наступного платежа',
                'value' => 'Поточна підписка скасована|Оплачений період завершується {activeExpiresAt}'
            ],
            [
                'name' => SettingEnum::SUBSCRIPTION_TEXT_PENDING,
                'title' => 'Текст для скасованої підписки. Розділено символом "|". Змінні: {pendingExpiresAt} - дата закінчення очікуючого оплаченого періоду/наступного платежа',
                'value' => 'Наступний оплачуваний період|Наступний платіж {pendingExpiresAt}'
            ],
            [
                'name' => SettingEnum::FACEBOOK_URL,
                'title' => 'Посилання на Facebook',
                'value' => 'https://www.facebook.com/people/Lex-Go/61560082906686/'
            ],
            [
                'name' => SettingEnum::SHARE_URL,
                'title' => 'Посилання, яким ділитись в соц.мережах',
                'value' => config('app.url')
            ],
            [
                'name' => SettingEnum::SHARE_TEXT,
                'title' => 'Текст, яким ділитись в соц.мережах',
                'value' => config('app.name')
            ],
        ];

        foreach ($settings as $setting) {
            if (!Setting::whereName($setting['name'])->exists()) {
                Setting::create($setting);
            }
        }

    }
}
