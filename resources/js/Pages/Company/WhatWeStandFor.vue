<template>
  <section class="bg-gray-100">
    <div class="max-w-7xl mx-auto px-6">
      <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-16">
        {{ companyTexts.what_we_do_title }}
      </h2>

      <div class="space-y-16">
        <!-- We analyze -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
          <div class="aspect-video bg-gray-300 overflow-hidden">
            <img 
              src="/img/company/analyze.webp" 
              alt="Team member analyzing packaging solutions" 
              class="w-full h-full object-cover"
            />
          </div>
          <div>
            <h3 class="text-3xl font-bold text-gray-900 mb-6">{{ companyTexts.we_analyze_title }}</h3>
            <p class="text-lg text-gray-700 leading-relaxed">
              {{ companyTexts.we_analyze_description }}
            </p>
          </div>
        </div>

        <!-- We adapt -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
          <div class="aspect-video bg-gray-300 overflow-hidden">
            <img 
              src="/img/company/adapt.webp" 
              alt="Team member working with packaging materials" 
              class="w-full h-full object-cover"
            />
          </div>
          <div>
            <h3 class="text-3xl font-bold text-gray-900 mb-6">{{ companyTexts.we_adapt_title }}</h3>
            <p class="text-lg text-gray-700 leading-relaxed">
              {{ companyTexts.we_adapt_description }}
            </p>
          </div>
        </div>

        <!-- We collaborate -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
          <div class="aspect-video bg-gray-300 overflow-hidden">
            <img 
              src="/img/company/collaborate.webp" 
              alt="Team collaborating and loading truck" 
              class="w-full h-full object-cover"
            />
          </div>
          <div>
            <h3 class="text-3xl font-bold text-gray-900 mb-6">{{ companyTexts.we_collaborate_title }}</h3>
            <p class="text-lg text-gray-700 leading-relaxed">
              {{ companyTexts.we_collaborate_description }}
            </p>
          </div>
        </div>

        <!-- We care -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
          <div class="aspect-video bg-gray-300 overflow-hidden">
            <img 
              src="/img/company/care.webp" 
              alt="Team member caring for warehouse operations" 
              class="w-full h-full object-cover"
            />
          </div>
          <div>
            <h3 class="text-3xl font-bold text-gray-900 mb-6">{{ companyTexts.we_care_title }}</h3>
            <p class="text-lg text-gray-700 leading-relaxed">
              {{ companyTexts.we_care_description }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { useTexts } from '@/composables/useTexts';

const { texts: companyTexts } = useTexts('company');

</script>