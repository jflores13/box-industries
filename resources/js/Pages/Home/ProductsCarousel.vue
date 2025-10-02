
<template>
  <section class="bg-box-light-gray py-12">
    <div class="flex flex-col max-w-6xl mx-auto px-4">
      <div class="overflow-hidden">
        <div 
          class="flex gap-4 transition-transform duration-500 ease-in-out"
          :style="{ transform: `translateX(-${currentIndex * (100 / itemsPerView)}%)` }"
        >
          <div 
            v-for="(slide, index) in slides" 
            :key="index" 
            class="font-medium flex-shrink-0"
            :style="{ width: `calc(${100 / itemsPerView}% - ${(itemsPerView - 1) * 16 / itemsPerView}px)` }"
          >
            <div class="w-full aspect-square overflow-hidden mb-4">
              <img :src="slide.image" :alt="slide.description" class="w-full h-full object-cover" />
            </div>
            <p class="text-2xl leading-tight text-black">{{ slide.description }}</p>
          </div>
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
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { ProductsCarousel as slides } from '@/Pages/Home/data/ProductsCarousel'
import SlideChanger from '@/Components/SlideChanger.vue'

const currentIndex = ref(0)
const itemsPerView = ref(2)

const updateItemsPerView = () => {
  itemsPerView.value = window.innerWidth >= 768 ? 3 : 2
}

onMounted(() => {
  updateItemsPerView()
  window.addEventListener('resize', updateItemsPerView)
})

onUnmounted(() => {
  window.removeEventListener('resize', updateItemsPerView)
})

const maxIndex = computed(() => Math.max(0, slides.length - itemsPerView.value))

const next = () => {
  if (currentIndex.value < maxIndex.value) {
    currentIndex.value++
  } else {
    currentIndex.value = 0
  }
}

const previous = () => {
  if (currentIndex.value > 0) {
    currentIndex.value--
  } else {
    currentIndex.value = maxIndex.value
  }
}

</script>
