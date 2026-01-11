<script setup>
import { computed, toRefs } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { 
    Button, 
    Tag,
    Tab,
    TabList,
    Tabs

} from 'primevue';

const props = defineProps({
    transactions: Object
});

const { transactions } = toRefs(props);

const pasuyos = computed(() => transactions.value?.pasuyos.data || []);

const statusSeverity = {
    pending: 'warning',
    accepted: 'info',
    in_progress: 'secondary',
    completed: 'success'
};

const getStatusSeverity = (status) => statusSeverity[status] || 'secondary';

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
};

const formatTime = (date) => {
    return new Date(date).toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit'
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="My Transactions" />

        <template #header>
            <h2>My Transactions</h2>
        </template>

        <div class="py-6 min-h-screen">
            <div class="max-w-6xl mx-auto">
                <!-- Header Section -->
                <!-- <div class="mb-8">
                    <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">Transactions</h1>
                    <p class="mt-2 text-zinc-600 dark:text-zinc-400">Manage and track all your pasuyos</p>
                </div> -->

                <!-- Empty State -->
                <div v-if="!pasuyos || pasuyos.length === 0" class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-zinc-400 dark:text-zinc-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-zinc-900 dark:text-zinc-300">No transactions</h3>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-500">Get started by creating your first pasayo transaction.</p>
                </div>

                <!-- Transactions List -->
                <div v-else class="space-y-4">
                    <div v-for="pasuyo in pasuyos" :key="pasuyo.id" class="bg-white dark:bg-zinc-900 rounded-lg shadow dark:shadow-lg overflow-hidden hover:shadow-lg dark:hover:shadow-xl transition-shadow border dark:border-zinc-800">
                        <!-- Transaction Header -->
                        <div class="p-6 border-b border-zinc-200 dark:border-zinc-800">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3">
                                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">{{ pasuyo.full_name }}</h3>
                                        <Tag :value="pasuyo.status.replace('_', ' ')" :severity="getStatusSeverity(pasuyo.status)" />
                                    </div>
                                    <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">📍 {{ pasuyo.location }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-zinc-900 dark:text-white">₱{{ pasuyo.budget }}</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-500 mt-1">{{ formatDate(pasuyo.created_at) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Transaction Details -->
                        <div class="px-6 py-4 bg-zinc-50 dark:bg-zinc-800 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <p class="text-xs text-zinc-600 dark:text-zinc-400 font-semibold uppercase tracking-wide">Phone</p>
                                <p class="text-sm text-zinc-900 dark:text-zinc-200 font-medium mt-1">{{ pasuyo.phone }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-zinc-600 dark:text-zinc-400 font-semibold uppercase tracking-wide">Payment Method</p>
                                <p class="text-sm text-zinc-900 dark:text-zinc-200 font-medium mt-1">{{ pasuyo.payment_method || 'Not specified' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-zinc-600 dark:text-zinc-400 font-semibold uppercase tracking-wide">Last Updated</p>
                                <p class="text-sm text-zinc-900 dark:text-zinc-200 font-medium mt-1">{{ formatDate(pasuyo.updated_at) }}</p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-800 flex gap-2 justify-end">
                            <Button label="View Details" icon="pi pi-arrow-right" iconPos="right" />
                            <Button label="Edit" severity="secondary" icon="pi pi-pencil" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>