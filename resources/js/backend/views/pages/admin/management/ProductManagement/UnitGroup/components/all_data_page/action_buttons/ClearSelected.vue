<template lang="">
    <a href="" v-if="selected.length"
        @click.prevent="()=>clear_selected()"
        class="btn action_btn mr-2 btn-sm btn-warning d-flex align-content-center align-items-center">
        <i class="fa fa-list mr-2"></i>
        Clear Selected ({{ selected.length }})
    </a>
</template>
<script>
import { mapActions, mapState } from 'pinia';
import { store } from '../../../setup/store';

export default {
    methods: {
        ...mapActions(store, [
            'clear_selected',
        ])
    },
    computed: {
        ...mapState(store,[
            'selected',
       ]),
    }
}
</script>
<style lang="">

</style>
