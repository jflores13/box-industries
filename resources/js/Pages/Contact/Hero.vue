<template>
  <section class="relative w-full pt-40 bg-gray-100">

    <!-- Hero content -->
    <div
      class="relative z-10 flex flex-col justify-center max-w-7xl mx-auto px-6"
    >

      <h1 class="mt-4 text-black font-extrabold leading-tight text-5xl sm:text-6xl md:text-7xl lg:text-8xl mb-10">
        Contact and Location
      </h1>
      <div class="w-full h-auto">
        <img
          src="/img/Contact.jpg"
          alt="Contact and Location Hero"
          class="w-full h-full object-cover"
        />
      </div>
      <div class="w-full text-center md:text-left my-10 text-black flex flex-col md:flex-row">
        <div class="w-full md:w-1/3">
            <h2 class="text-2xl font-semibold mb-2">Plant</h2>
            <p class="text-lg">
              Carretera Loma Alta 1418-A<br>
              Col. Rural<br>
              CP 25350 Arteaga, Coahuila, MX.<br>
              Entrada por Libramiento Oscar<br>
              Flores Tapia
            </p>
          </div>
          <div class="w-full md:w-1/3">
            <h2 class="text-2xl font-semibold mb-2">Office Hours</h2>
            <p class="text-lg">
              Mon – Fri, 8:00am to 6:00pm<br>
              Sat, 9:00am to 1:00pm
            </p>
          </div>
          <div class="w-full md:w-1/3">
            <h2 class="text-2xl font-semibold mb-2">Phone</h2>
            <p class="text-lg">(844) 135 0938</p>
            <p class="text-lg">(844) 413 3137</p>
            <br>
            <p class="text-lg">Sales: Ext. 01</p>
            <p class="text-lg">Invoicing: Ext. 02</p>
            <p class="text-lg">Payments: Ext. 03</p>

          </div>
      </div>

    </div>

    <!-- WhatsApp floating button -->
    <WhatsappButton class="w-10 h-10 mb-10 mr-10 drop-shadow-md" />
  </section>
</template>

<script setup>
import WhatsappButton from '@/Components/Buttons/WhatsappButton.vue';

</script>
