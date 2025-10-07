<template>
  <div class="w-full h-full">
    <div class="aspect-square w-full">
      <img class="w-full h-full object-cover" :src="product.image_src" alt="Product Image" />
    </div>
    <div>
      <h3>{{ product.name }}</h3>
      <p>{{ product.short_en || product.short_es }}</p>
    </div>
  </div>
</template>

<script setup lang="ts">
import type { Product } from '@/types/product';
import { PropType } from 'vue';

const props = defineProps({
  product: {
    type: Object as PropType<Product>,
    required: true,
  },
});
</script>