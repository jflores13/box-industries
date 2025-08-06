<script setup>
import SonyLogo from '@/Components/Images/SonyLogo.vue';
</script>

<template>
  <section class="bg-gray-100 py-4">
    <div class="px-4 md:px-10 lg:px-20">
      <h4>Trust in Us</h4>

      <div class="overflow-hidden py-4 w-full">
        <!-- Track is 200% wide (two identical rows back-to-back) -->
        <div class="marquee-track flex items-center gap-20 whitespace-nowrap">
          <!-- duplicate the same six logos twice for seamless loop -->
          <template v-for="n in 2" :key="n">
            <SonyLogo
              v-for="i in 6"
              :key="`${n}-${i}`"
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
.marquee-track {
  animation: marquee 12s linear infinite;
}

@keyframes marquee {
  0% {
    transform: translateX(0%);
  }
  100% {
    transform: translateX(-50%);
  }
}
</style>
