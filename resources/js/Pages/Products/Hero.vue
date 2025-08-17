<template>
  <section
    class="relative w-full h-screen bg-cover bg-center pt-96"
    style="background-image: url('/img/BOX-47.jpg');"
  >
    <!-- Dark overlay -->
    <span class="absolute inset-0 bg-black/60"></span>

    <!-- Top navigation -->


    <!-- Hero content -->
    <div
      class="relative z-10 flex flex-col justify-center h-[calc(100%-7rem)] max-w-7xl mx-auto px-6"
    >

      <h1
        class="mt-4 text-white font-extrabold leading-tight text-5xl sm:text-6xl md:text-7xl lg:text-8xl"
      >
      Packaging that 
      <br class="hidden sm:block" />
      fits your world
      </h1>
      <p class="mt-8 text-white text-2xl md:text-3xl font-light">Together, we create packaging that's <br class="hidden sm:block" />ready for whatever the future holds.</p>

    </div>

    <!-- WhatsApp floating button -->
    <WhatsappButton class="w-10 h-10 mb-10 mr-10 drop-shadow-md" />
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import WhatsappButton from '@/Components/Buttons/WhatsappButton.vue';

</script>
