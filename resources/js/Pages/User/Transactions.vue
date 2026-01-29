<script setup>
import { computed, toRefs, ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
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

// Get the current status from URL query parameters
const currentStatus = ref(new URLSearchParams(window.location.search).get('status') || 'all');

const statusTabs = [
    { value: 'all', label: 'All' },
    { value: 'pending', label: 'Pending' },
    { value: 'accepted', label: 'Accepted' },
    { value: 'in_progress', label: 'In Progress' },
    {  value: 'to_pay', label: 'To Pay' },
    { value: 'completed', label: 'Completed' },
    { value: 'cancelled', label: 'Cancelled' },
];

const onStatusChange = (status) => {
    if (status === 'all') {
        router.visit(route('transaction.index'), {
            preserveScroll: true,
            preserveState: true,
        });
    } else {
        router.visit(route('transaction.index', { status }), {
            preserveScroll: true,
            preserveState: true,
        });
    }
};

const getTransactionType = (item) => {
    return item.sender_location ? 'pick_and_drop' : 'pasuyo';
};

const getStatusColor = (status) => {
    const colors = {
        'pending': 'warning',
        'completed': 'success',
        'in_progress': 'info',
        'to_pay': 'info',
        'cancelled': 'danger'
    };
    return colors[status] || 'secondary';
};


</script>

<template>
    <AuthenticatedLayout :has-padding="false">
        <Head title="My Transactions" />

        <template #header>
            <h2>My Transactions</h2>
        </template>

        <div>
            <div class="max-w-6xl mx-auto sm:px-0">

                <Tabs :value="currentStatus" class="w-full" @update:value="onStatusChange">
                    <div class="sticky top-10 z-20 overflow-x-auto">
                        <TabList class="flex flex-nowrap">
                            <Tab v-for="tab in statusTabs" :key="tab.value" :value="tab.value" class="flex-shrink-0">
                                {{ tab.label }}
                            </Tab>
                        </TabList>
                    </div>

                    <TabPanels >
                        <TabPanel v-for="tab in statusTabs" :key="tab.value" :value="tab.value">

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

                                    <!-- Payment Breakdown -->
                                    <div class="p-3 border-t border-zinc-100 dark:border-zinc-700 bg-white dark:bg-zinc-800">
                                        <p class="text-xs font-semibold text-zinc-600 dark:text-zinc-400 mb-3">PAYMENT DETAILS</p>
                                        <div class="space-y-2">
                                            <div class="flex justify-between items-center">
                                                <span class="text-xs text-zinc-600 dark:text-zinc-400">Bill Amount</span>
                                                <span class="text-xs font-medium text-zinc-900 dark:text-zinc-100">₱{{ transaction?.delivery?.bill_amount ? parseFloat(transaction?.delivery.bill_amount).toFixed(2) : '0.00' }}</span>
                                            </div>
                                            <div v-if="transaction?.delivery?.distance_travelled" class="flex justify-between items-center">
                                                <span class="text-xs text-zinc-600 dark:text-zinc-400">Distance Travelled</span>
                                                <span class="text-xs font-medium text-zinc-900 dark:text-zinc-100">{{ (transaction?.delivery.distance_travelled / 1000).toFixed(2) }} km</span>
                                            </div>
                                            <div v-if="transaction?.delivery?.distance_travelled" class="flex justify-between items-center">
                                                <span class="text-xs text-zinc-600 dark:text-zinc-400">Travel Fee</span>
                                                <span class="text-xs font-medium text-zinc-900 dark:text-zinc-100">₱30.00 + ₱15.00/km</span>
                                            </div>
                                            <div class="pt-2 border-t border-zinc-200 dark:border-zinc-700 flex justify-between items-center">
                                                <span class="text-xs font-semibold text-zinc-900 dark:text-zinc-100">Total Payment</span>
                                                <span class="text-sm font-bold text-emerald-600 dark:text-emerald-400">₱{{ transaction?.delivery?.total_payment ? parseFloat(transaction?.delivery?.total_payment).toFixed(2) : '0.00' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Rider Information -->
                                    <div v-if="transaction?.delivery?.rider" class="p-3 border-t border-zinc-100 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/30">
                                        <p class="text-xs font-semibold text-zinc-600 dark:text-zinc-400 mb-3">RIDER INFORMATION</p>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3 flex-1">
                                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center text-white text-xs font-semibold">
                                                    {{ transaction.delivery.rider.name.charAt(0).toUpperCase() }}
                                                </div>
                                                <div>
                                                    <p class="text-xs font-medium text-zinc-900 dark:text-zinc-100">{{ transaction.delivery.rider.name }}</p>
                                                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Rider</p>
                                                </div>
                                            </div>
                                            <a :href="`tel:${transaction.delivery.rider.phone}`" class="no-underline">
                                                <Tag
                                                    :value="transaction.delivery.rider.phone"
                                                    icon="ri-phone-line"
                                                    severity="info"
                                                    class="text-xs cursor-pointer hover:opacity-80 transition-opacity"
                                                />
                                            </a>
                                        </div>
                                    </div>

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
                        </TabPanel>
                    </TabPanels>
                </Tabs>


            </div>
        </div>
    </AuthenticatedLayout>
</template>
