<script setup>

import Modal from '@/Components/Modal.vue';
import Container from '@/Components/Container.vue';
import { Button } from 'primevue';
import { ref } from 'vue';

const isShowModal = ref(true);

</script>

<template>
    <Modal :show="isShowModal" :closeable="false" @close="isShowModal = false">
        <Container>
            <template #header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                    Welcome to ASAP!
                </h2>
            </template>

            <template #body>
                <div class="text-sm text-gray-600 dark:text-gray-200 space-y-4 max-h-64 overflow-y-auto">
                    <div class="flex items-start gap-2">
                        <i class="ri-checkbox-circle-line text-green-500 mt-0.5"></i>
                        <p>
                            You can now order from ANY stores that you want! Just list stores together with items you want us to buy for you.
                        </p>
                    </div>

                    <p class="font-semibold">
                        How does it work
                    </p>

                    <div class="flex items-start gap-2">
                        <i class="ri-checkbox-circle-line text-green-500 mt-0.5"></i>
                        <p>
                            Once your rider arrives at the store and confirms the item costs, they will update the status to in Progress. Your total payment amount will then instantly reflect on your dashboard.
                        </p>
                    </div>

                    <div class="flex items-start gap-2">
                        <i class="ri-checkbox-circle-line text-green-500 mt-0.5"></i>
                        <p>
                            Please refer to the details below:
                        </p>
                    </div>

                    <ul class="space-y-2 list-disc list-inside ml-6">
                        <li class="text-gray-600 dark:text-gray-300">
                            Delivery Fee: PHP15/KM
                        </li>
                        <li class="text-gray-600 dark:text-gray-300">
                            Rider will earn the full DF.
                        </li>
                    </ul>
                </div>
            </template>

            <template #footer>
                <div class="flex justify-end">
                    <Button
                        label="Got it!"
                        @click="isShowModal = false"
                    />
                </div>
            </template>
        </Container>
    </Modal>
</template>