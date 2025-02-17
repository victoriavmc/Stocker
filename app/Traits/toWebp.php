<?php

namespace App\Traits;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

trait toWebp
{
    public function toWebp($image, $path, $name)
    {
        $manager = new ImageManager(new Driver());

        // Leer la imagen
        $image = $manager->read($image);

        // Convertir a WebP
        $image->toWebp();

        // Combinar el nombre con el sufijo que desees (por ejemplo, '-path')
        $newName = $name . '-' . $path;

        // Crear la ruta completa con el nuevo nombre
        $fullPath = $path . '/' . $newName . '.webp';

        // Guardar la imagen con el nuevo nombre
        $image->save($fullPath);

        return $fullPath;
    }
}
