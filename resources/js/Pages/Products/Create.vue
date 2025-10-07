<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    short_en: '',
    short_es: '',
    long_en: '',
    long_es: '',
    slug: '',
    button_en: '',
    button_es: '',
    button_link: '',
    home_en: '',
    home_es: '',
    image_src: '',
    booklet_src: '',
    product_id: '',
    category: '',
    tags: '',
    on_carrousel: false,
});

function submit() {
    form.post('/admin/products');
}
</script>

<template>
    <Head title="Create Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Product
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="bg-white shadow sm:rounded-lg p-6 space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input v-model="form.name" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        <span v-if="form.errors.name" class="text-red-500 text-xs">{{ form.errors.name }}</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Slug</label>
                        <input v-model="form.slug" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        <span v-if="form.errors.slug" class="text-red-500 text-xs">{{ form.errors.slug }}</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Short Description</label>
                        <textarea v-model="form.short_en" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Short description (EN)"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Short Description (ES)</label>
                        <textarea v-model="form.short_es" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Descripción corta (ES)"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Long Description</label>
                        <textarea v-model="form.long_en" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Long description (EN)"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Long Description (ES)</label>
                        <textarea v-model="form.long_es" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Descripción larga (ES)"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Button Text</label>
                            <input v-model="form.button_en" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Button (EN)" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Button Text (ES)</label>
                            <input v-model="form.button_es" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Botón (ES)" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Button Link</label>
                        <input v-model="form.button_link" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Home Text (EN)</label>
                            <input v-model="form.home_en" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Home Text (ES)</label>
                            <input v-model="form.home_es" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Image Src</label>
                            <input v-model="form.image_src" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                            <span v-if="form.errors.image_src" class="text-red-500 text-xs">{{ form.errors.image_src }}</span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Booklet Src</label>
                            <input v-model="form.booklet_src" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                            <span v-if="form.errors.booklet_src" class="text-red-500 text-xs">{{ form.errors.booklet_src }}</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Product ID</label>
                        <input v-model="form.product_id" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        <span v-if="form.errors.product_id" class="text-red-500 text-xs">{{ form.errors.product_id }}</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Category</label>
                        <input v-model="form.category" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        <span v-if="form.errors.category" class="text-red-500 text-xs">{{ form.errors.category }}</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tags</label>
                        <input v-model="form.tags" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        <span v-if="form.errors.tags" class="text-red-500 text-xs">{{ form.errors.tags }}</span>
                    </div>

                    <div class="flex items-center">
                        <input id="on_carrousel" v-model="form.on_carrousel" type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded" />
                        <label for="on_carrousel" class="ml-2 block text-sm text-gray-700">Show on Carousel</label>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
