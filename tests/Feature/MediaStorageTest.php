<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaStorageTest extends TestCase
{
    use RefreshDatabase;

    public function test_media_can_use_s3_storage_without_image_conversions(): void
    {
        Storage::fake('s3');
        config([
            'media-library.disk_name' => 's3',
            'media.conversions_enabled' => false,
        ]);

        $category = Category::create([
            'name' => 'Pendingin',
            'slug' => 'pendingin',
        ]);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'AC Portable',
            'slug' => 'ac-portable',
            'description' => 'Pendingin untuk kebutuhan acara.',
        ]);

        $product->addMedia(UploadedFile::fake()->image('ac-portable.jpg'))
            ->toMediaCollection('images');

        $media = $product->getFirstMedia('images');

        $this->assertSame('s3', $media->disk);
        $this->assertEmpty($media->generated_conversions);
        $this->assertCount(1, Storage::disk('s3')->allFiles());
        $this->assertSame($media->getUrl(), $product->getThumbnailUrl('large'));
    }
}
