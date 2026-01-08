<script setup>

import { FloatLabel, InputText, Textarea, Select } from 'primevue';

defineProps({
    form: Object,
});

</script>

<template>
    <div class="flex flex-col h-auto">
        <div class="dark:border-surface-700 rounded bg-surface-50 dark:bg-surface-950 flex-auto flex justify-center items-center font-medium">
            <div class="space-y-2 w-full pr-2">
                <FloatLabel variant="on">
                    <Textarea 
                        id="content" 
                        v-model="form.content" 
                        required 
                        class="w-full"
                        auto-resize
                    />
                    <label for="content">Content / Items to Purchase</label>
                </FloatLabel>
                <FloatLabel variant="on">
                    <InputText 
                        id="attachments" 
                        v-model="form.attachments" 
                        class="w-full" 
                        type="file"
                        placeholder="as"
                    />
                    <label for="attachments">Sample Photos (Optional)</label>
                </FloatLabel>
                <FloatLabel variant="on">
                    <InputText 
                        id="budget" 
                        v-model="form.budget" 
                        class="w-full" 
                        required 
                    />
                    <label for="budget">Approx Budget (Optional)</label>
                </FloatLabel>
                <FloatLabel variant="on">
                    <Select 
                        id="payment-method" 
                        v-model="form.payment_method" 
                        class="w-full" 
                        :options="['Cash on Delivery', 'Gcash']"
                        required 
                    />
                    <label for="payment-method">Payment Method</label>
                </FloatLabel>
            </div>
        </div>
    </div>
</template>