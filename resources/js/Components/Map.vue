<script setup>


</script>

<template>
  <OlMap style="min-width: 400px; height: 400px;">
    <OlView :center="[119.28242077814251, 10.5183862756608]" :zoom="12" projection="EPSG:4326" />
    <OlTileLayer>
        <OlSourceOSM />
    </OlTileLayer>
    <slot />
  </OlMap>
</template>