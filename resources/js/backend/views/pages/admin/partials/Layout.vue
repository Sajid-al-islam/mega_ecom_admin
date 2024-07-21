<template>
    <!-- <side-bar></side-bar> -->
    <div class="page-body">
        <div class="container-fluid">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import SideBar from './SideBar.vue';
export default {
    components: { SideBar },
}
</script>

<style></style>
