<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\Plan\Feature;
use App\Models\Plan\Plan;
use App\Models\Plan\PlanFeature;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PlanHierarchySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        \DB::table('roles')->truncate();
        foreach (RoleEnum::cases() as $roleEnum) {
            Role::create([
                'name' => $roleEnum->value
            ]);
        }
        $role_ids = Role::pluck('id', 'name')->toArray();

        \DB::table('permissions')->truncate();
        foreach (PermissionEnum::cases() as $permissionEnum) {
            Permission::create([
                'name' => $permissionEnum->value
            ]);
        }
        $permission_ids = Permission::pluck('id', 'name')->toArray();


        \DB::table('features')->truncate();
        $features = [
            [
                'id' => 1,
                'permission_id' => $permission_ids[PermissionEnum::SMART_SEARCH->value],
                'title' => 'Інтелектуальний пошук',
            ],
            [
                'id' => 2,
                'permission_id' => $permission_ids[PermissionEnum::LEGAL_BASE->value],
                'title' => 'Доступна база правових позицій',
            ],
            [
                'id' => 3,
                'permission_id' => $permission_ids[PermissionEnum::EXPORT_PAGE->value],
                'title' => 'Можливість скачувати сторінку кнопкою export',
            ],
            [
                'id' => 4,
                'permission_id' => $permission_ids[PermissionEnum::CREATE_BOOKMARKS->value],
                'title' => 'Можливість створювати закладки по рішенням в особистому кабінеті',
            ],
            [
                'id' => 5,
                'permission_id' => $permission_ids[PermissionEnum::MARK_NEEDED->value],
                'title' => 'Можливість редагування тексту та відмічати жовтим кольором потрібне',
            ],
            [
                'id' => 6,
                'permission_id' => $permission_ids[PermissionEnum::CREATE_OWN_PAGES->value],
                'title' => 'Можливість самостійно створювати свої особисті сторінки з рішеннями, просвоювати імена рішенням з прив’язкою до посилання і т.п.',
            ],
            [
                'id' => 7,
                'permission_id' => $permission_ids[PermissionEnum::COPY_PAGE->value],
                'title' => 'Можливість копіювати сторінку',
            ],
            [
                'id' => 8,
                'permission_id' => $permission_ids[PermissionEnum::MODULE_KPK->value],
                'title' => 'Модуль КПК',
            ],
            [
                'id' => 9,
                'permission_id' => $permission_ids[PermissionEnum::MODULE_KK->value],
                'title' => 'Модуль КК',
            ],
        ];
        foreach ($features as $i => $feature) {
            $feature['pos'] = $i;
            Feature::create($feature);
        }

        \DB::table('plans')->truncate();
        $plans = [
            [
                'role_id' => $role_ids[RoleEnum::LITE->value],
                'title' => 'Lite',
                'price_monthly' => 5,
                'price_semiannual' => 27,
                'price_annual' => 48,
                'features' => [2, 8],
            ],
            [
                'role_id' => $role_ids[RoleEnum::BASE->value],
                'title' => 'Base',
                'price_monthly' => 7,
                'price_semiannual' => 37,
                'price_annual' => 65,
                'features' => [1, 2, 3, 4, 5, 6, 7, 8],
            ],
            [
                'role_id' => $role_ids[RoleEnum::MAX->value],
                'title' => 'Max',
                'price_monthly' => 10,
                'price_semiannual' => 55,
                'price_annual' => 80,
                'features' => [1, 2, 3, 4, 5, 6, 7, 8, 9],
            ],
        ];
        foreach ($plans as $i => $plan) {
            $plan['pos'] = $i;
            $planFeatures = $plan['features'];
            unset($plan['features']);

            $dbPlan = Plan::create($plan);

            foreach ($planFeatures as $featureId)
                PlanFeature::create([
                    'feature_id' => $featureId,
                    'plan_id' => $dbPlan->id
                ]);
        }

        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }

}
