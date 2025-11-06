<template>
  <section class="bg-gray-100 py-16">
    <div class="max-w-6xl mx-auto px-6">
      <div class="flex justify-center gap-32 text-center">
        <div>
          <h3 class="text-4xl md:text-5xl font-bold text-gray-900">100+</h3>
          <p class="text-gray-600 font-medium">{{ companyTexts.numbers_employees }}</p>
        </div>
        <div>
          <h3 class="text-4xl md:text-5xl font-bold text-gray-900">2009</h3>
          <p class="text-gray-600 font-medium">{{ companyTexts.numbers_established }}</p>
        </div>  
      </div>
    </div>
  </section>
</template>

<script setup>
import { useTexts } from '@/composables/useTexts';

const { texts: companyTexts } = useTexts('company');

</script>