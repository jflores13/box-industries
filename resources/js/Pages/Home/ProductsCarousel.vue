
<template>
  <section class="bg-box-light-gray py-12">
    <div class="max-w-6xl mx-auto px-4 md:hidden">
      <!-- Slide image -->
      <div class="w-full aspect-[3/2] overflow-hidden mb-10">
        <img
          :src="currentSlide.image"
          :alt="currentSlide.title"
          class="w-full h-full object-cover"
        />
      </div>

      <!-- Slide meta -->
      <div class="space-y-6 mb-14">
        <div class="text-2xl">
          <h4 class="text-box-brown-light font-medium tracking-widest">
            {{ slideNumber }}
          </h4>
        </div>
        <p class="text-xl leading-relaxed max-w-3xl">
          {{ currentSlide.description }}
        </p>
      </div>

      <!-- Progress indicator -->
      <div class="relative h-1 bg-box-yellow-light/40">
        <!-- Active rectangle -->
        <div
          class="absolute top-0 h-1 bg-box-yellow-light"
          :style="rectangleStyle"
        ></div>
      </div>
    </div>
    <div class="hidden md:block max-w-6xl mx-auto px-4">
      <div class="grid grid-cols-3 gap-4">
        <div v-for="slide in slides" :key="slide.title" class="font-medium ">
          <!-- Square image wrapper -->
          <div class="w-full aspect-square overflow-hidden mb-4">
            <img :src="slide.image" :alt="slide.title" class="w-full h-full object-cover" />
          </div>
          <div class="my-4 text-xl leading-tight">
            <h3 class="text-box-brown-light">{{ slideNumber }}</h3>
          </div>
          <p class="text-2xl leading-tight">{{ slide.description }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed, ref, onMounted, onUnmounted } from 'vue'
import { ProductsCarousel as slides } from '@/Pages/Home/data/ProductsCarousel'

const currentIndex = ref(0)

/* Current slide computed from index */
const currentSlide = computed(() => slides[currentIndex.value] ?? {})

/* Slide number with leading zero for single-digit indices */
const slideNumber = computed(() => {
  const num = currentIndex.value + 1 // human-friendly (1-based)
  return num < 10 ? `0${num}` : `${num}`
})

/* Width of rectangle → arbitrary (180px) but can scale; left offset based on progress */
const RECT_WIDTH = 180
const rectangleStyle = computed(() => {
  const total = Math.max(slides.length - 1, 1)
  const progress = currentIndex.value / total
  return {
    width: `${RECT_WIDTH}px`,
    left: `calc(${progress * 100}% - ${(RECT_WIDTH / 2)}px)`
  }
})

/* Auto-advance every 6 seconds (optional, remove if not needed) */
const AUTO_TIME = 6000
let timer
const createTimer = () => {
  clearTimer()
  timer = setInterval(() => {
    currentIndex.value = (currentIndex.value + 1) % slides.length
  }, AUTO_TIME)
}
const clearTimer = () => {
  if (timer) clearInterval(timer)
}

// Restart auto-advance when slide list changes
onMounted(() => {
  createTimer()
})

onUnmounted(() => {
  clearTimer()
})
</script>

<style scoped>
/* No additional styles needed; Tailwind handles most of them. */
</style>