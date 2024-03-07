<script setup>
    import store from '../State/index.js'
</script>

<template>
    <div v-if="store.state.loading" id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>
    <router-view></router-view>
</template>

<style scoped>

</style>
