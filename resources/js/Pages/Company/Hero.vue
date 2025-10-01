<template>
  <section class="relative h-screen flex flex-col justify-center items-start">
    <!-- Background image - Team photo -->
    <div 
      class="absolute inset-0 bg-cover bg-center bg-no-repeat"
      style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)), url('/img/Company.jpg')"
    ></div>
    
    <!-- Content -->
    <div class="relative z-10 max-w-6xl mx-auto px-6 w-full">
      <div class="max-w-2xl">
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-tight mb-8">
          The Packaging<br>
          Solutions Company
        </h1>
        <p class="text-xl text-white/90 leading-relaxed">
          Box Industries was founded in 2008 in Arteaga, Coahuila. Since then, we've 
          specialized in designing and manufacturing custom packaging solutions — 
          from corrugated boxes to returnable plastic systems — tailored to the 
          needs of today's industries.
        </p>
      </div>
    </div>

    <!-- WhatsApp Button -->
    <div class="absolute bottom-8 right-8 z-20">
      <WhatsappButton />
    </div>
  </section>
</template>

<script setup>
import WhatsappButton from '@/Components/Buttons/WhatsappButton.vue';
</script>