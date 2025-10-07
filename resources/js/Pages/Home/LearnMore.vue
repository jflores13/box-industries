
<template>
  <section class="bg-white py-12 text-black">
    <div class="max-w-6xl mx-auto px-4">
      <!-- Intro text -->
      <p class="text-2xl md:text-3xl leading-tight font-medium mb-8">
        {{ homeTexts.about_us_section_text }}
      </p>

      <!-- Call-to-action button -->
      <button
        type="button"
        class="bg-box-brown text-box-yellow-light px-6 py-3 shadow hover:bg-box-brown/90 transition-colors"
      >
        {{ homeTexts.about_us_section_button }}
      </button>

      <!-- Image -->
      <div class="mt-10">
        <img
          src="/img/BXIN-Forklift.jpg"
          alt="Forklift carrying boxes inside warehouse"
          class="w-full h-auto object-cover"
        />
      </div>
    </div>
  </section>
</template>

<script setup>
import { useTexts } from '@/composables/useTexts';

const { texts: homeTexts } = useTexts('home');

</script>
