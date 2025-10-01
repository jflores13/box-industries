<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Hero from '@/Pages/Home/Hero.vue';
import PartnersAndCompany from '@/Pages/Home/PartnersAndCompany.vue';
import ProductsCarousel from '@/Pages/Home/ProductsCarousel.vue';
import NewGeneration from '@/Pages/Home/NewGeneration.vue';
import LearnMore from '@/Pages/Home/LearnMore.vue';
import TheFooter from '@/Components/TheFooter.vue';

// Props from backend
const props = defineProps({
    products: {
        type: Array,
        default: () => [],
    },
    carouselProducts: {
        type: Array,
        default: () => [],
    },
    partners: {
        type: Array,
        default: () => [],
    },
});

// Optional: see if a user is logged-in to show admin links
const page = usePage();
const user = page.props.auth?.user;

// Tell Inertia to keep AppLayout instance alive between pages
defineOptions({ layout: AppLayout });

</script>

<template>
  <Head title="Home" />
  <Hero />
  <PartnersAndCompany />
  <ProductsCarousel :products="carouselProducts" />
  <NewGeneration />
  <LearnMore />
  <TheFooter mode="dark" />
</template>
