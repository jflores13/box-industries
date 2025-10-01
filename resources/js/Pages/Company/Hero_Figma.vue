<template>
  <section class="relative w-full pt-40 bg-gray-100">

    <!-- Hero content -->
    <div
      class="relative z-10 flex flex-col justify-center max-w-7xl mx-auto px-6"
    >

      <h1 class="mt-4 text-black font-extrabold leading-tight text-5xl sm:text-6xl md:text-7xl lg:text-8xl mb-10">
        The Packaging 
        <br class="hidden sm:block" />
        Solutions Company
      </h1>
      <div class="w-full h-auto">
        <img
          src="/img/Company.jpg"
          alt="Company Hero"
          class="w-full h-full object-cover"
        />
      </div>
      <div class="w-full my-10 text-black text-2xl md:text-3xl font-light">
        <p>
          Box Industries was founded in 2008 in Arteaga, Coahuila. Since then, we've 
          specialized in designing and manufacturing custom packaging solutions — 
          from corrugated boxes to returnable plastic systems — tailored to the 
          needs of today's industries.
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
