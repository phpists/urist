<?php

namespace App\Traits;

trait HasMeta
{


    public function getMeta(string $key): ?string
    {
        if (is_array($this->meta))
            return $this->meta[$key] ?? null;

        return null;
    }

}
