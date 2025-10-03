<script setup>
import { Link, usePage, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import WoodLogo from '@/Components/Images/WoodLogo.vue';
import WhiteLogo from '@/Components/Images/WhiteLogo.vue';
import BlackLogo from '@/Components/Images/BlackLogo.vue';
import TheFooter from '@/Components/TheFooter.vue';

const isOpen = ref(false);

const page = usePage();

function logoClick() {
  if (!isOpen.value) {
    router.visit('/')
  } else {
    isOpen.value = !isOpen.value;
  }
}

</script>

<template>
  <div class="relative min-h-screen bg-transparent"
    :class="page.props.menu_style === 'black' ? 'text-black' : 'text-white'"
  >
    <!-- Navigation -->
    <nav
      class="absolute inset-x-0 top-0 z-30 w-full flex items-center justify-between mx-auto px-6 py-6 bg-transparent max-w-7xl"
    >
      <!-- Logo -->
      <transition-group name="fade">
        <WoodLogo 
          v-if="page.props.menu_style === 'wood'" 
          class="w-36 h-auto z-50 cursor-pointer"
          @click="logoClick"
        />
        <WhiteLogo v-if="page.props.menu_style === 'white'" 
          class="w-36 h-auto z-50 cursor-pointer" 
          @click="logoClick" 
        />
        <BlackLogo v-if="page.props.menu_style === 'black'" 
          class="w-36 h-auto z-50 cursor-pointer" 
          @click="logoClick" 
        />
      </transition-group>

      <!-- Desktop menu -->
      <div 
        class="hidden md:flex items-center gap-4"
      >
        <div
          class="flex items-center text-sm bg-white/10 lg:text-base backdrop-blur font-medium"
        >
          <Link 
            href="/products" 
            class="hover:text-yellow-400 p-3"
            @click="isOpen = false"
          >Products</Link>
          <Link href="/services" class="hover:text-yellow-400 p-3" @click="isOpen = false">Expertise</Link>
          <Link href="/company" class="hover:text-yellow-400 p-3" @click="isOpen = false">Company</Link>
          <Link href="/environment" class="hover:text-yellow-400 p-3" @click="isOpen = false">Environment</Link>
          <Link href="/contact" class="hover:text-yellow-400 p-3" @click="isOpen = false">Contact</Link>
        </div>

        <div class="flex items-center text-sm bg-white/10 lg:text-base backdrop-blur font-medium">
          <Link href="#" class="hover:text-yellow-400 p-3" @click="isOpen = false">Eng</Link>
          <Link href="#" class="hover:text-yellow-400 p-3" @click="isOpen = false">Spa</Link>
        </div>
      </div>

      <!-- Burger menu -->
      <div v-if="!isOpen" class="md:hidden">
        <button @click="isOpen = !isOpen" class="focus:outline-none">
          <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>

      <!-- Mobile drop-down menu -->
      <transition name="slide-fade">
        <div
          v-if="isOpen"
          class="md:hidden absolute inset-x-0 top-0 backdrop-blur py-8 px-10 flex flex-col items-end space-y-6 z-40"
        >
          <Link href="/products" class="text-lg hover:text-yellow-400" @click="isOpen = false">Products</Link>
          <Link href="/services" class="text-lg hover:text-yellow-400" @click="isOpen = false">Expertise</Link>
          <Link href="/company" class="text-lg hover:text-yellow-400" @click="isOpen = false">Company</Link>
          <Link href="/environment" class="text-lg hover:text-yellow-400" @click="isOpen = false">Environment</Link>
          <Link href="/contact" class="text-lg hover:text-yellow-400" @click="isOpen = false">Contact</Link>
        </div>
      </transition>

    </nav>

    <!-- Page Content -->
    <main>
      <slot />
    </main>
    <TheFooter />
  </div>
</template>

<style>
.slide-fade-enter-active,
.slide-fade-leave-active {
  transition: all 0.3s ease;
}
.slide-fade-enter-from {
  opacity: 0;
  transform: translateY(-10px);
}
.slide-fade-enter-to {
  opacity: 1;
  transform: translateY(0);
}
.slide-fade-leave-from {
  opacity: 1;
  transform: translateY(0);
}
.slide-fade-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}
</style>
