<?php

namespace App\Models;

use App\Enums\FolderType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $casts = [
        'folder_type' => FolderType::class
    ];

    protected $fillable = ['name', 'parent_id', 'folder_type', 'user_id'];

    protected static function booted () {

        static::deleted(function(self $model) {
            if ($model->files)
                foreach ($model->files as $file)
                    $file->delete();

            if ($model->childs)
                foreach ($model->childs as $child)
                    $child->delete();
        });

    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Favourite::class);
    }

    public function childs()
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    public function parent()
    {
        return $this->hasOne(Folder::class, 'id', 'parent_id');
    }

    public static function getChildIds($folder_id): array
    {
        $ids = [$folder_id];
        $folder = self::find($folder_id);

        if ($folder->childs) {
            foreach ($folder->childs as $subcategory) {
                $ids = array_merge($ids, self::getChildIds($subcategory->id));
            }
        }

        return $ids;
    }

    public function getFilesCount(): int
    {
        $count = $this->files()->count();

        foreach ($this->childs as $child) {
            $count += $child->getFilesCount();
        }

        return $count;
    }

    public function getBookmarksCount(): int
    {
        $count = $this->bookmarks()->count();

        foreach ($this->childs as $child) {
            $count += $child->getBookmarksCount();
        }

        return $count;
    }

    public function getTotalEntriesCountTitle(): string
    {
        $count = $this->getFilesCount() + $this->getBookmarksCount();

        if ($count == 1) {
            return "$count правова позиція";
        } elseif ($count > 1 && $count < 5) {
            return "$count правові позиції";
        } else {
            return "$count правових позицій";
        }
    }

    public function getParentBreadcrumbs(bool $asString = true): string|array
    {
        $result = [$this->id => $this->name];
        $parent = $this->parent;

        do {
            if ($parent) {
                $result[$parent?->id] = $parent?->name;
                $parent = $parent?->parent;
            }
        } while ($parent);

        $result = array_reverse($result, true);
//        uksort($result, fn($a, $b) => -strnatcasecmp($a, $b));

        if ($asString) {
            return implode(' / ', $result);
        } else {
            return $result;
        }
    }

}
