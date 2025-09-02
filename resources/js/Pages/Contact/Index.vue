<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import TheFooter from '@/Components/TheFooter.vue';

defineOptions({ layout: AppLayout });
</script>

<template>
  <Head title="Contact" />

  <!-- Location and contact information -->
  <section class="bg-white text-box-brown">
    <div class="max-w-7xl mx-auto px-6 py-24">
      <h1 class="text-5xl md:text-6xl font-bold mb-12">Contact and Location</h1>
      <div class="grid md:grid-cols-2 gap-10 items-start">
        <img src="/img/BXIN-Forklift.jpg" alt="Plant" class="w-full h-auto rounded-lg object-cover" />
        <div class="flex flex-col gap-8 text-lg">
          <div>
            <h2 class="font-semibold mb-2">Plant</h2>
            <p>
              Cerritos Loma Alta 119-A<br>
              Boca del Oso<br>
              Industrial Park<br>
              Saltillo, Coahuila
            </p>
          </div>
          <div>
            <h2 class="font-semibold mb-2">Office Hours</h2>
            <p>
              Mon – Fri, 8:00am to 6:00pm<br>
              Sat, 9:00am to 1:00pm
            </p>
          </div>
          <div>
            <h2 class="font-semibold mb-2">Phone</h2>
            <p>(234) 562 620</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact form -->
  <section class="bg-box-brown text-white">
    <div class="max-w-4xl mx-auto px-6 py-24">
      <h2 class="text-5xl md:text-6xl font-bold mb-16 text-box-yellow-light leading-tight">Send us<br>a message</h2>
      <form class="space-y-12">
        <!-- First row: First Name and Last Name -->
        <div class="grid md:grid-cols-2 gap-12">
          <div class="space-y-3">
            <label for="first_name" class="block text-box-yellow-light text-sm font-medium">First Name*</label>
            <input 
              id="first_name" 
              type="text" 
              placeholder="Your first name"
              class="w-full bg-transparent border-0 border-b border-box-yellow-light text-box-yellow-light placeholder-box-yellow-light/70 focus:border-box-yellow-light focus:ring-0 pb-2 text-lg"
            />
          </div>
          <div class="space-y-3">
            <label for="last_name" class="block text-box-yellow-light text-sm font-medium">Last Name*</label>
            <input 
              id="last_name" 
              type="text" 
              placeholder="Your last name"
              class="w-full bg-transparent border-0 border-b border-box-yellow-light text-box-yellow-light placeholder-box-yellow-light/70 focus:border-box-yellow-light focus:ring-0 pb-2 text-lg"
            />
          </div>
        </div>
        
        <!-- Second row: Email and Company Name -->
        <div class="grid md:grid-cols-2 gap-12">
          <div class="space-y-3">
            <label for="email" class="block text-box-yellow-light text-sm font-medium">Email*</label>
            <input 
              id="email" 
              type="email" 
              placeholder="Your email"
              class="w-full bg-transparent border-0 border-b border-box-yellow-light text-box-yellow-light placeholder-box-yellow-light/70 focus:border-box-yellow-light focus:ring-0 pb-2 text-lg"
            />
          </div>
          <div class="space-y-3">
            <label for="company" class="block text-box-yellow-light text-sm font-medium">Company Name*</label>
            <input 
              id="company" 
              type="text" 
              placeholder="Your company name"
              class="w-full bg-transparent border-0 border-b border-box-yellow-light text-box-yellow-light placeholder-box-yellow-light/70 focus:border-box-yellow-light focus:ring-0 pb-2 text-lg"
            />
          </div>
        </div>
        
        <!-- Message field -->
        <div class="space-y-3">
          <label for="message" class="block text-box-yellow-light text-sm font-medium">Message*</label>
          <textarea 
            id="message" 
            rows="6" 
            placeholder="Send us your message"
            class="w-full bg-transparent border-0 border-b border-box-yellow-light text-box-yellow-light placeholder-box-yellow-light/70 focus:border-box-yellow-light focus:ring-0 pb-2 text-lg resize-none"
          ></textarea>
        </div>
        
        <!-- Submit button -->
        <div class="pt-8">
          <button 
            type="submit" 
            class="bg-box-yellow-light text-box-brown px-8 py-4 text-lg font-semibold hover:bg-box-yellow-light/90 transition-colors duration-200"
          >
            Submit
          </button>
        </div>
      </form>
    </div>
  </section>

  <TheFooter mode="dark" />
</template>

