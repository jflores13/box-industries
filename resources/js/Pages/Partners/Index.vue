<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    partners: {
        type: Array,
        default: () => [],
    },
});

// Local reactive state for optimistic updates
const localPartners = ref([...props.partners]);

// Computed sorted partners
const sortedPartners = computed(() => 
    [...localPartners.value].sort((a, b) => a.sort_order - b.sort_order)
);

function canMoveUp(partner) {
    const index = sortedPartners.value.findIndex(p => p.id === partner.id);
    return index > 0;
}

function canMoveDown(partner) {
    const index = sortedPartners.value.findIndex(p => p.id === partner.id);
    return index < sortedPartners.value.length - 1;
}

async function movePartner(partner, direction) {
    // Optimistic update - immediately update local state
    const partnerIndex = sortedPartners.value.findIndex(p => p.id === partner.id);
    const targetIndex = direction === 'up' ? partnerIndex - 1 : partnerIndex + 1;
    
    if (targetIndex < 0 || targetIndex >= sortedPartners.value.length) return;
    
    // Swap positions optimistically
    const currentPartner = sortedPartners.value[partnerIndex];
    const targetPartner = sortedPartners.value[targetIndex];
    
    const tempOrder = currentPartner.sort_order;
    currentPartner.sort_order = targetPartner.sort_order;
    targetPartner.sort_order = tempOrder;
    
    // Trigger reactivity
    localPartners.value = [...localPartners.value];
    
    try {
        // Get CSRF token from page props (more reliable than meta tag)
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                         window.Laravel?.csrfToken || 
                         '';
        
        console.log('Sending request with CSRF token:', csrfToken ? 'present' : 'missing');
        
        // Send request to backend using fetch
        const response = await fetch('/admin/partners/order', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
            },
            credentials: 'same-origin',
            body: JSON.stringify({
                partner_id: partner.id,
                direction: direction,
            }),
        });
        
        console.log('Response status:', response.status);
        
        // Check if response is ok and contains JSON
        if (!response.ok) {
            const responseText = await response.text();
            console.error('Server response error:', response.status, response.statusText, responseText);
            throw new Error(`Server responded with ${response.status}: ${response.statusText}`);
        }
        
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            const responseText = await response.text();
            console.error('Non-JSON response received:', responseText);
            throw new Error('Server returned non-JSON response');
        }
        
        const data = await response.json();
        console.log('Response data:', data);
        
        if (data.success) {
            // Update with server response to ensure consistency
            localPartners.value = data.partners;
            console.log('Partner order updated successfully');
        } else {
            console.error('Server operation failed:', data.message, data.errors);
            // Revert optimistic update on error
            const tempOrder2 = currentPartner.sort_order;
            currentPartner.sort_order = targetPartner.sort_order;
            targetPartner.sort_order = tempOrder2;
            localPartners.value = [...localPartners.value];
        }
    } catch (error) {
        console.error('Failed to update partner order:', error);
        // Revert optimistic update on error
        const tempOrder2 = currentPartner.sort_order;
        currentPartner.sort_order = targetPartner.sort_order;
        targetPartner.sort_order = tempOrder2;
        localPartners.value = [...localPartners.value];
    }
}

function moveUp(partner) {
    movePartner(partner, 'up');
}

function moveDown(partner) {
    movePartner(partner, 'down');
}
</script>

<template>
    <Head title="Partners" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Partners</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-end mb-4">
                    <Link
                        href="/admin/partners/create"
                        class="px-4 py-2 bg-blue-600 text-white rounded"
                    >
                        New Partner
                    </Link>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Image
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Alt Text
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Order
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <TransitionGroup
                            tag="tbody"
                            name="partner-list"
                            class="bg-white divide-y divide-gray-200"
                        >
                            <tr v-for="partner in sortedPartners" :key="partner.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img :src="`/storage/${partner.image_path}`" :alt="partner.alt_text" class="h-16 w-16 object-cover rounded" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ partner.alt_text || 'No alt text' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <button
                                            @click="moveUp(partner)"
                                            :disabled="!canMoveUp(partner)"
                                            class="p-1 text-gray-400 hover:text-gray-600 disabled:text-gray-300 disabled:cursor-not-allowed transition-colors"
                                            title="Move up"
                                        >
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <span class="text-sm text-gray-500 min-w-[1.5rem] text-center">{{ partner.sort_order }}</span>
                                        <button
                                            @click="moveDown(partner)"
                                            :disabled="!canMoveDown(partner)"
                                            class="p-1 text-gray-400 hover:text-gray-600 disabled:text-gray-300 disabled:cursor-not-allowed transition-colors"
                                            title="Move down"
                                        >
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <Link
                                        :href="`/admin/partners/${partner.id}/edit`"
                                        class="text-indigo-600 hover:text-indigo-900"
                                    >
                                        Edit
                                    </Link>
                                </td>
                            </tr>
                        </TransitionGroup>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.partner-list-move,
.partner-list-enter-active,
.partner-list-leave-active {
    transition: all 0.3s ease;
}

.partner-list-enter-from,
.partner-list-leave-to {
    opacity: 0;
    transform: translateY(20px);
}

.partner-list-leave-active {
    position: absolute;
    width: 100%;
}
</style>
