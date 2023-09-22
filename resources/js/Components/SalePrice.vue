<script setup lang="ts">
defineProps<{
    price: number;
    sale_price: string|null;
}>()
</script>

<template>
    <div class="text-left flex flex-row">
        <template v-if="sale_price">
            <p class="font-normal text-lg text-gray-400 bottom-0 line-through">&pound;{{price}}</p>
            <p class="ml-2 font-bold text-xl text-red-500 bottom-0">&pound;{{sale_price}}</p>
        </template>
        <template v-else>
            <p class="font-bold text-xl text-gray-700 bottom-0">&pound;{{price}}</p>
        </template>
    </div>
</template>
