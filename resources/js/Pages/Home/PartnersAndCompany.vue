<script setup>
import SonyLogo from '@/Components/Images/SonyLogo.vue';
</script>

<template>
  <section class="bg-gray-100 py-4">
    <div class="px-4 max-w-6xl mx-auto">
      <h4>Trust in Us</h4>

      <div class="overflow-hidden py-4 w-full">
        <div class="marquee flex items-center gap-20 whitespace-nowrap">
          <!-- duplicate six logos four times for seamless loop on wide screens -->
          <template v-for="row in 4" :key="row">
            <SonyLogo
              v-for="i in 6"
              :key="`${row}-${i}`"
              class="h-12 w-auto inline-block"
            />
          </template>
        </div>
      </div>
      <h4 class="mt-10">Company</h4>
      <p class="text-3xl mt-4">
        Box Industries is a leading Mexican provider of innovative, high-quality
        packaging solutions. We help our clients develop packaging systems that
        are ready to meet the future demands of sustainability, efficiency, and
        performance.
      </p>
    </div>
  </section>
</template>

<style>
/* Continuous marquee animation */
.marquee {
  animation: marquee 18s linear infinite;
}

@keyframes marquee {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%);
  }
}
</style>
