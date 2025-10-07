<template>
    <section class="bg-gray-100">
        <div class="w-full mx-auto">
            <!-- Each product row -->
            <div
                v-for="(product, index) in products as Product[]"
                :key="product.id || index"
                class="grid grid-cols-1 md:grid-cols-2 items-center"
            >
                <div 
                    :class="index % 2 === 0 ? 'order-1' : 'order-1 md:order-2'"
                    class="flex justify-center"
                >
                    <img
                        :src="product.image_src || placeholderSrc"
                        :alt="product.name || 'Product image'"
                        @error="onImgError"
                        class="w-full h-full object-cover bg-gray-200"
                    />
                </div>
                <div 
                    :class="index % 2 === 0 ? 'order-2' : 'order-2 md:order-1'" 
                    class="flex flex-col justify-center p-6"
                >
                    <h2 class="text-3xl font-semibold mb-6 text-black">
                        {{ product.name }}® - {{ product[keys.short] }}
                    </h2>
                    <p class="text-gray-700 mb-6">
                        {{ product[keys.long] || "No description provided." }}
                    </p>
                    <a
                        v-if="product.button_link"
                        :href="product.button_link"
                        target="_blank"
                        class="bg-box-brown text-box-yellow-light px-4 py-2 hover:bg-box-brown/80 w-fit"
                        type="button"
                    >
                        {{ product[keys.button] || "Get a custom quote" }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import type { Product } from '@/types/product';
import { useLocale } from '@/composables/useLocale';
import { computed } from 'vue';

const { lang } = useLocale();

// Products come in through the prop
const props = defineProps({
    products: {
        required: true,
    },
});

// Public placeholder image (served from /public/img)
const placeholderSrc = "/img/placeholder.jpeg";

const keys = computed(() => {
    return {
        name: lang.value === 'en' ? 'name_en' : 'name_es',
        short: lang.value === 'en' ? 'short_en' : 'short_es',
        long: lang.value === 'en' ? 'long_en' : 'long_es',
        button: lang.value === 'en' ? 'button_en' : 'button_es',
    }});

/**
 * If the given image fails to load, fall back to the placeholder.
 */
function onImgError(event: Event) {
    (event.target as HTMLImageElement).src = placeholderSrc;
}
</script>
