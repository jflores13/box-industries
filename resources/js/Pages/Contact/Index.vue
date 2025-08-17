<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
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
    <div class="max-w-7xl mx-auto px-6 py-24">
      <h2 class="text-4xl font-bold mb-10">Send us a message</h2>
      <form class="grid gap-6 md:grid-cols-2">
        <div>
          <InputLabel for="first_name" value="First Name" class="mb-1" />
          <TextInput id="first_name" type="text" class="w-full" />
        </div>
        <div>
          <InputLabel for="last_name" value="Last Name" class="mb-1" />
          <TextInput id="last_name" type="text" class="w-full" />
        </div>
        <div>
          <InputLabel for="email" value="Email" class="mb-1" />
          <TextInput id="email" type="email" class="w-full" />
        </div>
        <div>
          <InputLabel for="phone" value="Phone" class="mb-1" />
          <TextInput id="phone" type="text" class="w-full" />
        </div>
        <div>
          <InputLabel for="company" value="Your company name" class="mb-1" />
          <TextInput id="company" type="text" class="w-full" />
        </div>
        <div>
          <InputLabel for="subject" value="Subject" class="mb-1" />
          <TextInput id="subject" type="text" class="w-full" />
        </div>
        <div class="md:col-span-2">
          <InputLabel for="message" value="Send us your message" class="mb-1" />
          <textarea id="message" rows="5" class="w-full rounded-md border-gray-300 text-box-brown"></textarea>
        </div>
        <div class="md:col-span-2">
          <button type="submit" class="mt-4 bg-box-yellow-light text-box-brown px-6 py-3 hover:bg-box-yellow/90">Submit</button>
        </div>
      </form>
    </div>
  </section>

  <TheFooter mode="dark" />
</template>

