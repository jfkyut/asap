<script setup>

import { InputText } from 'primevue';
import Modal from './Modal.vue';
import { ref } from 'vue';
import Map from './Map.vue';

defineProps({
    form: Object,
    itemKey: {
        type: String,
        default: () => 'coordinates',
    }
})

const isShowModal = ref(false);

const drawEnable = ref(false);
const drawType = ref("Point");

const changeDrawType = (active, draw) => {
    drawEnable.value = active;
    drawType.value = draw;

    
};

</script>

<template>
    <InputText 
        v-model="form[itemKey]"
        class="w-full"
        @click="isShowModal = true"
    />

    <Modal
        max-width="4xl"
        :show="isShowModal"
        @close="isShowModal = false"
    >
        <Map>
            <template #control-bar>
            <ol-control-bar>
                <ol-toggle-control
                    html="🔘"
                    className="edit"
                    title="Point"
                    @toggle="(active) => changeDrawType(active, 'Point')"
                />
                <ol-toggle-control
                    html="〰️"
                    className="edit"
                    title="LineString"
                    @toggle="(active) => changeDrawType(active, 'LineString')"
                />
                <!-- <ol-print-dialog-control /> -->
            </ol-control-bar>
            </template>
        </Map>
    </Modal>
</template>