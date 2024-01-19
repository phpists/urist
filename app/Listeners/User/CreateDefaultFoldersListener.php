<?php

namespace App\Listeners\User;

use App\Enums\FolderType;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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

        $user->allFolders()->create(['folder_type' => FolderType::FILE_FOLDER->value, 'name' => 'Папка']);
        $user->allFolders()->create(['folder_type' => FolderType::FAVOURITES_FOLDER->value, 'name' => 'Папка']);
    }
}
