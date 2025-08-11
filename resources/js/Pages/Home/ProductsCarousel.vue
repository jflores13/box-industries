<script setup>
import Product from '@/Components/Containers/Product.vue';

const props = defineProps({
  products: {
    type: Array,
    default: () => [],
  },
});

</script>

<template>
  <section class="bg-box-light-gray py-12">
    <div class="overflow-x-auto">
      <div
        class="grid grid-flow-col auto-cols-max gap-4 px-4 md:px-10 lg:px-20 snap-x snap-mandatory"
      >
        <div
          v-for="product in products"
          :key="product.id"
          class="flex-shrink-0 w-full md:w-1/3 snap-start"
        >
          <Product :product="product" />
        </div>
      </div>
    </div>
  </section>
</template>