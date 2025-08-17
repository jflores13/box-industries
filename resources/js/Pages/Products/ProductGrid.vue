<template>
    <section class="bg-gray-100 py-2">
        <div class="max-w-6xl mx-auto px-4">
            <!-- Each product row -->
            <div
                v-for="(product, index) in products"
                :key="product.id || index"
                class="grid grid-cols-1 md:grid-cols-2 items-center"
            >
                <!-- Image column → odd products (index 0,2,4,...) show image first -->
                <div :class="index % 2 === 0 ? 'order-1' : 'order-2'">
                    <img
                        :src="product.img || placeholderSrc"
                        :alt="product.name || 'Product image'"
                        @error="onImgError"
                        class="w-full h-64 object-cover bg-gray-200"
                    />
                </div>

                <!-- Description column → order flips on even products -->
                <div :class="index % 2 === 0 ? 'order-2' : 'order-1'" class="flex flex-col justify-center p-6">
                    <h2 class="text-2xl font-semibold mb-4">
                        {{ product.name }}®
                    </h2>
                    <p class="text-gray-700 mb-4 min-h-[4rem]">
                        {{
                            product.short_description ||
                            "No description provided."
                        }}
                    </p>
                    <a
                        v-if="product.button_link"
                        :href="product.button_link"
                        target="_blank"
                        class="text-blue-600 hover:underline"
                    >
                        {{ product.button_text || "Learn more" }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
// Products come in through the prop
const props = defineProps({
    products: {
        type: Array,
        default: () => [],
    },
});

// Public placeholder image (served from /public/img)
const placeholderSrc = "/img/placeholder.jpeg";

/**
 * If the given image fails to load, fall back to the placeholder.
 */
function onImgError(event) {
    event.target.src = placeholderSrc;
}
</script>
