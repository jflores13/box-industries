<template>
  <section class="relative w-full pt-40 bg-gray-100">

    <!-- Hero content -->
    <div
      class="relative z-10 flex flex-col justify-center max-w-7xl mx-auto px-6"
    >

      <h1 class="mt-4 text-black font-extrabold leading-tight text-5xl sm:text-6xl md:text-7xl lg:text-8xl mb-10">
        Responsibility for the
        <br class="hidden sm:block" />
        Next Generation
      </h1>
      <div class="w-full h-auto">
        <img
          src="/img/Environment.jpg"
          alt="Environment Hero"
          class="w-full h-full object-cover"
        />
      </div>
      <div class="w-full my-10 text-black text-2xl md:text-3xl font-light">
        <p>
          At Box Industries, sustainability isn't a trend — it's a commitment. 
            We develop packaging solutions that reduce waste, optimize materials, and 
            provide innovative technologies. From sourcing to development, we are 
            constantly seeking better ways to minimize our environmental footprint while 
            maintaining performance.
        </p>
        <p class="mt-6">
        Because protecting what matters goes beyond packaging — it's about the 
          future we help shape.
        </p>
      </div>

    </div>

    <!-- WhatsApp floating button -->
    <WhatsappButton class="w-10 h-10 mb-10 mr-10 drop-shadow-md" />
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import WhatsappButton from '@/Components/Buttons/WhatsappButton.vue';

</script>
