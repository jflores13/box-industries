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
            <h3 class="text-4xl font-white leading-9" v-html="footerTexts.get_in_touch_text"></h3>
            <Link
              :href="localizedPath('contact')"
              class="w-fit mt-6 md:mt-20 mb-6 md:mb-28  px-6 py-3  hover:font-bold transition-colors"
              :class="{
                'bg-box-yellow-light hover:bg-box-yellow-light/90 text-box-brown': page.props.footer_style === 'dark',
                'bg-box-brown hover:bg-box-brown/90 text-white': page.props.footer_style === 'light',
              }"
              type="button"
            >
              {{ footerTexts.contact_us_button }}
            </Link>
            <p class="text-xs">
              Box Industries © 2025. Todos Los Derechos Reservados.<br>
              Carretera Loma Alta 1418-A Col. Rural<br>
              Arteaga, Coahuila, CP 25350
            </p>
          </div>
        </div>
        <div class="col-span-1 flex flex-col justify-between gap-6">
          <div class="w-full mt-2 flex flex-col md:flex-row items-stretch justify-between">
            <div>
              <p class="text-base hidden md:block">{{ footerTexts.follow_us }}</p>
            </div>
            <div class="flex items-center justify-center gap-2">
              <a href="https://www.facebook.com/BoxIndustriesMX/" target="_blank">
                <Facebook :mode="page.props.footer_style === 'light' ? 'light' : 'dark'" class="w-6 h-6 cursor-pointer" />
              </a>
              <a href="https://instagram.com/boxindustriesmx/" target="_blank">
                <Instagram :mode="page.props.footer_style === 'light' ? 'light' : 'dark'" class="w-6 h-6 cursor-pointer" />
              </a>
              <a href="https://mx.linkedin.com/company/box-industries" target="_blank">
                <LinkedIn :mode="page.props.footer_style === 'light' ? 'light' : 'dark'" class="w-6 h-6 cursor-pointer" />
              </a>
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
import { useTexts } from '@/composables/useTexts';
import { useLocale } from '@/composables/useLocale';

defineProps({
  mode: {
    type: String,
    default: 'dark',
  },
});

const page = usePage();
const { texts: footerTexts } = useTexts('footer');
const { localizedPath } = useLocale();

</script>
