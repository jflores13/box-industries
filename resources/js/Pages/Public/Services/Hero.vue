<template>
  <section
    class="relative w-full h-screen bg-cover bg-center pt-96"
    style="background-image: url('/img/ServicesHero.jpg');"
  >
    <!-- Dark overlay -->
    <span class="absolute inset-0 bg-black/60"></span>

    <!-- Hero content -->
    <div
      class="relative z-10 flex flex-col justify-center h-[calc(100%-7rem)] max-w-7xl mx-auto px-6"
    >

      <h1
        class="mt-4 text-white font-extrabold leading-tight text-5xl sm:text-6xl md:text-7xl lg:text-8xl"
      >
      Overview of 
      <br class="hidden sm:block" />
      Our Services
      </h1>
      <p class="mt-8 text-white text-2xl md:text-3xl font-light">
        Box Industries supports its clients from concept to scalable production. 
      </p>
      <p class="text-white text-2xl md:text-3xl font-light">
        Discover our full range of packaging solutions here.
      </p>

    </div>

    <!-- WhatsApp floating button -->
    <WhatsappButton class="w-10 h-10 mb-10 mr-10 drop-shadow-md" />
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import WhatsappButton from '@/Components/Buttons/WhatsappButton.vue';

</script>
