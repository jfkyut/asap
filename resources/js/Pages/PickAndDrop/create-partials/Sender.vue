<script setup>

import { FloatLabel, InputText, Textarea } from 'primevue';

defineProps({
    form: Object,
});

</script>

<template>
    <div class="space-y-4 w-full">
        <FloatLabel variant="on">
            <InputText 
                class="w-full" 
                v-model="form.sender_location" 
                id="sender_location" 
            />
            <label for="sender_location">Sender Location</label>
        </FloatLabel>
        <FloatLabel variant="on">
            <InputText 
                class="w-full" 
                v-model="form.sender_full_name" 
                id="sender_full_name" 
            />
            <label for="sender_full_name">Full Name</label>
        </FloatLabel>
        <FloatLabel variant="on">
            <InputText 
                class="w-full" 
                v-model="form.sender_phone" 
                id="sender_phone" 
            />
            <label for="sender_phone">Phone Number</label>
        </FloatLabel>
        <FloatLabel variant="on">
            <Textarea 
                v-model="form.sender_note" 
                class="w-full"
                id="sender_note" 
                rows="3" 
            />
            <label for="sender_note">Note</label>
        </FloatLabel>
    </div>
</template>