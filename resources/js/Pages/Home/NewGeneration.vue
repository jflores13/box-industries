
<template>
  <section class="bg-box-brown text-white py-12">
    <div class="max-w-6xl mx-auto px-4">
      <h4 class="text-box-yellow-light text-5xl mb-8">
        {{ homeTexts.new_generation_section_title }}
      </h4>
    </div>
    <div class="flex flex-col max-w-6xl mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div 
          v-for="(slide, index) in slides" 
          :key="slide.title" 
          class="font-medium"
          :class="{ 'hidden md:block': index !== currentIndex, 'block': index === currentIndex }"
        >
          <div class="space-y-4 col-span-1">
            <div class="w-full aspect-square overflow-hidden mb-4">
              <img :src="slide.image" :alt="slide.title" class="w-full h-full object-cover" />
            </div>
            <div class="my-4 text-xl leading-tight">
              <h3 class="text-box-yellow-light">0{{ index + 1 }}</h3>
              <h3 class="text-box-yellow-light">{{ slide.title }}</h3>
            </div>
            <p class="text-2xl leading-tight">{{ slide.description }}</p>
          </div>
        </div>
      </div>
      <SlideChanger 
        class="text-box-yellow block md:hidden"
        @next="next"
        @previous="previous"
      />
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import { NewGenSlides as slides } from '@/Pages/Home/data/NewGenSlides'
import SlideChanger from '@/Components/SlideChanger.vue'
import { useTexts } from '@/composables/useTexts';

const currentIndex = ref(0)
const { texts: homeTexts } = useTexts('home');

const next = () => {
  currentIndex.value = (currentIndex.value + 1) % slides.length
}

const previous = () => {
  currentIndex.value = (currentIndex.value - 1 + slides.length) % slides.length
}

</script>
