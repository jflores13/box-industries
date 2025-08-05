<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import WoodLogo from '@/Components/Images/WoodLogo.vue';
import WhiteLogo from '@/Components/Images/WhiteLogo.vue';

const isOpen = ref(false);

const page = usePage();
const currentUrl = computed(() => page.url);

function toggle() {
  isOpen.value = !isOpen.value;
}
</script>

<template>
  <div class="relative min-h-screen bg-transparent">
    <!-- Navigation -->
    <nav
      class="absolute inset-x-0 top-0 z-50 w-full flex items-center justify-between max-w-7xl mx-auto px-6 py-6 bg-transparent"
    >
      <!-- Logo -->
      <transition name="fade">
        <WoodLogo v-if="currentUrl === '/'" />
        <WhiteLogo v-else />
      </transition>

      <!-- Main links -->
      <div
        class="hidden md:flex items-center space-x-8 text-white text-sm lg:text-base font-medium"
      >
        <Link href="/products" class="hover:text-yellow-400">Products</Link>
        <Link href="/services" class="hover:text-yellow-400">Expertise</Link>
        <Link href="/company" class="hover:text-yellow-400">Company</Link>
        <Link href="/environment" class="hover:text-yellow-400">Environment</Link>
        <Link href="/careers" class="hover:text-yellow-400">Careers</Link>
        <Link href="/contact" class="hover:text-yellow-400">Contact</Link>
      </div>

      <!-- Language switch -->
      <div
        class="hidden md:flex items-center space-x-4 text-white text-sm lg:text-base font-medium"
      >
        <Link href="#" class="hover:text-yellow-400">Eng</Link>
        <Link href="#" class="hover:text-yellow-400">Spa</Link>
        <Link href="#" class="hover:text-yellow-400">Kor</Link>
      </div>
    </nav>

    <!-- Page Content -->
    <main>
      <slot />
    </main>
  </div>
</template>
