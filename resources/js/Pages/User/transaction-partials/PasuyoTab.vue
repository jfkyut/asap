<script setup>

import { useTransactions } from '@/Composables/transactions';
import { Button, Tag } from 'primevue';

defineProps({
    pasuyos: Array,
});

const {
    formatDate,
    getStatusSeverity,
    formatTime
} = useTransactions();

</script>

<template>
    <div value="pasuyos" >
        <!-- Empty State -->
        <div v-if="!pasuyos || pasuyos.length === 0" class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-zinc-400 dark:text-zinc-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-zinc-900 dark:text-zinc-300">No pasuyos yet</h3>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-500">Get started by creating your first pasayo transaction.</p>
        </div>

        <!-- Transactions List -->
        <div v-else class="space-y-2">
            <div v-for="pasuyo in pasuyos" :key="pasuyo.id" class="bg-white dark:bg-zinc-900 rounded-lg shadow dark:shadow-lg hover:shadow-lg dark:hover:shadow-xl transition-shadow border dark:border-zinc-800 overflow-hidden">
                <!-- Compact Header -->
                <div class="px-4 py-3 flex items-center justify-between">
                    <div class="flex items-center gap-2 flex-1 min-w-0">
                        <Tag :value="pasuyo.status.replace('_', ' ')" :severity="getStatusSeverity(pasuyo.status)" class="flex-shrink-0" />
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-zinc-900 dark:text-white truncate">{{ pasuyo.full_name }}</p>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400">📍 {{ pasuyo.location }}</p>
                        </div>
                    </div>
                    <div class="text-right flex-shrink-0 ml-3">
                        <p class="text-lg font-bold text-zinc-900 dark:text-white">₱{{ pasuyo.budget }}</p>
                    </div>
                </div>

                <!-- Summary Details -->
                <div class="px-4 py-2 bg-zinc-50 dark:bg-zinc-800/50 border-t border-zinc-200 dark:border-zinc-800">
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-xs text-zinc-600 dark:text-zinc-400 font-semibold uppercase tracking-wide mb-1">Phone</p>
                            <p class="text-zinc-900 dark:text-zinc-200 truncate">{{ pasuyo.phone }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-zinc-600 dark:text-zinc-400 font-semibold uppercase tracking-wide mb-1">Payment</p>
                            <p class="text-zinc-900 dark:text-zinc-200 truncate">{{ pasuyo.payment_method || 'Not specified' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="px-4 py-2 border-t border-zinc-200 dark:border-zinc-800 flex gap-2 justify-end">
                    <Button label="View Details" size="small" icon="pi pi-arrow-right" iconPos="right" />
                    <Button label="Edit" size="small" severity="secondary" icon="pi pi-pencil" />
                </div>
            </div>
        </div>
    </div>
</template>