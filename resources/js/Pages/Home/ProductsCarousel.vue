
<template>
  <section class="bg-box-light-gray py-12">
    <div class="flex flex-col max-w-6xl mx-auto px-4">
      <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <div 
          v-for="(slide, index) in slides" 
          :key="slide.title" 
          class="font-medium col-span-1"
          :class="[
            index === currentIndex || index === (currentIndex + 1) % slides.length 
              ? 'block' 
              : 'hidden'
          ]"
        >
          <div class="w-full aspect-square overflow-hidden mb-4">
            <img :src="slide.image" :alt="slide.title" class="w-full h-full object-cover" />
          </div>
          <div class="my-4 text-xl leading-tight">
            <h3 class="text-box-brown-light">{{ slide.title }}</h3>
          </div>
          <p class="text-2xl leading-tight">{{ slide.description }}</p>
        </div>
      </div>
      <SlideChanger 
        class="text-box-brown"
        @next="next"
        @previous="previous"
      />
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import { ProductsCarousel as slides } from '@/Pages/Home/data/ProductsCarousel'
import SlideChanger from '@/Components/SlideChanger.vue'

const currentIndex = ref(0)

const next = () => {
  currentIndex.value = (currentIndex.value + 1) % slides.length
}

const previous = () => {
  currentIndex.value = (currentIndex.value - 1 + slides.length) % slides.length
}

</script>
