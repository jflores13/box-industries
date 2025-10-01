<template>
  <footer 
    class="py-12"
    :class="page.props.footer_style === 'light' ? 'bg-box-light-gray text-black' : 'bg-box-brown text-white'"
  >
    <div class="max-w-6xl mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <div class="col-span-1 flex flex-col justify-start md:justify-end items-start">
          <div class="flex items-center gap-2">
            <img src="/img/PJR-UKAS.png" alt="Certification" class="h-10 w-auto" />
            <img src="/img/ISO.png" alt="Certification" class="h-10 w-auto" />
          </div>
        </div>
        <div class="col-span-1 flex flex-col justify-start md:justify-end gap-6 items-center md:items-start">
          <div class="flex flex-col gap-6 md:gap-2">
            <h3 class="text-4xl font-white leading-9">
              Ready to explore new opportunities together?<br>
              Get in touch with us.
            </h3>
            <Link href="/contact" 
              class="w-fit mt-6 md:mt-20 mb-6 md:mb-28 bg-box-yellow-light text-box-brown px-6 py-3 hover:bg-box-yellow-light/90 hover:font-bold transition-colors"
              type="button"
            >
              Contact Us
            </Link>
            <p class="text-xs">Box Industries © 2025. Todos Los Derechos Reservados.
              Carretera Loma Alta 1218-A Col. Rural CP 25350 Arteaga, Coahuila.</p>
          </div>
        </div>
        <div class="col-span-1 flex flex-col gap-6">
          <div class="w-full mt-2 flex flex-col md:flex-row items-stretch justify-between">
            <div>
              <p class="text-base hidden md:block">Follow Us</p>
            </div>
            <div class="flex items-center justify-center gap-2">
              <Link href="https://google.com" as="button">
                <Facebook :mode="mode" class="w-6 h-6 cursor-pointer" />
              </Link>
              <Link href="https://google.com" as="button">
                <Instagram :mode="mode" class="w-6 h-6 cursor-pointer" />
              </Link>
              <Link href="https://google.com" as="button">
                <LinkedIn :mode="mode" class="w-6 h-6 cursor-pointer" />
              </Link>
            </div>
          </div>
          <div class="w-full">
            <p class="text-xs">
              Design & Development<br>
              Despacho Creativo del Norte + Atelier de Soto 
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import Facebook from './Images/Logos.vue/Facebook.vue';
import Instagram from './Images/Logos.vue/Instagram.vue';
import LinkedIn from './Images/Logos.vue/LinkedIn.vue';
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

defineProps({
  mode: {
    type: String,
    default: 'dark',
  },
});

const page = usePage();

</script>
