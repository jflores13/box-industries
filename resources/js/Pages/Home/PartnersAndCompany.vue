<script setup>
import Partners from '@/Components/Containers/Partners.vue';
import { useTexts } from '@/composables/useTexts';

const { texts: homeTexts } = useTexts('home');

</script>

<template>
  <section class="bg-gray-100 py-4 text-black">
    <div class="px-4 mx-auto max-w-7xl">
      <h4 class="mt-10">{{ homeTexts.company_section_title }}</h4>
      <p class="text-3xl mt-4">{{ homeTexts.company_section_description }}</p>
    </div>
  </section>
</template>
