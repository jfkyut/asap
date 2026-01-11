<script setup>

defineProps({
    form: Object,
});

</script>

<template>
    <div class="space-y-6 m-2 ml-0">
        <!-- Sender Section -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-900/20 rounded-lg p-6 border border-blue-200 dark:border-blue-800">
            <div class="flex items-center gap-2 mb-4">
                <span class="text-2xl">📍</span>
                <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Pickup Details</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white dark:bg-zinc-800 rounded p-3">
                    <p class="text-xs text-zinc-600 dark:text-zinc-400 font-semibold uppercase tracking-wide mb-1">Location</p>
                    <p class="text-sm text-zinc-900 dark:text-white font-medium">{{ form.sender_location || '—' }}</p>
                </div>
                <div class="bg-white dark:bg-zinc-800 rounded p-3">
                    <p class="text-xs text-zinc-600 dark:text-zinc-400 font-semibold uppercase tracking-wide mb-1">Full Name</p>
                    <p class="text-sm text-zinc-900 dark:text-white font-medium">{{ form.sender_full_name || '—' }}</p>
                </div>
                <div class="bg-white dark:bg-zinc-800 rounded p-3">
                    <p class="text-xs text-zinc-600 dark:text-zinc-400 font-semibold uppercase tracking-wide mb-1">Phone</p>
                    <p class="text-sm text-zinc-900 dark:text-white font-medium">{{ form.sender_phone || '—' }}</p>
                </div>
                <div class="bg-white dark:bg-zinc-800 rounded p-3">
                    <p class="text-xs text-zinc-600 dark:text-zinc-400 font-semibold uppercase tracking-wide mb-1">Note</p>
                    <p class="text-sm text-zinc-900 dark:text-white">{{ form.sender_note || 'No note' }}</p>
                </div>
            </div>
        </div>

        <!-- Arrow/Connection -->
        <div class="flex justify-center">
            <div class="text-3xl text-zinc-400 dark:text-zinc-600">⬇️</div>
        </div>

        <!-- Receiver Section -->
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-900/20 rounded-lg p-6 border border-purple-200 dark:border-purple-800">
            <div class="flex items-center gap-2 mb-4">
                <span class="text-2xl">📦</span>
                <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Delivery Details</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white dark:bg-zinc-800 rounded p-3">
                    <p class="text-xs text-zinc-600 dark:text-zinc-400 font-semibold uppercase tracking-wide mb-1">Location</p>
                    <p class="text-sm text-zinc-900 dark:text-white font-medium">{{ form.receiver_location || '—' }}</p>
                </div>
                <div class="bg-white dark:bg-zinc-800 rounded p-3">
                    <p class="text-xs text-zinc-600 dark:text-zinc-400 font-semibold uppercase tracking-wide mb-1">Full Name</p>
                    <p class="text-sm text-zinc-900 dark:text-white font-medium">{{ form.receiver_full_name || '—' }}</p>
                </div>
                <div class="bg-white dark:bg-zinc-800 rounded p-3">
                    <p class="text-xs text-zinc-600 dark:text-zinc-400 font-semibold uppercase tracking-wide mb-1">Phone</p>
                    <p class="text-sm text-zinc-900 dark:text-white font-medium">{{ form.receiver_phone || '—' }}</p>
                </div>
                <div class="bg-white dark:bg-zinc-800 rounded p-3">
                    <p class="text-xs text-zinc-600 dark:text-zinc-400 font-semibold uppercase tracking-wide mb-1">Note</p>
                    <p class="text-sm text-zinc-900 dark:text-white">{{ form.receiver_note || 'No note' }}</p>
                </div>
            </div>
        </div>

        <!-- Payment Method Section -->
        <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-900/20 rounded-lg p-6 border border-green-200 dark:border-green-800">
            <div class="flex items-center gap-2 mb-4">
                <span class="text-2xl">💳</span>
                <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Payment Method</h3>
            </div>
            
            <div class="bg-white dark:bg-zinc-800 rounded p-3">
                <p class="text-xs text-zinc-600 dark:text-zinc-400 font-semibold uppercase tracking-wide mb-1">Selected Method</p>
                <p class="text-sm text-zinc-900 dark:text-white font-medium">{{ form.payment_method || '—' }}</p>
            </div>
        </div>

        <!-- Summary Box -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg p-4 border border-zinc-200 dark:border-zinc-700">
            <div class="flex items-start gap-3">
                <span class="text-xl">ℹ️</span>
                <div>
                    <p class="text-sm font-medium text-zinc-900 dark:text-white">Please review all details carefully</p>
                    <p class="text-xs text-zinc-600 dark:text-zinc-400 mt-1">Once you submit this request, it will be sent for review and processing.</p>
                </div>
            </div>
        </div>
    </div>
</template>