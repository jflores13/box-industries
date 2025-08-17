<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Hero from '@/Pages/Products/Hero.vue';
import ProductGrid from '@/Pages/Products/ProductGrid.vue';

// Optional: see if a user is logged-in to show admin links
const page = usePage();

// Tell Inertia to keep AppLayout instance alive between pages
defineOptions({ layout: AppLayout });
</script>

<template>
  <Head title="Products" />
  <Hero />
  <div class="bg-gray-100 py-8">
    <div class="max-w-6xl mx-auto px-4">
      <h2 class="text-4xl font-bold mb-4">Our Products</h2>
    </div>
  </div>
  <ProductGrid :products="page.props.products" />
</template>