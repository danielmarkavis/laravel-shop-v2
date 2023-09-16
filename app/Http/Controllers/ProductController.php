<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
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
        //        $sizeId = Attribute::where('name','size')->first()->id;
        //        dd($sizeId);
        $VariantsRaw = Variant::select([
            'variants.id as variant_id',
            'products.id as product_id',
            'products.sku as product_sku',
            'variants.sku as variant_sku',
            'attribute_values.value as size',
//            'attributes.name as attribute_name',
        ])
            ->where('products.sku', 'SKU00081903')
            ->leftJoin('products', 'products.id', 'variants.product_id')
            ->leftJoin('attribute_values', 'attribute_values.id', 'variants.id')
            ->leftJoin('attributes', 'attributes.id', 'attribute_values.id')
            ->limit(10)
            ->get()
            ->groupby('variant_sku');//->load(['attributeValues.attribute'])
            //            ->find($product->id)
        ;
        dd($VariantsRaw->toArray());

        $product->load(['variants.attributeValues.attribute']);
        dd($product);
        $variants = $product->variants;
        //        dd($variants[0]->attributeValues);

        $variants = $product->variants->map(function(Variant $variant) {
            dd($variant->attributeValues[0]);
            return [
                'id'     => $variant->id,
                'sku'    => $variant->sku,
                'colour' => $variant->attributeValues->attributeOnly('colour')->attribute->name,
            ];
        });
        dd($variants[0]['colour']);
        $colours = Variant::select(['variants.size', 'variants.sku'])->where('product_id', $product->id)->distinct('variants.size')->get();//->pluck(['size','sku']);
        //        dd($colours);
        //        dd($variants->map());

        $colours = [];
        foreach ($variants as $variant) {
            $colours[$variant->colour][$variant->size] = $variant;
        }

        //Todo: set a default product??
        return inertia('Products/Show', compact('product', 'colours'));
    }

}
