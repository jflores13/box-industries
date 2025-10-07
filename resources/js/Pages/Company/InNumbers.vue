<template>
  <section class="bg-gray-100 py-16">
    <div class="max-w-6xl mx-auto px-6">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
        <div class="space-y-2">
          <h3 class="text-4xl md:text-5xl font-bold text-gray-900">42+</h3>
          <p class="text-gray-600 font-medium">{{ companyTexts.numbers_employees }}</p>
        </div>
        <div class="space-y-2">
          <h3 class="text-4xl md:text-5xl font-bold text-gray-900">500+</h3>
          <p class="text-gray-600 font-medium">{{ companyTexts.numbers_clients }}</p>
        </div>
        <div class="space-y-2">
          <h3 class="text-4xl md:text-5xl font-bold text-gray-900">5.5M+</h3>
          <p class="text-gray-600 font-medium">{{ companyTexts.numbers_tonnes }}</p>
        </div>
        <div class="space-y-2">
          <h3 class="text-4xl md:text-5xl font-bold text-gray-900">2008</h3>
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