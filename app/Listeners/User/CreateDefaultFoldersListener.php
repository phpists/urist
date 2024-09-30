<?php

namespace App\Listeners\User;

use App\Enums\FolderType;
use App\Enums\SettingEnum;
use App\Models\User;
use App\Services\SettingService;
use App\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CreateDefaultFoldersListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        /** @var User $user */
        $user = $event->user;
        Log::error('here');

        $defaultFolders = explode('|', SettingService::getValueByName(SettingEnum::DEFAULT_FOLDERS->value));

        foreach ($defaultFolders as $folder) {
            Log::error($folder);
            $user->allFolders()->create([
                'name' => $folder
            ]);
        }
    }
}
