<template>
  <div>
    <div class="hidden md:flex flex-col text-left">
      <h3 class="text-xl font-bold">{{ name }}</h3>
      <p class="text-yellow-400 font-medium">{{ title }}</p>
      <div class="aspect-[3/4] bg-gray-400 my-4 overflow-hidden">
        <div class="w-full h-full bg-gray-500 flex items-center justify-center text-gray-300">
          <img :src="image" alt="Suite" class="aspect-auto">
        </div>
      </div>
      <p>{{ email }}</p>
      <p>{{ phone }}</p>
    </div>
    <div class="flex md:hidden flex-row text-left gap-x-4">
      <div class="w-1/3">
        <img :src="image" alt="Suite" class="aspect-auto object-cover">
      </div>
      <div class="w-2/3">
        <h3 class="text-xl font-bold">{{ name }}</h3>
        <p class="text-yellow-400 font-medium">{{ title }}</p>
        <p>{{ email }}</p>
        <p>{{ phone }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  name: {
    type: String,
    required: true,
  },
  title: {
    type: String,
    required: true,
  },
  email: {
    type: String,
    default: 'email@example.com',
  },
  phone: {
    type: String,
    default: '(123) 456 7890',
  },
  image: {
    type: String,
    default: '/img/company/suite.webp',
  },
});
</script>