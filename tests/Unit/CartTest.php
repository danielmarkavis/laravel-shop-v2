<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{

    use RefreshDatabase;

    public CartService $cartService;

    protected function setUp(): void
    {
        parent::setUp();

        Product::factory()
            ->hasVariants(2)
            ->create()
            ->each(
            /**
             * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded
             * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
             * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
             */
                function(Product $product) {
                    foreach ($product->variants as $index => $variant) {
                        $fileName = sprintf("%s.png", $variant['colour']);
                        $path = public_path('images/' . $fileName);
                        $variant->addMedia($path)->toMediaCollection('default');
                    }

//                    $imageUrl = $product->variants[0]->image->url;
//                    $product->addMedia($imageUrl)->toMediaCollection('default');
                }
            );

        $this->cartService = app(CartService::class);
    }

    public function test_add_to_cart(): void
    {
//        $product = Product::factory()->hasVariants(2)->create();
        $product = Product::first();

        $this->cartService->store($product->variants[0]);

        $cart = $this->cartService->get();
        dd($cart);

        $this->assertModelExists($product);
    }

}
