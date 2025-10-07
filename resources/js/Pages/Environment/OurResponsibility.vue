<template>
  <section class="bg-box-brown text-white py-24">
    <div class="max-w-7xl mx-auto px-6">
      <h2 class="text-4xl md:text-5xl font-bold text-yellow-400 mb-16">
        {{ environmentTexts.our_responsibility_title }}
      </h2>

      <div class="flex flex-col gap-16">
        <!-- Emissions -->
        <div 
          v-for="responsibility in responsibilities" 
          :key="responsibility.title" 
          class="flex flex-col md:flex-row gap-8"
        >
          <div class="w-full md:w-2/5">
            <img 
              :src="responsibility.img_src" 
              :alt="responsibility.title" 
              class="w-full h-full object-cover"
            >
          </div>
          <div class="w-full md:w-3/5 space-y-6">
            <h3 class="text-2xl font-bold text-white">
              {{ responsibility.title }}
            </h3>
            <h4 class="text-box-yellow">
              {{ responsibility.subtitle }}
            </h4>
            <p class="text-white leading-relaxed">
              {{ responsibility.description }}
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue';
import { useTexts } from '@/composables/useTexts';

const { texts: environmentTexts } = useTexts('environment');

const responsibilities = computed(() => [
  {
    title: environmentTexts.value?.responsibility_emissions_title,
    subtitle: environmentTexts.value?.responsibility_emissions_subtitle,
    description: environmentTexts.value?.responsibility_emissions_description,
    img_src: '/img/responsibility/BoxIndustries-Emissions.webp',
  },
  {
    title: environmentTexts.value?.responsibility_air_quality_title,
    subtitle: environmentTexts.value?.responsibility_air_quality_subtitle,
    description: environmentTexts.value?.responsibility_air_quality_description,
    img_src: '/img/responsibility/BoxIndustries-AirQuality.webp',
  },
  {
    title: environmentTexts.value?.responsibility_energy_use_title,
    subtitle: environmentTexts.value?.responsibility_energy_use_subtitle,
    description: environmentTexts.value?.responsibility_energy_use_description,
    img_src: '/img/responsibility/BoxIndustries-EnergyUse.webp',
  },
  {
    title: environmentTexts.value?.responsibility_sustainable_products_title,
    subtitle: environmentTexts.value?.responsibility_sustainable_products_subtitle,
    description: environmentTexts.value?.responsibility_sustainable_products_description,
    img_src: '/img/responsibility/BoxIndustries-SustainableProducts.webp',
  },
]);

</script>
