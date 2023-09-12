<template>
  <svg
    :style="styles"
    class="h-full w-full"
    fill="none"
    stroke="currentColor"
    viewBox="0 0 24 24"
    xmlns="http://www.w3.org/2000/svg"
  >
    <path
      d="M5 15l7-7 7 7"
      stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="2"
    />
  </svg>
</template>

<script setup lang="ts">
import {computed} from "vue";

const props = defineProps<{
  rotate?: number
}>();

const styles = computed<string>(() => {
  return "transform: rotate(" + props.rotate + "deg)";
});
</script>
