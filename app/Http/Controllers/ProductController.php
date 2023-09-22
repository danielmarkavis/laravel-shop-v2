<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductShowRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\Variant;
use App\Repositories\ProductsIndex;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(ProductsIndex $provider): Response|ResponseFactory
    {
        $products = $provider
            ->getQuery()
            ->get();

        return inertia('Products/Index', compact('products'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): Response|ResponseFactory
    {
        // $colour/size = sku
        $product->load(['variants', 'variants.media']);

        $product->image = $product->variants[0]->image; // Set default image for product.
        $variants = [];
        foreach ($product->variants as $index => $variant) {
            $variants[$variant->colour]['image'] = $variant->image;
            $variants[$variant->colour]['colour'] = $variant->colour;
            $variants[$variant->colour]['price'] = $variant->currency;
            $variants[$variant->colour]['sizes'][$variant->size] = [
                'sku' => $variant->sku, 'image' => $variant->image->url, 'stock' => $variant->stock, 'label' => strtoupper($variant->size)
            ];
        }
//        dd($variants);
        //Todo: set a default product??
        return inertia('Products/Show', compact('product', 'variants'));
    }

}


//        $sizeId = Attribute::where('name','size')->first()->id;
//        dd($sizeId);
//        $VariantsRaw = Variant::select([
//            'variants.id as   variant_id',
//            'products.id as product_id',
//            'products.sku as product_sku',
//            'variants.sku as variant_sku',
//            'attribute_values.value as size',
////            'attributes.name as attribute_name',
//        ])
//            ->where('products.sku', 'SKU00081903')
//            ->leftJoin('products', 'products.id', 'variants.product_id')
//            ->leftJoin('attribute_values', 'attribute_values.id', 'variants.id')
//            ->leftJoin('attributes', 'attributes.id', 'attribute_values.id')
//            ->limit(10)
//            ->get()
////            ->groupby('variant_sku');//->load(['attributeValues.attribute'])
//            //            ->find($product->id)
//        ;
//        dd($VariantsRaw[0]);
//        $sizeId = Attribute::where('name', 'size')->first()->id;
//        $colourId = Attribute::where('name', 'colour')->first()->id;
//        dd($colourId);

//        $VariantsRaw = Variant::select([
//            'variants.id as variant_id',
//            'products.id as product_id',
//            'products.sku as product_sku',
//            'variants.sku as variant_sku',
//            'attribute_values.value as color',
//            //                    'attribute_values.value as size',
//            //            'attributes.name as attribute_name',
//        ])
//            ->where('products.sku', $product->sku)
//            ->where('attributes.id', $colourId)
//            ->leftJoin('products', 'products.id', 'variants.product_id')
//            ->leftJoin('attribute_values', 'attribute_values.id', 'variants.id')
//            ->leftJoin('attributes', 'attributes.id', 'attribute_values.id')
//            ->limit(10)
//            ->get()
//            //            ->groupby('variant_sku');//->load(['attributeValues.attribute'])
//            //            ->find($product->id)
//        ;
//        dd($VariantsRaw[0]->toArray());

// Grab product data for name, description.
// Grab first variant for image.
// Grab all variant colors, push colors to frontend.
// Client selects colour: Grab all variants on that color and return sizes which include skus.
// Client selects size: Set selected as sku, enabled add to basket.

//        dd(AttributeValue::select('*')
//            ->where('attributes.name','colour')
//            ->join('attributes','attributes.id','attributeValues.attribute_id')
//            ->get()
//            ->load(['variants','attribute']));
