<script setup lang="ts">
import {ref} from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import {router} from '@inertiajs/vue3'
import BaseButton from "@/Components/Buttons/BaseButton.vue";

defineProps<{
    product: object,
    variants?: any,
    updating: boolean
}>();

const selectedColour = ref(null);
const selectedSize = ref(null);
const sizes = ref(null);

const addToCart = () => {
    router.visit(route('add.to.cart', {variant: selectedSize.value}), {preserveState: true});
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
                        <label for="size" class="block mb-2 text-sm font-medium text-gray-900" :class="{'':!sizes}">Select a size</label>
                        <select id="size" v-model="selectedSize" :disabled="!sizes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-auto p-2.5 pr-12">
                            <option selected disabled :value="null">Choose a size...</option>
                            <template v-if="sizes">
                                <template v-for="(size, index) in sizes">
                                    <option :value="size.sku" :disabled="!size.stock">{{ index }} <span v-if="!size.stock">(Out of stock)</span></option>
                                </template>
                            </template>
                        </select>
                    </div>

                    <div class="options">
                        <BaseButton
                            color="blue"
                            tag="button"
                            type="button"
                            @click="addToCart"
                            :disabled="!selectedColour || !selectedSize"
                        >Add to cart
                        </BaseButton>
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