<script setup lang="ts">
import {ref} from "vue";

const props = withDefaults(defineProps<{
    value: number;
    sku: string;
    min?: number
    max?: number
}>(), {
    min: 1,
    max: -1
})

const emit = defineEmits(['update']);

const handleUpdate = () => {
    emit('update', props.sku,  quantity.value);
}

const reduce = () => {
    if (quantity.value - 1 >= props.min) {
        quantity.value--;
        handleUpdate();
    }
}

const increase = () => {
    if (props.max !== -1 && quantity.value + 1 <= props.max) {
        quantity.value++;
        handleUpdate();
    } else if (props.max === -1) {
        quantity.value++;
    }
}

const quantity = ref(props.value);

</script>

<template>
    <div class="relative flex flex-row items-center mt-2">
        <button
            class="border border-gray-300 mr-3 p-2 hover:bg-gray"
            :class="{'text-gray-200':quantity === min}"
            @click="reduce"
            :disabled="quantity === min">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15"/>
            </svg>
        </button>
        <div>{{quantity}}</div>
        <button
            class="border border-gray-300 ml-3 p-2"
            :class="{'text-gray-200':quantity === max}"
            @click="increase"
            :disabled="quantity === max">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
        </button>
    </div>
</template>
