<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TheFooter from '@/Components/TheFooter.vue';
import WhatsappButton from '@/Components/Buttons/WhatsappButton.vue';
</script>

<template>
  <AppLayout>
    <!-- Hero Section -->
    <section class="relative h-screen flex flex-col justify-center items-start">
      <!-- Background image - Add your forest image to /public/img/ and update the src -->
      <div 
        class="absolute inset-0 bg-cover bg-center bg-no-repeat"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2671&q=80')"
      ></div>
      
      <!-- Content -->
      <div class="relative z-10 max-w-6xl mx-auto px-6 w-full">
        <div class="max-w-2xl">
          <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-tight mb-8">
            Responsibility for the<br>
            Next Generation
          </h1>
          <p class="text-xl text-white/90 leading-relaxed">
            At Box Industries, sustainability isn't a trend — it's a commitment. 
            We develop packaging solutions that reduce waste, optimize materials, and 
            provide innovative technologies. From sourcing to development, we are 
            constantly seeking better ways to minimize our environmental footprint while 
            maintaining performance.
          </p>
          <p class="text-xl text-white/90 leading-relaxed mt-4">
            Because protecting what matters goes beyond packaging — it's about the 
            future we help shape.
          </p>
        </div>
      </div>

      <!-- WhatsApp Button -->
      <div class="absolute bottom-8 right-8 z-20">
        <WhatsappButton />
      </div>
    </section>

    <!-- Our Responsibility Section -->
    <section class="bg-box-brown text-white py-24">
      <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-bold text-yellow-400 mb-16">
          Our responsibility
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
          <!-- Emissions -->
          <div class="space-y-6">
            <h3 class="text-2xl font-bold text-yellow-400">Emissions</h3>
            <p class="text-white leading-relaxed">
              We work with key partners who already use carbon-neutral power sources in 
              their operations, enabling Box Industries to participate in supply 
              chains that have been measured for a more balanced environmental 
              footprint in manufacturing products.
            </p>
          </div>

          <!-- Air Quality & Workspaces -->
          <div class="space-y-6">
            <h3 class="text-2xl font-bold text-yellow-400">Air Quality & Workspaces</h3>
            <p class="text-white leading-relaxed">
              Clean air standards in plants with workplace hygiene.
            </p>
            <p class="text-white leading-relaxed">
              We are committed to maintaining the health and well-being of our 
              workforce by implementing stringent measures to prevent occupational 
              accidents, reduce workload stress, and enhance physical and mental 
              well-being. Our comprehensive approach ensures safe workplace 
              conditions — providing a fulfilling environment for our team 
              throughout their career.
            </p>
          </div>

          <!-- Energy Use -->
          <div class="space-y-6">
            <h3 class="text-2xl font-bold text-yellow-400">Energy Use</h3>
            <p class="text-white leading-relaxed">
              Efficiency like no other with desired output energy.
            </p>
            <p class="text-white leading-relaxed">
              We are committed to implementing shared energy and electrical production 
              systems with solar installations, heat pumps, and energy recovery systems. 
              These innovations help us build energy optimization in our infrastructure 
              while reducing our dependence on conventional energy sources.
            </p>
          </div>

          <!-- Sustainable Products -->
          <div class="space-y-6">
            <h3 class="text-2xl font-bold text-yellow-400">Sustainable Products</h3>
            <p class="text-white leading-relaxed">
              Packaging with a enhanced life.
            </p>
            <p class="text-white leading-relaxed">
              We evaluate packaging solutions to verify they provide physical 
              protection for our customer's products and optimize materials for sustainable 
              solutions to prevent negative impacts from deficient protection of the 
              products we package, applying design procedures and manufacturing 
              approaches that fulfill preservation functions and extend the 
              useful life of packaged products.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Certification Section -->
    <section class="bg-gray-100 py-16">
      <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-gray-900 mb-12">Certification</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
          <!-- Quality Management System -->
          <div class="bg-white p-6 shadow-lg flex flex-col justify-between">
            <div class="flex items-center justify-center mb-4">
              <img src="/img/ISO.png" alt="ISO Certification" class="h-16 w-auto" />
            </div>
            <p class="text-sm font-medium mb-4 text-center">Quality Management System - ISO 9001:2015</p>
            <button class="bg-box-brown text-white px-4 py-2 text-sm hover:bg-box-brown-light transition-colors">
              Download
            </button>
          </div>

          <!-- Environmental Management System -->
          <div class="bg-white p-6 shadow-lg flex flex-col justify-between">
            <div class="flex items-center justify-center mb-4">
              <img src="/img/ISO.png" alt="ISO 14001 Certification" class="h-16 w-auto" />
            </div>
            <p class="text-sm font-medium mb-4 text-center">Environmental Management System - ISO 14001</p>
            <button class="bg-box-brown text-white px-4 py-2 text-sm hover:bg-box-brown-light transition-colors">
              Download
            </button>
          </div>

          <!-- Occupational Health & Safety -->
          <div class="bg-white p-6 shadow-lg flex flex-col justify-between">
            <div class="flex items-center justify-center mb-4">
              <img src="/img/ISO.png" alt="ISO 45001 Certification" class="h-16 w-auto" />
            </div>
            <p class="text-sm font-medium mb-4 text-center">Occupational Health & Safety Management System - ISO 45001</p>
            <button class="bg-box-brown text-white px-4 py-2 text-sm hover:bg-box-brown-light transition-colors">
              Download
            </button>
          </div>

          <!-- Food Safety Management -->
          <div class="bg-white p-6 shadow-lg flex flex-col justify-between">
            <div class="flex items-center justify-center mb-4">
              <img src="/img/PJR-UKAS.png" alt="HACCP Certification" class="h-16 w-auto" />
            </div>
            <p class="text-sm font-medium mb-4 text-center">Food Safety Management - HACCP ISO 22000</p>
            <button class="bg-box-brown text-white px-4 py-2 text-sm hover:bg-box-brown-light transition-colors">
              Download
            </button>
          </div>
        </div>

        <!-- Contact Information Box -->
        <div class="bg-box-brown text-white p-8 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
          <div>
            <h3 class="text-2xl font-bold mb-4">Nombre<br>Head of HSE</h3>
            <p class="mb-2">Teléfono</p>
            <p class="mb-4">comercial@boxindustries.com.mx</p>
            <button class="bg-yellow-400 text-box-brown px-6 py-2 font-medium hover:bg-yellow-300 transition-colors">
              Send an email
            </button>
          </div>
          <div class="h-32 bg-gray-300">
            <!-- Placeholder for contact person image -->
            <div class="w-full h-full bg-gray-400 flex items-center justify-center text-gray-600">
              Photo
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <TheFooter />
  </AppLayout>
</template>
