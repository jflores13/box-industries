<template>
  <section class="relative w-full pt-40 bg-gray-100">

    <!-- Hero content -->
    <div
      class="relative z-10 flex flex-col justify-center max-w-7xl mx-auto px-6"
    >

      <h1 class="mt-4 text-black font-extrabold leading-tight text-5xl sm:text-6xl md:text-7xl lg:text-8xl mb-10">
        {{ contactTexts.title }}
      </h1>
      <div class="w-full h-auto">
        <img
          src="/img/Contact.jpg"
          alt="Contact and Location Hero"
          class="w-full h-full object-cover"
        />
      </div>
      <div class="w-full text-center md:text-left my-10 text-black flex flex-col md:flex-row">
        <div class="w-full md:w-1/3">
            <h2 class="text-2xl font-semibold mb-2">{{ contactTexts.address_title }}</h2>
            <p class="text-lg" v-html="contactTexts.address_description"></p>
          </div>
          <div class="w-full md:w-1/3">
            <h2 class="text-2xl font-semibold mb-2">{{ contactTexts.office_hours_title }}</h2>
            <p class="text-lg" v-html="contactTexts.office_hours_description"></p>
          </div>
          <div class="w-full md:w-1/3">
            <h2 class="text-2xl font-semibold mb-2">{{ contactTexts.phone_title }}</h2>
            <p class="text-lg" v-html="contactTexts.phone_description"></p>
          </div>
      </div>

    </div>

    <!-- WhatsApp floating button -->
    <WhatsappButton class="w-10 h-10 mb-10 mr-10 drop-shadow-md" />
  </section>
</template>

<script setup>
import WhatsappButton from '@/Components/Buttons/WhatsappButton.vue';
import { useTexts } from '@/composables/useTexts';

const { texts: contactTexts } = useTexts('contact');

</script>
