<?php

namespace App\Console\Commands;

use App\Models\EventAttachment;
use Illuminate\Console\Command;

class GenerateImagePreviews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-image-previews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $this->info('Scanning...');

            $e = EventAttachment::whereNull('image_mini')->limit(5)->get();
        foreach( $e as $e1 ){
            $this->info($e1->image_mini.' / '.$e1->url);
        }

        $this->info('Done!');
        return;

        // Получаем все записи без превью (или нужную логику фильтрации)
        $images = Image::whereNull('previews')->get();

        foreach ($images as $image) {
            $imagePath = $image->path;
            $file = Storage::disk('public')->path($imagePath); // если храните в storage

            // Размеры для превью, например:
            $sizes = [
                'small' => [60, 60],
                'medium' => [120, 120],
                'large' => [240, 240],
            ];
            $previews = [];

            foreach ($sizes as $key => [$width, $height]) {
                $img = InterventionImage::make($file)
                    ->fit($width, $height)
                    ->encode('jpg', 80); // качество 80%

                $previewPath = "previews/{$key}_" . basename($imagePath);

                Storage::disk('public')->put($previewPath, (string)$img);

                $previews[$key] = $previewPath;
            }

            $image->previews = $previews;
            $image->save();

            $this->info('Previews created for image id: ' . $image->id);
        }

        $this->info('Done!');
    }
}
