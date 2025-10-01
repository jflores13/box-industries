<template>
  <section class="w-full mx-auto flex flex-col gap-6">
    <div 
      v-for="service in services" 
      :key="service.order"
      class="flex flex-col md:flex-row md:items-center md:justify-center max-w-7xl mx-auto px-6 gap-6"
    
    >
      <div class="w-full md:w-1/2 h-full">
        <img :src="service.img_src" alt="Service Image" />
      </div>
      <div class="w-full md:w-1/2 h-full">
        <h3 class="text-3xl font-bold text-white mb-10">{{ service.name }}</h3>
        <p class="text-box-yellow mb-4">{{ service.short_description }}</p>
        <p class="text-white mb-6">{{ service.long_description }}</p>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">

defineProps({
  services: {
    required: true,
    default: () => [],
  },
});

</script>
