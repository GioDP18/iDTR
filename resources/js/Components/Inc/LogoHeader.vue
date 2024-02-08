<script setup>

</script>

<template>
    <div class="logo-header" data-background-color="blue">

        <a href="#" class="logo text-light">
            Supsofttech
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i><font-awesome-icon :icon="['fas', 'bars']" /></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i><font-awesome-icon :icon="['fas', 'bars']" /></i>
            </button>
        </div>
    </div>
</template>

<style scoped>

</style>