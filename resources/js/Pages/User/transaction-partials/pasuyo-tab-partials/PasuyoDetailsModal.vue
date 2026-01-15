<script setup>

import Modal from '@/Components/Modal.vue';
import Container from '@/Components/Container.vue';
import { useTransactions } from '@/Composables/transactions';
import { Tag } from 'primevue';
import { ref } from 'vue';

defineProps({
    pasuyo: Object,
    show: {
        type: Boolean,
        default: false,
    }
})

const { getStatusSeverity, formatDate } = useTransactions();

</script>

<template>
    <button class="flex-shrink-0 text-blue-600 dark:text-blue-400 font-semibold hover:text-blue-700 dark:hover:text-blue-300">
        →
    </button>

    <Modal
        :show="show"
        @close="$emit('close')"
    >
        <Container>
            <template #header>
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Pasayo Details</h3>
                    <Tag :value="pasuyo.status.replace('_', ' ')" :severity="getStatusSeverity(pasuyo.status)" />
                </div>
            </template>
            
            <template #body>
                <div class="space-y-4">
                    <!-- Personal Info Section -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 border-l-4 border-blue-500 space-y-3">
                        <h4 class="text-sm font-semibold text-blue-900 dark:text-blue-200">👤 Personal Information</h4>
                        <div class="space-y-2.5">
                            <div>
                                <p class="text-xs font-semibold text-zinc-600 dark:text-zinc-400 uppercase tracking-wide mb-1">Full Name</p>
                                <p class="text-sm text-zinc-900 dark:text-white">{{ pasuyo.full_name }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-zinc-600 dark:text-zinc-400 uppercase tracking-wide mb-1">Phone</p>
                                <p class="text-sm text-zinc-900 dark:text-white">{{ pasuyo.phone }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Location Section -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 border-l-4 border-blue-500">
                        <h4 class="text-sm font-semibold text-blue-900 dark:text-blue-200 mb-3">📍 Location</h4>
                        <p class="text-sm text-zinc-900 dark:text-white">{{ pasuyo.location }}</p>
                    </div>

                    <!-- Item & Budget Section -->
                    <div class="bg-amber-50 dark:bg-amber-900/20 rounded-lg p-4 border-l-4 border-amber-500 space-y-3">
                        <h4 class="text-sm font-semibold text-amber-900 dark:text-amber-200">📦 Order Details</h4>
                        <div class="space-y-2.5">
                            <div>
                                <p class="text-xs font-semibold text-zinc-600 dark:text-zinc-400 uppercase tracking-wide mb-1">What to Buy</p>
                                <p class="text-sm text-zinc-900 dark:text-white">{{ pasuyo.content }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <p class="text-xs font-semibold text-zinc-600 dark:text-zinc-400 uppercase tracking-wide mb-1">Budget</p>
                                    <p class="text-sm font-semibold text-zinc-900 dark:text-white">₱{{ pasuyo.budget }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-zinc-600 dark:text-zinc-400 uppercase tracking-wide mb-1">Payment</p>
                                    <p class="text-sm text-zinc-900 dark:text-white">{{ pasuyo.payment_method || '—' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Note Section -->
                    <div v-if="pasuyo.note" class="bg-purple-50 dark:bg-purple-900/20 rounded-lg p-4 border-l-4 border-purple-500">
                        <h4 class="text-sm font-semibold text-purple-900 dark:text-purple-200 mb-2">📝 Additional Note</h4>
                        <p class="text-sm text-zinc-900 dark:text-white italic">{{ pasuyo.note }}</p>
                    </div>

                    <!-- Date Section -->
                    <div class="bg-zinc-50 dark:bg-zinc-800/30 rounded-lg p-4">
                        <p class="text-xs font-semibold text-zinc-600 dark:text-zinc-400 uppercase tracking-wide mb-1">Created</p>
                        <p class="text-sm text-zinc-900 dark:text-white">{{ formatDate(pasuyo.created_at) }}</p>
                    </div>
                </div>
            </template>
        </Container>
    </Modal>
</template>