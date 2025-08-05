<template>
  <section
    class="relative w-full h-screen bg-cover bg-center"
    style="background-image: url('');"
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

      <a
        href="#products"
        class="mt-10 inline-block bg-yellow-400 text-gray-900 font-semibold px-10 py-4 rounded"
      >
        Our Products
      </a>
    </div>

    <!-- WhatsApp floating button -->
    <a href="#" class="fixed bottom-8 right-8 z-20">
      <img src="" alt="WhatsApp" class="h-12 w-12" />
    </a>
  </section>
</template>

<script setup>
// No script logic needed for static hero
</script>
