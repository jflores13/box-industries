<template>
  <div>
    <div>
      <img class="w-full h-auto object-cover" :src="product.image_src" alt="Product Image" />
    </div>
    <div>
      <h3>{{ product.name }}</h3>
      <p>{{ product.short_description }}</p>
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