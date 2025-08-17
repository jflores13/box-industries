<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TheFooter from '@/Components/TheFooter.vue';
import WhatsappButton from '@/Components/Buttons/WhatsappButton.vue';
</script>

<template>
  <AppLayout>
    <!-- Hero Section -->
    <section class="relative h-screen flex flex-col justify-center items-start">
      <!-- Background image - Team photo -->
      <div 
        class="absolute inset-0 bg-cover bg-center bg-no-repeat"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)), url('/img/Company.jpg')"
      ></div>
      
      <!-- Content -->
      <div class="relative z-10 max-w-6xl mx-auto px-6 w-full">
        <div class="max-w-2xl">
          <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-tight mb-8">
            The Packaging<br>
            Solutions Company
          </h1>
          <p class="text-xl text-white/90 leading-relaxed">
            Box Industries was founded in 2008 in Arteaga, Coahuila. Since then, we've 
            specialized in designing and manufacturing custom packaging solutions — 
            from corrugated boxes to returnable plastic systems — tailored to the 
            needs of today's industries.
          </p>
        </div>
      </div>

      <!-- WhatsApp Button -->
      <div class="absolute bottom-8 right-8 z-20">
        <WhatsappButton />
      </div>
    </section>

    <!-- Statistics Section -->
    <section class="bg-white py-16">
      <div class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
          <div class="space-y-2">
            <h3 class="text-4xl md:text-5xl font-bold text-gray-900">42+</h3>
            <p class="text-gray-600 font-medium">Employees</p>
          </div>
          <div class="space-y-2">
            <h3 class="text-4xl md:text-5xl font-bold text-gray-900">500+</h3>
            <p class="text-gray-600 font-medium">Product Units</p>
          </div>
          <div class="space-y-2">
            <h3 class="text-4xl md:text-5xl font-bold text-gray-900">5.5M+</h3>
            <p class="text-gray-600 font-medium">Packaging Advanced</p>
          </div>
          <div class="space-y-2">
            <h3 class="text-4xl md:text-5xl font-bold text-gray-900">2008</h3>
            <p class="text-gray-600 font-medium">Established</p>
          </div>
        </div>
      </div>
    </section>

    <!-- What We Stand For Section -->
    <section class="bg-gray-50 py-24">
      <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-16">
          What we<br>stand for
        </h2>

        <div class="space-y-16">
          <!-- We analyze -->
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
              <h3 class="text-3xl font-bold text-gray-900 mb-6">We analyze</h3>
              <p class="text-lg text-gray-700 leading-relaxed">
                Each packaging challenge is an opportunity to create value. 
                We apply our expertise in delivering efficient logistics 
                and strategic design solutions.
              </p>
            </div>
            <div class="order-1 lg:order-2">
              <div class="aspect-video bg-gray-300 rounded-lg overflow-hidden">
                <img 
                  src="/img/placeholder.jpeg" 
                  alt="Team member analyzing packaging solutions" 
                  class="w-full h-full object-cover"
                />
              </div>
            </div>
          </div>

          <!-- We adapt -->
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-1">
              <div class="aspect-video bg-gray-300 rounded-lg overflow-hidden">
                <img 
                  src="/img/placeholder.jpeg" 
                  alt="Team member working with packaging materials" 
                  class="w-full h-full object-cover"
                />
              </div>
            </div>
            <div class="order-2">
              <h3 class="text-3xl font-bold text-gray-900 mb-6">We adapt</h3>
              <p class="text-lg text-gray-700 leading-relaxed">
                Speed and flexibility are part of our DNA. We enable 
                our client's success by designing custom-made efficient systems 
                that operate seamlessly across various logistics and supply 
                chains.
              </p>
            </div>
          </div>

          <!-- We collaborate -->
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
              <h3 class="text-3xl font-bold text-gray-900 mb-6">We collaborate</h3>
              <p class="text-lg text-gray-700 leading-relaxed">
                Our core skill lies in teamwork — both within our 
                experienced team and with our clients. We believe in integrating 
                diverse perspectives to work cooperatively towards achieving 
                shared goals.
              </p>
            </div>
            <div class="order-1 lg:order-2">
              <div class="aspect-video bg-gray-300 rounded-lg overflow-hidden">
                <img 
                  src="/img/placeholder.jpeg" 
                  alt="Team collaborating and loading truck" 
                  class="w-full h-full object-cover"
                />
              </div>
            </div>
          </div>

          <!-- We care -->
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-1">
              <div class="aspect-video bg-gray-300 rounded-lg overflow-hidden">
                <img 
                  src="/img/placeholder.jpeg" 
                  alt="Team member caring for warehouse operations" 
                  class="w-full h-full object-cover"
                />
              </div>
            </div>
            <div class="order-2">
              <h3 class="text-3xl font-bold text-gray-900 mb-6">We care</h3>
              <p class="text-lg text-gray-700 leading-relaxed">
                From materials to logistics, we care about every step in 
                our process. Our dedicated teams ensure that nothing leaves 
                our manufacturing facilities without exceeding — without 
                compromising performance.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Management Section -->
    <section class="bg-box-brown text-white py-24">
      <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-bold text-yellow-400 mb-16">
          Management
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-16">
          <!-- Jose Luis Figueroa - CEO -->
          <div class="text-center">
            <div class="aspect-[3/4] bg-gray-400 rounded-lg mb-6 overflow-hidden">
              <div class="w-full h-full bg-gray-500 flex items-center justify-center text-gray-300">
                <span class="text-lg">Photo</span>
              </div>
            </div>
            <h3 class="text-xl font-bold mb-2">Jose Luis Figueroa</h3>
            <p class="text-yellow-400 font-medium">CEO</p>
          </div>

          <!-- Silvia Flores - CFO -->
          <div class="text-center">
            <div class="aspect-[3/4] bg-gray-400 rounded-lg mb-6 overflow-hidden">
              <div class="w-full h-full bg-gray-500 flex items-center justify-center text-gray-300">
                <span class="text-lg">Photo</span>
              </div>
            </div>
            <h3 class="text-xl font-bold mb-2">Silvia Flores</h3>
            <p class="text-yellow-400 font-medium">CFO</p>
          </div>

          <!-- Rosy Flores - CPC -->
          <div class="text-center">
            <div class="aspect-[3/4] bg-gray-400 rounded-lg mb-6 overflow-hidden">
              <div class="w-full h-full bg-gray-500 flex items-center justify-center text-gray-300">
                <span class="text-lg">Photo</span>
              </div>
            </div>
            <h3 class="text-xl font-bold mb-2">Rosy Flores</h3>
            <p class="text-yellow-400 font-medium">CPC</p>
          </div>
        </div>

        <!-- Management Description -->
        <div class="max-w-4xl">
          <p class="text-lg leading-relaxed text-white/90">
            With over a decade of experience, Box Industries designs and manufactures 
            strategic, high-performance packaging solutions. We optimize every detail 
            — from raw materials to logistics — to deliver agile, scalable, and cost-efficient 
            results.
          </p>
          <p class="text-lg leading-relaxed text-white/90 mt-4">
            Trusted by leading global industries, including long-term partnerships in many 
            sectors.
          </p>
        </div>
      </div>
    </section>

    <!-- Partners Section -->
    <section class="bg-white py-16">
      <div class="max-w-6xl mx-auto px-6">
        <div class="flex flex-wrap items-center justify-center gap-12 opacity-60">
          <!-- in Group -->
          <div class="h-12 flex items-center">
            <span class="text-2xl font-bold text-gray-600">in Group</span>
          </div>
          
          <!-- Tesla -->
          <div class="h-12 flex items-center">
            <span class="text-2xl font-bold text-gray-600 tracking-wider">TESLA</span>
          </div>
          
          <!-- Volkswagen -->
          <div class="h-12 flex items-center">
            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
              <span class="text-white font-bold text-sm">VW</span>
            </div>
          </div>
          
          <!-- Sony -->
          <div class="h-12 flex items-center">
            <span class="text-2xl font-bold text-gray-600">SONY</span>
          </div>
          
          <!-- Adidas -->
          <div class="h-12 flex items-center">
            <span class="text-2xl font-bold text-gray-600">adidas</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <TheFooter />
  </AppLayout>
</template>
