<script setup>

import { Button } from 'primevue';
import Modal from '@/Components/Modal.vue';
import { ref, toRefs } from 'vue';
import Container from '@/Components/Container.vue';
import { useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const props = defineProps({
    pasuyo: Object,
})

const { pasuyo } = toRefs(props);

const isShowModal = ref(false);
const toast = useToast();

const form = useForm({
    status: 'cancelled',
});

const submit = (pasuyo) => {
    form.put(route('pasuyo.update', pasuyo.id), {
        onSuccess: () => {
            isShowModal.value = false;

            toast.success('Pasuyo cancelled successfully');
        },
        onError: () => {
            toast.error('Failed to cancel pasuyo. Please try again.');
        }
    });
}

</script>

<template>
    <Button @click="isShowModal = true" severity="danger" outlined size="small">
        <i class="ri-close-circle-line"></i>
    </Button>

    <Modal 
        :show="isShowModal" 
        @close="isShowModal = false" 
    >
        <Container>
            <template #header>
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Cancel Pasuyo</h2>
            </template>
            <template #body>
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-6">Are you sure you want to cancel this pasuyo?</p>
                
            </template>
            <template #footer>
                <div class="flex justify-end gap-2">
                    <Button @click="isShowModal = false" outlined>
                        No, keep it
                    </Button>
                    <Button severity="danger" @click="submit(pasuyo)">
                        Yes, cancel it
                    </Button>
                </div>
            </template>
        </Container>
    </Modal>

</template>