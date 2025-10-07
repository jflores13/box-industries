<template>
  <section class="relative w-full pt-40 bg-gray-100">

    <!-- Hero content -->
    <div
      class="relative z-10 flex flex-col justify-center max-w-7xl mx-auto px-6"
    >

      <h1 class="mt-4 text-black font-extrabold leading-tight text-5xl sm:text-6xl md:text-7xl lg:text-8xl mb-10">
        {{ companyTexts.hero_large }}
      </h1>
      <div class="w-full h-auto">
        <img
          src="/img/Company.jpg"
          alt="Company Hero"
          class="w-full h-full object-cover"
        />
      </div>
      <div class="w-full my-10 text-black text-2xl md:text-3xl font-light">
        <p>{{ companyTexts.hero_small }}</p>
      </div>

    </div>

    <!-- WhatsApp floating button -->
    <WhatsappButton class="w-10 h-10 mb-10 mr-10 drop-shadow-md" />
  </section>
</template>

<script setup>
import WhatsappButton from '@/Components/Buttons/WhatsappButton.vue';
import { useTexts } from '@/composables/useTexts';

const { texts: companyTexts } = useTexts('company');

</script>
