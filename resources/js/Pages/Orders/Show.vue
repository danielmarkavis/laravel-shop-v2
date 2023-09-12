<script setup lang="ts">
import {ref} from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { router } from '@inertiajs/vue3'

const props = defineProps<{
    order: object,
}>();

const selected = ref(null);

const addToCart = () => {
    router.visit(route('add.to.cart',{variant: selected.value.sku}));
}
</script>

<template>
    <GuestLayout title="Products">
        <div class="container mx-auto">
            <div class="grid md:grid-cols-2 gap-12 py-12">
                <div>
                    <h2 class="text-xl mb-5 font-bold">Order summary</h2>
                    <div class="flex flex-row justify-between">
                        <div>
                            Sub-Total
                        </div>
                        <div class="text-lg">
                            &pound;{{order.subtotal}}
                        </div>
                    </div>
                    <div class="flex flex-row justify-between">
                        <div>
                            VAT
                        </div>
                        <div class="text-lg">
                            &pound;{{order.vat}}
                        </div>
                    </div>
                    <div class="flex flex-row justify-between font-bold">
                        <div class="text-xl">
                            Total
                        </div>
                        <div class="text-xl">
                            &pound;{{order.total}}
                        </div>
                    </div>
                </div>
                <div>
                    <h2 class="text-xl font-bold mb-5">Shipping:</h2>
                    <ul>
                        <li>
                            <div class="text-bold">{{order.address.first_name}} {{order.address.last_name}}</div>
                        </li>
                        <li>
                            {{order.address.street_address_1}},
                            {{order.address.street_address_2 ? order.address.street_address_2+',' : ''}}
                            {{order.address.town}},
                            {{order.address.postcode}}</li>
                        <li>{{order.address.country}}</li>
                    </ul>
                </div>
            </div>
            <hr/>

            <div class="grid grid-cols-2 gap-2 py-12">
                <template v-for="details in order.order_products">
                <img :src="details.variant.image.url" alt="image" class="h-64"/>

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
                                <p class="text-lg uppercase">{{ details.variant.product.name }}</p>
                                <p class="">Sku: <span class="uppercase text-gray-500">{{ details.variant.sku }}</span></p>
                                <p class="">Colour: <span class="uppercase text-gray-500">{{ details.variant.colour }}</span></p>
                                <p class="">Size: <span class="uppercase text-gray-500">{{ details.variant.size }}</span></p>
                                <div class=""> Quantity: {{ details.quantity }}</div>
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
        </div>
    </GuestLayout>
</template>