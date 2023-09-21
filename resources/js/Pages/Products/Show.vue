<script setup lang="ts">
import {ref} from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import {router} from '@inertiajs/vue3'

defineProps<{
    product: object,
    variants?: any,
}>();

const selectedColour = ref(null);
const selectedSize = ref(null);
const sizes = ref(null);

const addToCart = () => {
    router.visit(route('add.to.cart', {variant: selectedSize.value}));
}

</script>

<template>
    <GuestLayout title="Product">
        <div class="container mx-auto">
<!--            {{selectedColour ?? 'none' }} <br> {{ selectedColour?.colour ?? 'none' }} <br> {{ sizes ?? 'none' }} <br> {{selectedSize ?? 'none' }}-->
            <div class="grid grid-cols-2 gap-2">
                <div v-if="selectedColour?.image || product.image">
                    <img :src="selectedColour ? selectedColour?.image.url : product.image.url" alt="image"/>
                </div>

                <div class="flex flex-col justify-center">
                    <h2 class="font-bold uppercase text-xl pb-3">{{ product.name }}</h2>
                    <p class="pb-3 text-xl">&pound;{{ product.price }}</p>
                    <div class="text-gray-600 pb-5" v-html="JSON.parse(product.description)"/>
                    <hr class="pb-5">

                    <div class="flex flex-row flex-wrap gap-2 pb-5">
                        <template v-for="(variant, index) in variants">
                            <div
                                :title="index"
                                @click="selectedColour = variant; sizes = variant.sizes; selectedSize = null"
                            >
                                <div :class="'bg-'+index+'-500'" class="h-6 w-6 rounded-full p-1">
                                    <template v-if="selectedColour && selectedColour?.colour === index">
                                        <div class="text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                            </svg>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="mb-5">
                        <label for="size" class="block mb-2 text-sm font-medium text-gray-900">Select a size</label>
                        <select id="size" v-model="selectedSize" :disabled="!sizes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >
                            <option selected disabled :value="null">Choose a size...</option>
                            <template v-if="sizes">
                                <template v-for="(size, index) in sizes">
                                    <option :value="size.sku" :disabled="!size.stock" class="uppercase">{{ index }} <span v-if="!size.stock">(Out of stock)</span></option>
                                </template>
                            </template>
                        </select>
                    </div>

                    <div class="options">
                        <button
                            type="button"
                            class="text-white bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none disabled:opacity-25"
                            role="link"
                            :disabled="!selectedColour || !selectedSize"
                            @click="addToCart"
                        >Add to cart
                        </button>
                        <div v-if="selectedColour">
                            Selected: <span>{{ selectedColour?.colour }}</span> <br>
                        </div>
                        <div v-if="selectedSize">
                            Sku: <span class="uppercase">{{ selectedSize }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>