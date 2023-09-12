<script setup lang="ts">
import GuestLayout from "@/Layouts/GuestLayout.vue";
import {router, useForm} from '@inertiajs/vue3';
import {ref} from "vue";
import IPaypal from "@/Components/Icons/IPaypal.vue";
import IVisa from "@/Components/Icons/IVisa.vue";

interface CartProduct {
    name: string,
    sku: string,
    colour: string,
    size: string,
    quantity: string,
    price: float,
}

const props = defineProps<{
    products: Array<CartProduct>,
    total: number
}>();

const form = useForm<{
    redirect: boolean,
}>({
    redirect: false,
});

const deleteFromCart = (sku) => {
    router.visit(route('delete.from.cart', {variant: sku}));
}

const handleSubmit = (): void => {
    form.post(route('payment.store'), {
        onSuccess: () => form.reset(),
    });
}

const activeTab = ref(0);
</script>

<template>
    <GuestLayout title="Cart">
        <div class="container mx-auto">
            <template v-if="products.length">
                <div class="grid grid-cols-2 gap-2">
                    <div class="p-5 rounded-lg">
                        <div class="flex flex-col pt-5">
                            <div class="tab-wrapper">
                                <div class="flex">
                                    <label
                                        @click="activeTab = 0"
                                        class="p-5"
                                        :class="{ 'bg-gray-200': activeTab === 0 }"
                                    >
                                        <IPaypal />
                                    </label>
                                    <label
                                        @click="activeTab = 1"
                                        class="p-5"
                                        :class="{ 'bg-gray-200': activeTab === 1 }"
                                    >
                                        <IVisa />
                                    </label>
                                </div>

                                <div class="p-5" :class="{ 'active': activeTab === 0 }" v-show="activeTab === 0">
                                    <div>
                                        <form @submit.prevent="handleSubmit">
                                            <button type="submit" class="text-gray-900 bg-[#F7BE38] hover:bg-[#F7BE38]/90 focus:ring-4 focus:ring-[#F7BE38]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 mr-2 mb-2">
                                                <svg class="mr-2 -ml-1 w-4 h-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="paypal" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                                    <path fill="currentColor" d="M111.4 295.9c-3.5 19.2-17.4 108.7-21.5 134-.3 1.8-1 2.5-3 2.5H12.3c-7.6 0-13.1-6.6-12.1-13.9L58.8 46.6c1.5-9.6 10.1-16.9 20-16.9 152.3 0 165.1-3.7 204 11.4 60.1 23.3 65.6 79.5 44 140.3-21.5 62.6-72.5 89.5-140.1 90.3-43.4 .7-69.5-7-75.3 24.2zM357.1 152c-1.8-1.3-2.5-1.8-3 1.3-2 11.4-5.1 22.5-8.8 33.6-39.9 113.8-150.5 103.9-204.5 103.9-6.1 0-10.1 3.3-10.9 9.4-22.6 140.4-27.1 169.7-27.1 169.7-1 7.1 3.5 12.9 10.6 12.9h63.5c8.6 0 15.7-6.3 17.4-14.9 .7-5.4-1.1 6.1 14.4-91.3 4.6-22 14.3-19.7 29.3-19.7 71 0 126.4-28.8 142.9-112.3 6.5-34.8 4.6-71.4-23.8-92.6z"></path>
                                                </svg>
                                                Check out with PayPal
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="p-5" :class="{ 'active': activeTab === 1 }" v-show="activeTab === 1">
                                    <form @submit.prevent="handleSubmit" class="flex flex-wrap gap-3 w-full p-5 mb-3">
                                        <label class="relative w-full flex flex-col">
                                            <span class="font-bold mb-3">Card number</span>
                                            <input class="rounded-md peer pl-12 pr-2 py-2 border-2 border-gray-200 placeholder-gray-300" type="text" name="card_number" placeholder="0000 0000 0000"/>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute bottom-0 left-0 -mb-0.5 transform translate-x-1/2 -translate-y-1/2 text-black peer-placeholder-shown:text-gray-300 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                            </svg>
                                        </label>

                                        <label class="relative flex-1 flex flex-col">
                                            <span class="font-bold mb-3">Expire date</span>
                                            <input class="rounded-md peer pl-12 pr-2 py-2 border-2 border-gray-200 placeholder-gray-300" type="text" name="expire_date" placeholder="MM/YY"/>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute bottom-0 left-0 -mb-0.5 transform translate-x-1/2 -translate-y-1/2 text-black peer-placeholder-shown:text-gray-300 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </label>

                                        <label class="relative flex-1 flex flex-col">
                                        <span class="font-bold flex items-center gap-3 mb-3">
                                          CVC/CVV
                                          <span class="relative group">
                                            <span class="hidden group-hover:flex justify-center items-center px-2 py-1 text-xs absolute -right-2 transform translate-x-full -translate-y-1/2 w-max top-1/2 bg-black text-white"> Hey ceci est une infobulle !</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                          </span>
                                        </span>
                                            <input class="rounded-md peer pl-12 pr-2 py-2 border-2 border-gray-200 placeholder-gray-300" type="text" name="card_cvc" placeholder="&bull;&bull;&bull;"/>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute bottom-0 left-0 -mb-0.5 transform translate-x-1/2 -translate-y-1/2 text-black peer-placeholder-shown:text-gray-300 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                            </svg>
                                        </label>
                                        <button type="submit" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-800 dark:bg-white dark:border-gray-700 dark:text-gray-900 dark:hover:bg-gray-200 mr-2 mt-5">
                                            Pay with Visa
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-5">
                        <h2 class="text-xl mb-5 font-bold">Order summary</h2>
                        <div class="flex flex-row justify-between">
                            <div>
                                Sub-Total
                            </div>
                            <div class="text-lg">
                                &pound;{{total}}
                            </div>
                        </div>
                        <div class="flex flex-row justify-between">
                            <div>
                                VAT
                            </div>
                            <div class="text-lg">
                                &pound;{{ Math.round(total - (total / 120) * 100) }}
                            </div>
                        </div>
                        <div class="flex flex-row justify-between font-bold">
                            <div>
                                Total
                            </div>
                            <div class="text-xl">
                                &pound;{{ total }}
                            </div>
                        </div>

                        <hr class="my-5">

                        <h2 class="text-xl">Items in cart</h2>
                        <div class="grid grid-cols-2 gap-2">
                            <template v-for="details in products">
                                <img :src="details.image" alt="image" class="h-48"/>

                                <div class="flex flex-col">
                                    <p class="text-md uppercase">{{ details.name }}</p>
                                    <p class="">Sku: <span class="uppercase text-gray-500">{{ details.sku }}</span></p>
                                    <p class="">Colour: <span class="uppercase text-gray-500">{{ details.colour }}</span></p>
                                    <p class="">Size: <span class="uppercase text-gray-500">{{ details.size }}</span></p>

                                    <div class="text-xl my-2">&pound;{{ details.price }}</div>

                                    <div class="text-xl my-2"> Qty: {{ details.quantity }}</div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                Your cart is empty!
            </template>
        </div>
    </GuestLayout>
</template>