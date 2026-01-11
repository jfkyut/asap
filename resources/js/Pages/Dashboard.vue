<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { router } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            Home
        </template>

        <div class="border border-teal-500 dark:border-teal-800 p-2 rounded flex justify-between items-center mb-6 bg-teal-50 dark:bg-teal-900/20">
            <div class="text-sm capitalize font-bold">
                Hello, {{ $page.props.auth.user.name }}! 
            </div>
            <div>
                <ApplicationLogo class="w-10" />
            </div>
        </div>

        <div class="sm:p-8 max-w-7xl mx-auto">
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100 mb-6">
                    What You Can Do
                </h3>
                
                <!-- Core Systems Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- System 1 -->
                    <div @click="router.get(route('pasuyo.create'))" class="group relative overflow-hidden rounded-lg border-2 border-blue-400 dark:border-blue-600 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-900/50 p-6 hover:shadow-lg transition-all duration-300 cursor-pointer">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-blue-200 dark:bg-blue-700 rounded-full -mr-8 -mt-8 opacity-50 group-hover:opacity-75 transition-opacity"></div>
                        
                        <div class="relative z-10">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center text-white text-xl mr-4">
                                    <i class="ri-run-line"></i>
                                </div>
                                <h4 class="text-xl font-bold text-zinc-900 dark:text-white">
                                    Pasuyo, Pabili ATBP.
                                </h4>
                            </div>
                            
                            <p class="text-zinc-700 dark:text-zinc-300 mb-4 text-sm">
                                Allows users to request errands from a rider, whether it’s for groceries, food, medicine, or other items.
                            </p>
                            
                            <div class="flex items-center text-blue-600 dark:text-blue-400 font-semibold text-sm hover:translate-x-1 transition-transform">
                                Request an Errand
                                <span class="ml-2">→</span>
                            </div>
                        </div>
                    </div>

                    <!-- System 2 -->
                    <div @click="router.get(route('pick-and-drop.create'))" class="group relative overflow-hidden rounded-lg border-2 border-purple-400 dark:border-purple-600 bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-900/50 p-6 hover:shadow-lg transition-all duration-300 cursor-pointer">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-purple-200 dark:bg-purple-700 rounded-full -mr-8 -mt-8 opacity-50 group-hover:opacity-75 transition-opacity"></div>
                        
                        <div class="relative z-10">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center text-white text-xl mr-4">
                                    <i class="ri-route-line"></i>
                                </div>
                                <h4 class="text-xl font-bold text-zinc-900 dark:text-white">
                                    Pick & Drop
                                </h4>
                            </div>
                            
                            <p class="text-zinc-700 dark:text-zinc-300 mb-4 text-sm">
                                Get same-day delivery services. Request a rider to pick up items from one location and drop them off at another, all within the day.
                            </p>
                            
                            <div class="flex items-center text-purple-600 dark:text-purple-400 font-semibold text-sm hover:translate-x-1 transition-transform">
                                Request a Pickup
                                <span class="ml-2">→</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Section -->
            <div class="mt-12">
                <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100 mb-6">Quick Stats</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-white dark:bg-zinc-800 rounded-lg p-4 border border-zinc-200 dark:border-zinc-700">
                        <p class="text-zinc-600 dark:text-zinc-400 text-sm font-medium">Placeholder</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white mt-2">—</p>
                    </div>
                    <div class="bg-white dark:bg-zinc-800 rounded-lg p-4 border border-zinc-200 dark:border-zinc-700">
                        <p class="text-zinc-600 dark:text-zinc-400 text-sm font-medium">Placeholder</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white mt-2">—</p>
                    </div>
                    <div class="bg-white dark:bg-zinc-800 rounded-lg p-4 border border-zinc-200 dark:border-zinc-700">
                        <p class="text-zinc-600 dark:text-zinc-400 text-sm font-medium">Placeholder</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white mt-2">—</p>
                    </div>
                    <div class="bg-white dark:bg-zinc-800 rounded-lg p-4 border border-zinc-200 dark:border-zinc-700">
                        <p class="text-zinc-600 dark:text-zinc-400 text-sm font-medium">Placeholder</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white mt-2">—</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
