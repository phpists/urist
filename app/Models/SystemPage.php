<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemPage extends Model
{

    const IMG_PATH = '/uploads/system-pages/';

    protected $fillable = [
        'name',
        'title',
        'data',
        'images',
        'meta'
    ];

    protected $casts = [
        'data' => 'json',
        'images' => 'json',
        'meta' => 'array'
    ];



    public function getImageSrc(int $i): ?string
    {
        if (isset($this->images[$i])) {
            if (str_contains($this->images[$i], '/assets/img/'))
                return $this->images[$i];

            $filePath = self::IMG_PATH . $this->images[$i];

            if (\Storage::fileExists($filePath))
                return \Storage::url($filePath);
        }

        return null;
    }

    public function getDataByDotPath(string $path): string
    {
        $tempData = $this->data;
        $exists =  true;
        foreach(explode('.', $path) as $step) {
            if (isset($tempData[$step]))
                $tempData = &$tempData[$step];
            else
                $exists = false;
        }

        if ($exists)
            return $tempData;

        return '';
    }

    public function getDataImgSrcByDot(string $path): ?string
    {
        $img = $this->getDataByDotPath($path);
        if ($img) {
            if (str_contains($img, '/assets/img/'))
                return $img;

            $filePath = self::IMG_PATH . $img;

            if (\Storage::fileExists($filePath))
                return \Storage::url($filePath);
        }

        return null;
    }

    public function getHtmlString(string $path): string
    {
        return strtr($this->getDataByDotPath($path), ['<' => '<span>', '>' => '</span>']);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function getMeta(string $key): ?string
    {
        if (is_array($this->meta))
            return $this->meta[$key] ?? null;

        return null;
    }

}
