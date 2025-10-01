<template>
  <div class="relative overflow-hidden py-4 w-full bg-gray-100">
    <!-- Gradient overlays for fade effect - max 3rem width -->
    <div class="absolute left-0 top-0 w-12 h-full bg-gradient-to-r from-gray-100 to-transparent z-10 pointer-events-none"></div>
    <div class="absolute right-0 top-0 w-12 h-full bg-gradient-to-l from-gray-100 to-transparent z-10 pointer-events-none"></div>
    
    <div class="marquee-container">
      <div class="marquee-track flex items-center gap-12 whitespace-nowrap">
        <!-- Multiple sets for seamless infinite loop -->
        <template v-for="set in 6" :key="`set-${set}`">
          <div class="flex items-center gap-12 flex-shrink-0">
            <img
              v-for="partner in page.props.partners"
              :key="`set${set}-${partner.id}`"
              :src="`/storage/${partner.image_path}`"
              :alt="partner.alt_text"
              class="h-20 w-auto inline-block hover:drop-shadow-md transition-all duration-300"
            />
          </div>
        </template>
      </div>
    </div>
  </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';

const page = usePage();

</script>

<style>
/* Continuous marquee animation */
.marquee-track {
  animation: marquee 10s linear infinite;
  will-change: transform;
}

@keyframes marquee {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-16.666%); /* Move exactly 1/6th since we have 6 sets */
  }
}

/* Pause animation on hover for better UX */
.marquee-container:hover .marquee-track {
  animation-play-state: paused;
}
</style>
