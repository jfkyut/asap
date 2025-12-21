<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const stats = [
    { label: 'Total Balance', value: '$12,450.50', icon: 'ri-wallet-3-line', color: 'bg-blue-500' },
    { label: 'Income', value: '+$5,200.00', icon: 'ri-arrow-up-line', color: 'bg-green-500' },
    { label: 'Expenses', value: '-$1,850.30', icon: 'ri-arrow-down-line', color: 'bg-red-500' },
    { label: 'Savings Goal', value: '68%', icon: 'ri-goal-line', color: 'bg-purple-500' },
];

const recentTransactions = [
    { id: 1, description: 'Coffee at Cafe Noir', amount: '-$5.50', type: 'expense', date: 'Today', icon: 'ri-takeaway-line' },
    { id: 2, description: 'Salary Deposit', amount: '+$3,500.00', type: 'income', date: 'Yesterday', icon: 'ri-bank-card-line' },
    { id: 3, description: 'Electric Bill Payment', amount: '-$125.00', type: 'expense', date: 'Dec 19', icon: 'ri-flashlight-line' },
    { id: 4, description: 'Freelance Project', amount: '+$850.00', type: 'income', date: 'Dec 18', icon: 'ri-briefcase-line' },
    { id: 5, description: 'Gym Membership', amount: '-$45.00', type: 'expense', date: 'Dec 17', icon: 'ri-heart-pulse-line' },
];

const quickActions = [
    { label: 'Send Money', icon: 'ri-send-plane-line' },
    { label: 'Request Money', icon: 'ri-hand-coin-line' },
    { label: 'Add Card', icon: 'ri-bank-card-2-line' },
    { label: 'Invoice', icon: 'ri-file-invoice-line' },
];
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Welcome back! 👋</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Here's your financial overview</p>
                </div>
            </div>
        </template>

        <div class="p-4 sm:p-8 max-w-7xl mx-auto">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div v-for="stat in stats" :key="stat.label" class="bg-white dark:bg-zinc-700 rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">{{ stat.label }}</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ stat.value }}</p>
                        </div>
                        <div :class="`${stat.color} rounded-lg p-3 text-white`">
                            <i :class="`${stat.icon} text-xl`"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <button v-for="action in quickActions" :key="action.label" class="bg-white dark:bg-zinc-700 rounded-lg shadow-sm p-6 hover:shadow-md transition-all hover:scale-105 active:scale-95">
                        <div class="flex flex-col items-center gap-2">
                            <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg p-3 text-white">
                                <i :class="`${action.icon} text-xl`"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300 text-center">{{ action.label }}</span>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="bg-white dark:bg-zinc-700 rounded-lg shadow-sm">
                <div class="p-6 border-b dark:border-zinc-600">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Transactions</h3>
                        <a href="#" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 text-sm font-medium">View All</a>
                    </div>
                </div>
                <div class="divide-y dark:divide-zinc-600">
                    <div v-for="transaction in recentTransactions" :key="transaction.id" class="p-6 hover:bg-gray-50 dark:hover:bg-zinc-600 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div :class="`rounded-full p-3 ${transaction.type === 'income' ? 'bg-green-100 dark:bg-green-900' : 'bg-red-100 dark:bg-red-900'}`">
                                    <i :class="`${transaction.icon} text-lg ${transaction.type === 'income' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'}`"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ transaction.description }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ transaction.date }}</p>
                                </div>
                            </div>
                            <span :class="`font-semibold ${transaction.type === 'income' ? 'text-green-600 dark:text-green-400' : 'text-gray-900 dark:text-white'}`">
                                {{ transaction.amount }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Savings Goal Progress -->
            <div class="mt-8 bg-white dark:bg-zinc-700 rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Savings Goal</h3>
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">$8,450 / $12,500</span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-zinc-600 rounded-full h-3 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-3 rounded-full" style="width: 68%"></div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">You're 68% towards your goal. Keep it up! 🎯</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
