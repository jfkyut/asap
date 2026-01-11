<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <AuthenticatedLayout>
        <Head title="My Transactions" />

        <template #header>
            <h2>My Transactions</h2>
        </template>

        <div class="max-w-4xl mx-auto">
            <h1 class="text-2xl font-semibold mb-4">Transactions</h1>
            <!-- Transactions content goes here -->
            <p>Your transactions will be displayed here.</p>
        </div>
    </AuthenticatedLayout>
</template>