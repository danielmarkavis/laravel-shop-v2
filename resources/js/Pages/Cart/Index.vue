<script setup lang="ts">
import GuestLayout from "@/Layouts/GuestLayout.vue";
import {router} from "@inertiajs/vue3";
import Quantity from "@/Components/Quantity.vue";
import {ref} from "vue";
import ICircle from "@/Components/Icons/ICircle.vue";

interface CartProduct {
    name: string,
    sku: string,
    colour: string,
    size: string,
    quantity: string,
    stock: string,
    price: float,
}

const props = defineProps<{
    products: Array<CartProduct>,
    total: int
}>();

const updating = ref(false);

const updateCart = (sku, quantity) => {
    router.visit(route('update.the.cart',{variant: sku, quantity: quantity}),{
        onBefore: () => {updating.value = true},
        onFinish: () => {updating.value = false}
    });
}

const deleteFromCart = (sku) => {
    router.visit(route('delete.from.cart',{variant: sku}),{
        onBefore: () => {updating.value = true},
        onFinish: () => {updating.value = false}
    });
}</script>

<template>
    <GuestLayout title="Cart">
        <div class="container mx-auto">
            <template v-if="products.length">
                <div class="grid grid-cols-2 gap-2">
                    <template v-if="updating">
                        <div class="absolute top-0 bottom-0 left-0 right-0 flex items-center justify-center bg-white bg-opacity-75">
                            <div class="h-12 w-12 text-blue-500">
                                <ICircle />
                            </div>
                        </div>
                    </template>
                    <template v-for="(details, index) in products">
                        <img :src="details.image" alt="image" class="h-64"/>

                        <div class="flex flex-row">
                            <table class="w-full min-w-full">
                                <thead>
                                <tr>
                                    <th class="text-left uppercase pb-5">Details</th>
                                    <th class="text-right uppercase pb-5">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="align-top">
                                        <p class="text-lg uppercase">{{ details.name }}</p>
                                        <p class="">Sku: <span class="uppercase text-gray-500">{{ details.sku }}</span></p>
                                        <p class="">Colour: <span class="uppercase text-gray-500">{{ details.colour }}</span></p>
                                        <p class="">Size: <span class="uppercase text-gray-500">{{ details.size }}</span></p>
                                        <Quantity :value="details.quantity" :max="details.stock" :sku="details.sku" @update="updateCart"/>
                                        <template v-if="details.stock < 10">
                                            <p class="text-red-500">Low stock</p>
                                        </template>
                                        <div class="flex mt-5">
                                            <a @click="deleteFromCart(details.sku)" class="text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="text-right align-top">
                                        <div class="text-xl">&pound;{{ details.price }}</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </template>
                </div>
                <hr class="my-5">
                <div class="flex flex-row justify-between">
                    <div>
                        Total:
                    </div>
                    <div class="text-xl">
                        &pound;{{ total }}
                    </div>
                </div>
                <div class="flex flex-row justify-end pt-5">
                    <a href="/checkout" class="text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-12 py-2.5 ml-2 mb-2 focus:outline-none">Checkout</a>
                </div>
            </template>
            <template v-else>
                Your cart is empty!
            </template>
        </div>
    </GuestLayout>
</template>