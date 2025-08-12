<template>
  <section
    class="relative w-full h-screen bg-cover bg-center pt-96"
    style="background-image: url('/img/BOX-60.jpg');"
  >
    <!-- Dark overlay -->
    <span class="absolute inset-0 bg-black/60"></span>

    <!-- Top navigation -->


    <!-- Hero content -->
    <div
      class="relative z-10 flex flex-col justify-center h-[calc(100%-7rem)] max-w-7xl mx-auto px-6"
    >
      <p class="text-white text-2xl md:text-3xl font-light">Any Time, Any Size</p>

      <h1
        class="mt-4 text-white font-extrabold leading-tight text-5xl sm:text-6xl md:text-7xl lg:text-8xl"
      >
        We think inside the box,<br class="hidden sm:block" />
        so you don’t have to.
      </h1>

      <Link
        href="/products"
        class="mt-10 inline-block bg-box-yellow text-gray-900 font-semibold px-12 py-4 hover:bg-box-yellow/80 transition-colors duration-300 max-w-fit"
      >
        Our Products
      </Link>
    </div>

    <!-- WhatsApp floating button -->
    <WhatsappButton class="w-10 h-10 mb-10 mr-10 drop-shadow-md" />
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import WhatsappButton from '@/Components/Buttons/WhatsappButton.vue';

</script>
