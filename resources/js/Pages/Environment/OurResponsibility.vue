<template>
  <section class="bg-box-brown text-white py-24">
    <div class="max-w-7xl mx-auto px-6">
      <h2 class="text-4xl md:text-5xl font-bold text-yellow-400 mb-16">
        Our responsibility
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
              {{ responsibility.short_description }}
            </h4>
            <p class="text-white leading-relaxed">
              {{ responsibility.long_description }}
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>
</template>

<script setup>
const responsibilities = [
  {
    title: 'Emissions',
    img_src: '/img/responsibility/BoxIndustries-Emissions.webp',
    short_description: 'On the path to cleaner packaging operations',
    long_description: "At Box Industries, we're taking concrete steps to reduce our environmental footprint. Our ongoing efforts include the reuse and recycling of plastic and corrugated pallets, minimizing waste across our logistics processes. As we expand, we're preparing a dedicated area within our facility for recycling used cardboard — moving toward a more circular packaging model.",
  },
  
  {
    title: 'Air Quality & Workspaces',
    img_src: '/img/responsibility/BoxIndustries-AirQuality.webp',
    short_description: 'Cleaner environments for better work and better impact',
    long_description: "We are committed to maintaining clean, safe, and well-ventilated production areas. By optimizing airflow and filtering particulate matter during the handling of materials, we reduce airborne dust and improve workplace conditions — all while ensuring that our processes meet or exceed environmental standards.",
  },
  
  {
    title: 'Energy Use',
    img_src: '/img/responsibility/BoxIndustries-EnergyUse.webp',
    short_description: 'Advancing step by step toward cleaner energy',
    long_description: "We are committed to maintaining clean, safe, and well-ventilated production areas. By optimizing airflow and filtering particulate matter during the handling of materials, we reduce airborne dust and improve workplace conditions — all while ensuring that our processes meet or exceed environmental standards.",
  },
  
  {
    title: 'Sustainable Products',
    img_src: '/img/responsibility/BoxIndustries-SustainableProducts.webp',
    short_description: 'Packaging with a second life',
    long_description: "We believe packaging should do more than protect — it should protect responsibly. That's why we prioritize materials that are recyclable, reusable, and sourced responsibly. Our recycled pallet program is already active, and future developments will expand into cardboard recovery and repurposing — turning old packaging into new opportunities.",
  },
  
] 

</script>
