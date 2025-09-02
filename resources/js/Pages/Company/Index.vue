<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TheFooter from '@/Components/TheFooter.vue';
import WhatsappButton from '@/Components/Buttons/WhatsappButton.vue';
import CSuite from '@/Pages/Company/CSuite.vue';

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
    <section class="bg-gray-50 py-16">
      <div class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
          <div class="space-y-2">
            <h3 class="text-4xl md:text-5xl font-bold text-gray-900">42+</h3>
            <p class="text-gray-600 font-medium">Employees</p>
          </div>
          <div class="space-y-2">
            <h3 class="text-4xl md:text-5xl font-bold text-gray-900">500+</h3>
            <p class="text-gray-600 font-medium">Trusted Clients</p>
          </div>
          <div class="space-y-2">
            <h3 class="text-4xl md:text-5xl font-bold text-gray-900">5.5M+</h3>
            <p class="text-gray-600 font-medium">Packaging Developed</p>
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
          What we stand for
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
              <h3 class="text-3xl font-bold text-gray-900 mb-6">We analyze</h3>
              <p class="text-lg text-gray-700 leading-relaxed">
                Each packaging challenge is an opportunity to create value. 
                We apply our expertise in delivering efficient logistics 
                and strategic design solutions.
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
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <div class="aspect-video bg-gray-300 overflow-hidden">
              <img 
                src="/img/company/collaborate.webp" 
                alt="Team collaborating and loading truck" 
                class="w-full h-full object-cover"
              />
            </div>
            <div>
              <h3 class="text-3xl font-bold text-gray-900 mb-6">We collaborate</h3>
              <p class="text-lg text-gray-700 leading-relaxed">
                Our core skill lies in teamwork — both within our 
                experienced team and with our clients. We believe in integrating 
                diverse perspectives to work cooperatively towards achieving 
                shared goals.
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
    <section class="bg-box-brown text-white py-16">
      <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-bold text-yellow-400 mb-16">
          Management
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
          <!-- Jose Luis Figueroa - CEO -->
          <CSuite 
            name="Jose Luis Figueroa"
            title="CEO"
            email="comercial@boxindustries.com.mx"
            phone="(234) 562 620"
            image="/img/company/jose.webp"
          />

          <!-- Silvia Flores - CFO -->
          <CSuite 
            name="Silvia Flores"
            title="CFO"
            email="comercial@boxindustries.com.mx"
            phone="(234) 562 620"
            image="/img/company/silvia.webp"
          />

          <!-- Rosy Flores - CPC -->
          <CSuite 
            name="Rosy Flores"
            title="CPC"
            email="comercial@boxindustries.com.mx"
            phone="(234) 562 620"
            image="/img/company/rosy.webp"
          />
          
        </div>

      </div>
    </section>

    <!-- Partners Section -->
    <section class="text-black bg-gray-50 py-16">
      <div class="max-w-6xl mx-auto px-6">
          <p class="text-xl leading-relaxed">
            With over a decade of experience, Box Industries designs and manufactures 
            strategic, high-performance packaging solutions. We optimize every detail 
            — from raw materials to logistics — to deliver agile, scalable, and cost-efficient 
            results.
          </p>
          <p class="text-xl leading-relaxed mt-4">
            Trusted by leading global industries, including long-term partnerships in many 
            sectors.
          </p>
        </div>
    </section>

    <!-- Footer -->
    <TheFooter />
  </AppLayout>
</template>
