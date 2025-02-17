<?php

namespace App\Traits;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

trait toWebp
{
    public function toWebp($image, $path, $name)
    {
        $manager = new ImageManager(new Driver());

        $image = $manager->read($image);

        $image->toWebp();

        $fullPath = $path . '/' . $name . '.webp';

        $image->save($fullPath);

        return $fullPath;
    }
}
