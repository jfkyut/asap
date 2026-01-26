<script setup>
import { computed, toRefs } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {
    Button,
    Tag,
    Tab,
    TabList,
    Tabs,
    TabPanels,
    TabPanel,
    InputText

} from 'primevue';
import PasuyoTab from './transaction-partials/PasuyoTab.vue';
import PickAndDropTab from './transaction-partials/PickAndDropTab.vue';
import PasuyoDetailsModal from './transaction-partials/pasuyo-tab-partials/PasuyoDetailsModal.vue';
import TrackingModal from '@/Components/TrackingModal.vue';
import PickAndDropDetailsModal from './transaction-partials/pickanddrop-tab-partials/PickAndDropDetailsModal.vue';

const props = defineProps({
    transactions: Array
});

const { transactions } = toRefs(props);

const getTransactionType = (item) => {
    return item.sender_location ? 'pick_and_drop' : 'pasuyo';
};

const getStatusColor = (status) => {
    const colors = {
        'pending': 'warning',
        'completed': 'success',
        'in_progress': 'info',
        'cancelled': 'danger'
    };
    return colors[status] || 'secondary';
};


</script>

<template>
    <AuthenticatedLayout>
        <Head title="My Transactions" />

        <template #header>
            <h2>My Transactions</h2>
        </template>

        <div>
            <div class="max-w-6xl mx-auto sm:px-0">

                <div v-if="transactions?.length > 0" class="space-y-2">
                    <!-- Pasuyo Card -->
                    <div
                        v-for="transaction in transactions"
                        :key="`${getTransactionType(transaction)}-${transaction.id}`"
                        class="bg-white dark:bg-zinc-800 rounded-lg shadow-sm border dark:border-zinc-700 overflow-hidden hover:shadow-md transition-shadow"
                    >
                        <!-- Pasuyo Layout -->
                        <template v-if="getTransactionType(transaction) === 'pasuyo'">
                            <!-- Header -->
                            <div class="px-3 py-2 border-b dark:border-zinc-700 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 space-y-1">
                                <div class="flex items-center justify-between">
                                    <p class="text-xs font-medium text-purple-600 dark:text-purple-400">
                                        <i class="ri-lightbulb-line mr-1"></i>Pasuyo
                                    </p>
                                    <Tag :value="transaction.status" :severity="getStatusColor(transaction.status)" class="text-xs" />
                                </div>
                                <div class="flex items-start justify-between gap-2">
                                    <h3 class="font-semibold text-sm line-clamp-1">
                                        {{ transaction.content }}
                                    </h3>
                                    <p class="text-xs text-zinc-500 whitespace-nowrap">{{ new Date(transaction.created_at).toLocaleDateString() }}</p>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="px-3 py-2 space-y-2">
                                <!-- Budget/Amount -->
                                <div class="flex items-center justify-between bg-blue-50 dark:bg-blue-900/20 rounded p-2">
                                    <span class="text-xs font-medium text-zinc-600 dark:text-zinc-300">Budget</span>
                                    <span class="font-semibold text-sm">₱{{ transaction.budget }}</span>
                                </div>

                                <!-- Item Details/Note -->
                                <div class="bg-zinc-50 dark:bg-zinc-700/50 rounded p-2">
                                    <p class="text-xs font-medium text-zinc-600 dark:text-zinc-400 mb-1">Content</p>
                                    <p v-if="transaction.content" class="text-xs leading-tight text-zinc-700 dark:text-zinc-300">{{ transaction.content }}</p>
                                    <p v-else class="text-xs text-zinc-500 italic">No content</p>
                                </div>

                                <!-- Payment Method -->
                                <div class="text-xs">
                                    <p class="text-zinc-600 dark:text-zinc-400"><strong>Payment:</strong> {{ transaction.payment_method }}</p>
                                </div>
                            </div>
                        </template>

                        <!-- PickAndDrop Layout -->
                        <template v-else>
                            <!-- Header -->
                            <div class="px-3 py-2 border-b dark:border-zinc-700 bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 space-y-1">
                                <div class="flex items-center justify-between">
                                    <p class="text-xs font-medium text-blue-600 dark:text-blue-400">
                                        <i class="ri-truck-line mr-1"></i>Pick & Drop
                                    </p>
                                    <Tag :value="transaction.status" :severity="getStatusColor(transaction.status)" class="text-xs" />
                                </div>
                                <div class="flex items-start justify-between gap-2">
                                    <h3 class="font-semibold text-sm line-clamp-1">
                                        {{ transaction.item_description }}
                                    </h3>
                                    <p class="text-xs text-zinc-500 whitespace-nowrap">{{ new Date(transaction.created_at).toLocaleDateString() }}</p>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="px-3 py-2 space-y-2">
                                <!-- From/To Route -->
                                <div class="space-y-1">
                                    <div class="flex items-start gap-2">
                                        <i class="ri-map-pin-line text-green-600 dark:text-green-400 text-xs mt-0.5"></i>
                                        <div class="flex-1 text-xs">
                                            <p class="font-medium leading-tight">{{ transaction.sender_location }}</p>
                                            <p class="text-zinc-500 text-xs">{{ transaction.sender_full_name }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-center">
                                        <i class="ri-arrow-down-line text-zinc-400"></i>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <i class="ri-map-pin-2-line text-red-600 dark:text-red-400 text-xs mt-0.5"></i>
                                        <div class="flex-1 text-xs">
                                            <p class="font-medium leading-tight">{{ transaction.receiver_location }}</p>
                                            <p class="text-zinc-500 text-xs">{{ transaction.receiver_full_name }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Method -->
                                <div class="text-xs bg-zinc-50 dark:bg-zinc-700/50 rounded p-2">
                                    <p class="text-zinc-600 dark:text-zinc-400"><strong>Payment:</strong> {{ transaction.payment_method }}</p>
                                </div>
                            </div>
                        </template>

                        <!-- Footer with Actions -->

                        <!-- Pasuyo Transaction Footer -->
                        <template v-if="getTransactionType(transaction) === 'pasuyo'">
                            <div class="px-3 py-2 border-t dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/30 flex items-center gap-2 justify-between">
                                <p class="text-xs text-zinc-500 flex-1">
                                    {{ transaction.delivery ? 'Assigned' : 'Pending' }}
                                </p>
                                <div class="flex gap-1">
                                    <TrackingModal
                                        :delivery="transaction.delivery"
                                    />
                                    <PasuyoDetailsModal
                                        :pasuyo="transaction"
                                    />
                                </div>
                            </div>
                        </template>

                        <!-- PickAndDrop Transaction Footer -->
                        <template v-else>
                            <div class="px-3 py-2 border-t dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/30 flex items-center gap-2 justify-between">
                                <p class="text-xs text-zinc-500 flex-1">
                                    {{ transaction.delivery ? 'Assigned' : 'Pending' }}
                                </p>
                                <div class="flex gap-1">
                                    <TrackingModal
                                        :delivery="transaction.delivery"
                                    />
                                    <PickAndDropDetailsModal
                                        :pick-and-drop="transaction"
                                    />
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div v-else class="flex flex-col items-center justify-center py-16">
                    <i class="ri-inbox-line text-4xl text-zinc-300 dark:text-zinc-600 mb-3"></i>
                    <p class="text-zinc-500 dark:text-zinc-400">No transactions yet</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
