<template>
  <div class="mt-4 flex w-full justify-end items-center" :class="position">
    <ChevronLeft 
    @click="previous"
    class="w-10 h-10 hover:scale-110 transition-all duration-300 drop-shadow-md" />
    <ChevronRight 
    @click="next"
    class="w-10 h-10 hover:scale-110 transition-all duration-300 drop-shadow-md" />
  </div>
</template>

<script setup>
import { ChevronLeft, ChevronRight } from 'lucide-vue-next'

const emit = defineEmits(['next', 'previous'])

const next = () => {
  emit('next')
}

const previous = () => {
  emit('previous')
}
</script>
