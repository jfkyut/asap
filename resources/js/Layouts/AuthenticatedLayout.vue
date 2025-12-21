<script setup>

import { ref } from 'vue';
import { TabList, Tab, Tabs } from 'primevue';
import { router } from '@inertiajs/vue3';

const items = [
    {
        label: 'Home',
        icon: 'ri-home-6-line',
        route: '/dashboard',
    },
    {
        label: 'Transactions',
        icon: 'ri-exchange-box-line',
        route: '/transactions',
    },
    {
        label: 'Cart',
        icon: 'ri-shopping-cart-line',
        route: '/cart',
    },
    {
        label: 'Inbox',
        icon: 'ri-inbox-line',
        route: '/inbox',
    },
    {
        label: 'Profile',
        icon: 'ri-user-line',
        route: '/profile',
    },
];

// current path to keep the active tab in sync
const current = ref(window.location.pathname);

function onTabChange(val) {
    if (val && val !== window.location.pathname) {
        router.visit(val);
    }
}

</script>

<template>
    <div class="bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 min-h-screen pb-16 sm:pb-0 select-none text-xs">
        <slot />

        <!-- Mobile-first bottom tab bar (visible on small screens only) -->
        <nav class="fixed bottom-0 left-0 right-0 z-40 bg-white dark:bg-zinc-800 border-t dark:border-zinc-700" role="navigation" aria-label="Mobile tabs navigation">
            <div class="mx-auto">
                <Tabs v-model:value="current" variant="scrollable" class="w-full" @update:value="onTabChange">
                    <TabList class="flex w-full">
                        <Tab v-for="tab in items" :key="tab.label" :value="tab.route" class="flex-1">
                            <div class="w-full flex flex-col items-center justify-center">
                                <i :class="tab.icon"></i>
                                <span class="text-xs mt-1">{{ tab.label }}</span>
                            </div>
                        </Tab>
                    </TabList>
                </Tabs>
            </div>
        </nav>
    </div>
</template>