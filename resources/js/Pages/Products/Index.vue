<script setup lang="ts">
import GuestLayout from "@/Layouts/GuestLayout.vue";
import SalePrice from "@/Components/SalePrice.vue";

defineProps<{
    products: Array<object>
}>();
</script>

<template>
    <GuestLayout title="Products">
        <div class="container mx-auto">
            <div class="grid md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3">
                <template v-for="(product, index) in products" :key="index">
                        <div class="flex flex-col rounded-md border p-5 h-full">
                            <div class="mx-auto">
                                <a :href="route('products.show', product.sku)">
                                    <img v-if="product.image" class="max-h-64" :src="product.image.thumbnail" :alt="product.name"/>
                                </a>
                            </div>
                            <div class="pt-5 text-center h-full">
                                <a :href="route('products.show', product.sku)">
                                    <h5 class="mb-2 text-md font-bold tracking-tight text-gray-900 uppercase">{{ product.name }}</h5>
                                </a>
                            </div>
                            <SalePrice :price="product.currency" :sale_price="product.sale_price" />
                        </div>
                </template>
            </div>
        </div>
    </GuestLayout>
</template>