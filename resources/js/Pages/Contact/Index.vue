<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Hero from '@/Pages/Contact/Hero.vue';
import { useTexts } from '@/composables/useTexts';

defineOptions({ layout: AppLayout });

const { texts: contactTexts } = useTexts('contact');
</script>

<template>
  <Head :title="contactTexts.title || 'Contact'" />

  <!-- Location and contact information -->
  <Hero />

  <!-- Contact form -->
  <section class="bg-box-brown text-white">
    <div class="max-w-7xl mx-auto px-6 py-24">
      <h2 class="text-5xl md:text-6xl font-bold mb-16 text-box-yellow-light leading-tight">
        {{ contactTexts.form_title }}
      </h2>
      <form class="space-y-12">
        <!-- First row: First Name and Last Name -->
        <div class="grid md:grid-cols-2 gap-12">
          <div class="space-y-3">
            <label for="first_name" class="contact-form-label">
              {{ contactTexts.form_name_title }}*
            </label>
            <input 
              id="first_name" 
              type="text" 
              :placeholder="contactTexts.form_name_placeholder"
              class="contact-form-input"
            />
          </div>
          <div class="space-y-3">
            <label for="last_name" class="contact-form-label">
              {{ contactTexts.form_name_title }}*
            </label>
            <input 
              id="last_name" 
              type="text" 
              :placeholder="contactTexts.form_name_placeholder"
              class="contact-form-input"
            />
          </div>
        </div>
        
        <!-- Second row: Email and Company Name -->
        <div class="grid md:grid-cols-2 gap-12">
          <div class="space-y-3">
            <label for="email" class="contact-form-label">
              {{ contactTexts.form_email_title }}*
            </label>
            <input 
              id="email" 
              type="email" 
              :placeholder="contactTexts.form_email_placeholder"
              class="contact-form-input"
            />
          </div>
          <div class="space-y-3">
            <label for="company" class="contact-form-label">
              {{ contactTexts.form_company_title }}*
            </label>
            <input 
              id="company" 
              type="text" 
              :placeholder="contactTexts.form_company_placeholder"
              class="contact-form-input"
            />
          </div>
        </div>
        
        <!-- Message field -->
        <div class="space-y-3">
          <label for="message" class="contact-form-label">
            {{ contactTexts.form_message_title }}*
          </label>
          <textarea 
            id="message" 
            rows="6" 
            :placeholder="contactTexts.form_message_placeholder"
            class="contact-form-input resize-none"
          ></textarea>
        </div>
        
        <!-- Submit button -->
        <div class="pt-8">
          <button 
            type="submit" 
            class="bg-box-yellow-light text-box-brown px-8 py-4 text-lg font-semibold hover:bg-box-yellow-light/90 transition-colors duration-200"
          >
            {{ contactTexts.form_submit_button }}
          </button>
        </div>
      </form>
    </div>
  </section>
</template>
