<script setup lang="ts">
import GuestLayout from "@/Layouts/GuestLayout.vue";

defineProps<{
    products: Array<object>
}>();
</script>

<template>
    <GuestLayout title="Products">
        <div class="container mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <template v-for="(product, index) in products" :key="index">
                    <a :href="route('products.show', product.sku)">
                        <div class="bg-gray-200 flex flex-col pt-5 rounded-md">
                            <div class="mx-auto">
                                <img v-if="product.image" class="h-64" :src="product.image.url" :alt="product.name"/>
                            </div>
                            <div class="p-5 text-center">
                                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 uppercase">{{ product.name }}</h5>
                                <p class="mb-3 font-normal text-gray-700">&pound;{{product.price}}</p>
<!--                                <p class="mb-3 font-normal text-gray-700" v-html="JSON.parse(product.description)"></p>-->
                            </div>
                        </div>
                    </a>

                </template>
            </div>
        </div>
    </GuestLayout>
</template>