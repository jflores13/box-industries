<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    product: Object,
});

const page = usePage();
const isSuperAdmin = computed(() => page.props.auth.user?.role === 'super_admin');

const form = useForm({
    name: props.product.name,
    short_description: props.product.short_description ?? '',
    long_description: props.product.long_description ?? '',
    slug: props.product.slug,
    button_text: props.product.button_text ?? '',
    button_link: props.product.button_link ?? '',
    image_src: props.product.image_src ?? '',
    booklet_src: props.product.booklet_src ?? '',
    product_id: props.product.product_id ?? '',
});

function submit() {
    form.put(`/products/${props.product.id}`);
}

function destroy() {
    if (confirm('Are you sure you want to delete this product?')) {
        form.delete(`/products/${props.product.id}`);
    }
}
</script>

<template>
    <Head title="Edit Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Product
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
                        <textarea v-model="form.short_description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        <span v-if="form.errors.short_description" class="text-red-500 text-xs">{{ form.errors.short_description }}</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Long Description</label>
                        <textarea v-model="form.long_description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        <span v-if="form.errors.long_description" class="text-red-500 text-xs">{{ form.errors.long_description }}</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Button Text</label>
                            <input v-model="form.button_text" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                            <span v-if="form.errors.button_text" class="text-red-500 text-xs">{{ form.errors.button_text }}</span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Button Link</label>
                            <input v-model="form.button_link" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                            <span v-if="form.errors.button_link" class="text-red-500 text-xs">{{ form.errors.button_link }}</span>
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

                    <div class="flex justify-end space-x-2">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            Update
                        </button>
                        <button
                            v-if="isSuperAdmin"
                            @click.prevent="destroy"
                            type="button"
                            class="px-4 py-2 bg-red-600 text-white rounded"
                        >
                            Delete
                        </button>
                        <Link :href="'/products'" class="px-4 py-2 bg-gray-300 rounded">Cancel</Link>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
