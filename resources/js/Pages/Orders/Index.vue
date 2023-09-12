<script setup lang="ts">
import GuestLayout from "@/Layouts/GuestLayout.vue";
import {router} from "@inertiajs/vue3";

interface Order {
    uuid: string,
    quantity: string,
    total: float,
}

const props = defineProps<{
    orders: Array<Order>,
}>();

const deleteFromCart = (sku) => {
    router.visit(route('delete.from.cart', {variant: sku}));
}
</script>

<template>
    <GuestLayout title="Cart">
        <div class="container mx-auto">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <template v-if="orders.length">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">#</th>
                                        <th scope="col" class="px-6 py-3">Quantity</th>
                                        <th scope="col" class="px-6 py-3">Total</th>
                                        <th scope="col" class="px-6 py-3">Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template v-for="order in orders">
                                        <tr class="bg-white border-b">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                <template v-if="order.status !== 'pending'">
                                                    <a :href="route('orders.show', {'order': order.uuid})">{{ order.uuid }}</a>
                                                </template>
                                                <template v-else>
                                                    <a :href="route('cart.index')">{{ order.uuid }}</a>
                                                </template>
                                            </th>
                                            <td class="px-6 py-4">{{ order.order_products.length }}</td>
                                            <td class="px-6 py-4">&pound;{{ order.total }}</td>
                                            <td class="px-6 py-4">{{ order.status }}</td>
                                        </tr>
                                    </template>
                                    </tbody>
                                </table>
                            </template>
                            <template v-else>
                                No orders
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>