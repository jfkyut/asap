<script setup>

import Modal from './Modal.vue';
import Map from './Map.vue';
import { ref, computed } from 'vue';

const props = defineProps({
    coordinates: {
        type: String,
        default: () => null,
    },
    show: {
        type: Boolean,
        default: () => false,
    }
})

const vectorSource = ref(null);

const parsedCoordinates = computed(() => {
    if (!props.coordinates) return null;
    return props.coordinates.split(',').map(coord => parseFloat(coord.trim()));
})

</script>

<template>
    <Modal
        max-width="4xl"
        :show="show"
        @close="$emit('close')"
    >
        <Map
            :coordinates="parsedCoordinates"
        >
            <ol-vector-layer>
                <ol-source-vector ref="vectorSource">
                    <ol-feature v-if="parsedCoordinates">
                        <ol-geom-point :coordinates="parsedCoordinates" />
                        <ol-style>
                            <ol-style-circle :radius="8">
                                <ol-style-fill color="rgba(59, 130, 246, 0.8)" />
                                <ol-style-stroke color="#1e40af" :width="2" />
                            </ol-style-circle>
                        </ol-style>
                    </ol-feature>
                </ol-source-vector>
            </ol-vector-layer>
        
        </Map>
    </Modal>
</template>