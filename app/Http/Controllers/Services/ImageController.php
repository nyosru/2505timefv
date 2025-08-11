<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ImageController extends Controller
{

function createThumbnail(string $imagePath, int $maxWidth): string
{
    // Получаем абсолютный путь к файлу (в storage/app/public)
    $absolutePath = Storage::disk('public')->path($imagePath);

    if (!file_exists($absolutePath)) {
        throw new \Exception("Файл не найден: $absolutePath");
    }

    // Загружаем изображение
    $img = Image::make($absolutePath);

    // Пропорционально уменьшаем до maxWidth по ширине (если изображение шире maxWidth)
    if ($img->width() > $maxWidth) {
        $img->resize($maxWidth, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize(); // Запретить увеличение размера
        });
    }

    $filename = pathinfo($imagePath, PATHINFO_FILENAME);
    $extension = 'jpg'; // Можно менять формат, например, брать из оригинала
    $thumbnailPath = "previews/{$filename}_w{$maxWidth}.{$extension}";

    // Сохраняем миниатюру в диск public
    Storage::disk('public')->put($thumbnailPath, (string) $img->encode($extension, 80));

    // Возвращаем публичный URL (asset или storage)
    return Storage::disk('public')->url($thumbnailPath);
}
}
