<script setup>

import Modal from './Modal.vue';
import Map from './Map.vue';
import { ref, computed, watch } from 'vue';
import Overlay from 'ol/Overlay';

const props = defineProps({
    coordinates: {
        type: Array,
        default: () => [],
    },
    show: {
        type: Boolean,
        default: () => false,
    },
    labels: {
        type: Array,
        default: () => [],
    },
})

const vectorSource = ref(null);
const visibleLabels = ref(new Set());

const parsedCoordinates = computed(() => {
    if (!props.coordinates || props.coordinates.length === 0) return [];
    return props.coordinates.map(coord => {
        if (typeof coord === 'string') {
            return coord.split(',').map(c => parseFloat(c.trim()));
        }
        return coord;
    });
})

watch(() => props.show, (newVal) => {
    if (newVal) {
        // Show all labels by default when modal opens
        visibleLabels.value = new Set(parsedCoordinates.value.map((_, i) => i));
    } else {
        visibleLabels.value.clear();
    }
})

const toggleLabel = (index) => {
    if (visibleLabels.value.has(index)) {
        visibleLabels.value.delete(index);
    } else {
        visibleLabels.value.add(index);
    }
}

const isLabelVisible = (index) => {
    return visibleLabels.value.has(index);
}

</script>

<template>
    <Modal
        max-width="4xl"
        :show="show"
        @close="$emit('close')"
    >
        <Map
            :coordinates="parsedCoordinates.length > 0 ? parsedCoordinates[0] : null"
        >
            <ol-vector-layer>
                <ol-source-vector ref="vectorSource">
                    <ol-feature
                        v-for="(coordinates, index) in parsedCoordinates"
                        :key="index"
                        v-if="coordinates"
                    >
                        <ol-geom-point :coordinates="coordinates" />
                        <ol-style>
                            <ol-style-circle :radius="8">
                                <ol-style-fill color="rgba(59, 130, 246, 0.8)" />
                                <ol-style-stroke color="#1e40af" :width="2" />
                            </ol-style-circle>
                        </ol-style>
                    </ol-feature>
                </ol-source-vector>
            </ol-vector-layer>

            <!-- Clickable toggle button at each marker -->
            <ol-overlay
                v-for="(coordinates, index) in parsedCoordinates"
                :key="`toggle-${index}`"
                :position="coordinates"
                positioning="center-center"
            >
                <button
                    @click.stop="toggleLabel(index)"
                    class="w-3 h-3 bg-blue-500 hover:bg-blue-600 rounded-full flex items-center justify-center text-white text-xs font-bold cursor-pointer"
                    title="Click to toggle label"
                >
                    +
                </button>
            </ol-overlay>

            <!-- Popups for each location -->
            <ol-overlay
                v-for="(coordinates, index) in parsedCoordinates"
                v-show="isLabelVisible(index)"
                :key="`popup-${index}`"
                :position="coordinates"
                positioning="center-bottom"
                :offset="[8, -40]"
            >
                <div
                    class="bg-white px-3 py-2 rounded-es-none rounded-lg shadow-lg border border-gray-300 cursor-pointer hover:bg-gray-50"
                    @click.stop="toggleLabel(index)"
                >
                    <p class="text-xs font-semibold text-gray-800">
                        {{ labels[index] || `Location ${index + 1}` }}
                    </p>
                </div>
            </ol-overlay>

        </Map>
    </Modal>
</template>
