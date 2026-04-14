<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    counts: {
        type: Object,
        default: () => ({
            completed: 0,
            in_progress: 0,
            pending: 0,
            accepted: 0,
            to_pay: 0,
            cancelled: 0,
        })
    }
});

// Action buttons data
const actionButtons = computed(() => [
    {
        id: 'pending',
        label: 'Pending',
        icon: 'ri-time-line',
        color: 'yellow',
        route: 'transaction.index',
        params: { status: 'pending' },
        count: props.counts.pending || 0,
        description: 'View pending transactions'
    },
    {
        id: 'accepted',
        label: 'Accepted',
        icon: 'ri-check-line',
        color: 'blue',
        route: 'transaction.index',
        params: { status: 'accepted' },
        count: props.counts.accepted || 0,
        description: 'View accepted transactions'
    },
    {
        id: 'in_progress',
        label: 'In Progress',
        icon: 'ri-map-pin-user-line',
        color: 'purple',
        route: 'transaction.index',
        params: { status: 'in_progress' },
        count: props.counts.in_progress || 0,
        description: 'Track active transactions',
        pulse: true
    },
    {
        id: 'to_pay',
        label: 'To Pay',
        icon: 'ri-money-dollar-circle-line',
        color: 'orange',
        route: 'transaction.index',
        params: { status: 'to_pay' },
        count: props.counts.to_pay || 0,
        description: 'View transactions to pay'
    },
    {
        id: 'completed',
        label: 'Completed',
        icon: 'ri-checkbox-circle-line',
        color: 'green',
        route: 'transaction.index',
        params: { status: 'completed' },
        count: props.counts.completed || 0,
        description: 'View completed transactions'
    },
    {
        id: 'cancelled',
        label: 'Cancelled',
        icon: 'ri-close-circle-line',
        color: 'red',
        route: 'transaction.index',
        params: { status: 'cancelled' },
        count: props.counts.cancelled || 0,
        description: 'View cancelled transactions'
    }
]);

// Transaction overview data
const transactionOverview = computed(() => [
    {
        id: 'pending',
        label: 'Pending Transactions',
        icon: 'ri-time-line',
        color: 'yellow',
        count: props.counts.pending || 0
    },
    {
        id: 'accepted',
        label: 'Accepted Transactions',
        icon: 'ri-check-line',
        color: 'blue',
        count: props.counts.accepted || 0
    },
    {
        id: 'in_progress',
        label: 'Active Transactions',
        icon: 'ri-map-pin-user-line',
        color: 'purple',
        count: props.counts.in_progress || 0,
        pulse: true
    },
    {
        id: 'to_pay',
        label: 'To Pay Transactions',
        icon: 'ri-money-dollar-circle-line',
        color: 'orange',
        count: props.counts.to_pay || 0
    },
    {
        id: 'completed',
        label: 'Completed Transactions',
        icon: 'ri-checkbox-circle-line',
        color: 'green',
        count: props.counts.completed || 0
    },
    {
        id: 'cancelled',
        label: 'Cancelled Transactions',
        icon: 'ri-close-circle-line',
        color: 'red',
        count: props.counts.cancelled || 0
    }
]);

const getColorClasses = (color, type = 'bg') => {
    const colors = {
        emerald: { bg: 'bg-emerald-100 dark:bg-emerald-900/30', text: 'text-emerald-600 dark:text-emerald-400', border: 'border-emerald-300 dark:border-emerald-700', btn: 'bg-emerald-500', lightBg: 'from-emerald-50 to-teal-100 dark:from-emerald-900/30 dark:to-teal-900/50', btnBorder: 'border-emerald-400 dark:border-emerald-600', btnText: 'text-emerald-900 dark:text-emerald-100', overlay: 'bg-emerald-200 dark:bg-emerald-700' },
        blue: { bg: 'bg-blue-100 dark:bg-blue-900/30', text: 'text-blue-600 dark:text-blue-400', border: 'border-blue-300 dark:border-blue-700', btn: 'bg-blue-500', lightBg: 'from-blue-50 to-cyan-100 dark:from-blue-900/30 dark:to-cyan-900/50', btnBorder: 'border-blue-400 dark:border-blue-600', btnText: 'text-blue-900 dark:text-blue-100', overlay: 'bg-blue-200 dark:bg-blue-700' },
        purple: { bg: 'bg-purple-100 dark:bg-purple-900/30', text: 'text-purple-600 dark:text-purple-400', border: 'border-purple-300 dark:border-purple-700', btn: 'bg-purple-500', lightBg: 'from-purple-50 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/50', btnBorder: 'border-purple-400 dark:border-purple-600', btnText: 'text-purple-900 dark:text-purple-100', overlay: 'bg-purple-200 dark:bg-purple-700' },
        yellow: { bg: 'bg-yellow-100 dark:bg-yellow-900/30', text: 'text-yellow-600 dark:text-yellow-400', border: 'border-yellow-300 dark:border-yellow-700', btn: 'bg-yellow-500', lightBg: 'from-yellow-50 to-cyan-100 dark:from-yellow-900/30 dark:to-cyan-900/50', btnBorder: 'border-yellow-400 dark:border-yellow-600', btnText: 'text-yellow-900 dark:text-yellow-100', overlay: 'bg-yellow-200 dark:bg-yellow-700' },
        green: { bg: 'bg-green-100 dark:bg-green-900/30', text: 'text-green-600 dark:text-green-400', border: 'border-green-300 dark:border-green-700', btn: 'bg-green-500', lightBg: 'from-green-50 to-cyan-100 dark:from-green-900/30 dark:to-cyan-900/50', btnBorder: 'border-green-400 dark:border-green-600', btnText: 'text-green-900 dark:text-green-100', overlay: 'bg-green-200 dark:bg-green-700' },
        red: { bg: 'bg-red-100 dark:bg-red-900/30', text: 'text-red-600 dark:text-red-400', border: 'border-red-300 dark:border-red-700', btn: 'bg-red-500', lightBg: 'from-red-50 to-cyan-100 dark:from-red-900/30 dark:to-cyan-900/50', btnBorder: 'border-red-400 dark:border-red-600', btnText: 'text-red-900 dark:text-red-100', overlay: 'bg-red-200 dark:bg-red-700' },
        orange: { bg: 'bg-orange-100 dark:bg-orange-900/30', text: 'text-orange-600 dark:text-orange-400', border: 'border-orange-300 dark:border-orange-700', btn: 'bg-orange-500', lightBg: 'from-orange-50 to-cyan-100 dark:from-orange-900/30 dark:to-cyan-900/50', btnBorder: 'border-orange-400 dark:border-orange-600', btnText: 'text-orange-900 dark:text-orange-100', overlay: 'bg-orange-200 dark:bg-orange-700' }
    };
    return colors[color][type] || colors[color];
};

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            Dashboard
        </template>

        <div class="sm:p-6 max-w-7xl mx-auto sm:py-6">
            <!-- Welcome Card with Profile -->
            <div class="border border-emerald-500 dark:border-emerald-800 p-2 rounded-lg flex justify-between items-center mb-4 bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20">
                <div>
                    <div class="text-xs capitalize font-bold text-zinc-900 dark:text-zinc-100">
                        Welcome back, {{ $page.props.auth.user.name }}!
                    </div>
                    <p class="text-xs text-zinc-600 dark:text-zinc-400 mt-0.5">Ready to manage your transactions today?</p>
                </div>
                <div>
                    <ApplicationLogo class="w-8" />
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mb-4">
                <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100 mb-2">Quick Actions</h3>
                <div class="grid grid-cols-2 gap-1">
                    <div
                        v-for="action in actionButtons"
                        :key="action.id"
                        @click="router.get(route(action.route, action.params))"
                        class="group relative overflow-hidden rounded-lg border-2 p-3 hover:shadow-lg transition-all duration-300 cursor-pointer"
                        :class="[getColorClasses(action.color, 'btnBorder'), getColorClasses(action.color, 'lightBg')]"
                    >
                        <div class="absolute top-0 right-0 w-12 h-12 rounded-full -mr-4 -mt-4 opacity-50 group-hover:opacity-75 transition-opacity" :class="getColorClasses(action.color, 'overlay')"></div>
                        <div class="relative z-10">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white text-sm mr-1.5" :class="getColorClasses(action.color, 'btn')">
                                    <i :class="action.icon"></i>
                                </div>
                                <span class="font-semibold text-xs" :class="getColorClasses(action.color, 'btnText')">{{ action.label }}</span>
                                <span class="ml-auto text-white text-xs px-1.5 py-0.5 rounded-full font-bold" :class="getColorClasses(action.color, 'btn')">{{ action.count }}</span>
                            </div>
                            <p class="text-zinc-700 dark:text-zinc-300 mb-1.5 text-xs leading-tight">
                                {{ action.description }}
                            </p>
                            <div class="flex items-center font-semibold text-xs hover:translate-x-1 transition-transform" :class="getColorClasses(action.color, 'text')">
                                See transactions <i class="ri-arrow-right-s-line ml-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- What You Can Do -->
            <div class="mb-6">
                <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100 mb-3">What You Can Do</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <!-- System 1 -->
                    <div @click="router.get(route('pasuyo.create'))" class="group relative overflow-hidden rounded-lg border-2 border-blue-400 dark:border-blue-600 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-900/50 p-4 hover:shadow-lg transition-all duration-300 cursor-pointer">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-blue-200 dark:bg-blue-700 rounded-full -mr-6 -mt-6 opacity-50 group-hover:opacity-75 transition-opacity"></div>

                        <div class="relative z-10">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white text-sm mr-2 flex-shrink-0">
                                    <i class="ri-run-line"></i>
                                </div>
                                <h4 class="text-sm font-bold text-zinc-900 dark:text-white">
                                    Pasuyo
                                </h4>
                            </div>

                            <p class="text-zinc-700 dark:text-zinc-300 mb-2 text-xs leading-tight">
                                Request errands from a rider.
                            </p>

                            <div class="flex items-center text-blue-600 dark:text-blue-400 font-semibold text-xs hover:translate-x-1 transition-transform">
                                Request
                                <span class="ml-1">→</span>
                            </div>
                        </div>
                    </div>

                    <!-- System 2 -->
                    <div @click="router.get(route('pick-and-drop.create'))" class="group relative overflow-hidden rounded-lg border-2 border-purple-400 dark:border-purple-600 bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-900/50 p-4 hover:shadow-lg transition-all duration-300 cursor-pointer">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-purple-200 dark:bg-purple-700 rounded-full -mr-6 -mt-6 opacity-50 group-hover:opacity-75 transition-opacity"></div>

                        <div class="relative z-10">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center text-white text-sm mr-2 flex-shrink-0">
                                    <i class="ri-route-line"></i>
                                </div>
                                <h4 class="text-sm font-bold text-zinc-900 dark:text-white">
                                    Pick & Drop
                                </h4>
                            </div>

                            <p class="text-zinc-700 dark:text-zinc-300 mb-2 text-xs leading-tight">
                                Get it there.
                            </p>

                            <div class="flex items-center text-purple-600 dark:text-purple-400 font-semibold text-xs hover:translate-x-1 transition-transform">
                                Request
                                <span class="ml-1">→</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction Status Summary -->
            <div class="mb-4">
                <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100 mb-2">Transaction Overview</h3>
                <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-3">
                    <div class="space-y-2">
                        <div
                            v-for="item in transactionOverview"
                            :key="item.id"
                            class="flex items-center justify-between"
                        >
                            <div class="flex items-center">
                                <div :class="['w-6 h-6 rounded-full flex items-center justify-center mr-2', getColorClasses(item.color, 'btn'), item.pulse ? 'animate-pulse' : '']">
                                    <i :class="['text-xs', item.icon, 'text-white']"></i>
                                </div>
                                <span class="text-xs font-medium text-zinc-900 dark:text-zinc-100">{{ item.label }}</span>
                            </div>
                            <span :class="['text-sm font-bold', getColorClasses(item.color).color || getColorClasses(item.color).text]">{{ item.count }}</span>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </AuthenticatedLayout>
</template>
