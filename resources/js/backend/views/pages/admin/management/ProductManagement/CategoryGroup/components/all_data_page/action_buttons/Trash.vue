<template lang="">
    <a href="" @click.prevent="change_status(`inactive`)"
        v-if="inactive_data_count && status == 'active'"
        class="btn action_btn mr-2 btn-sm btn-danger d-flex align-content-center align-items-center">
        <i class="fa fa-trash mr-2"></i>
        Trash ({{ inactive_data_count }})
    </a>
    <a href="" @click.prevent="change_status(`active`)"
        v-if="status == 'inactive'"
        class="btn action_btn mr-2 btn-sm btn-success d-flex align-content-center align-items-center">
        <i class="fa fa-list mr-2"></i>
        Active ({{ active_data_count }})
    </a>
</template>
<script>
import { mapActions, mapState } from 'pinia';
import { store } from '../../../setup/store';

export default {
    methods: {
        ...mapActions(store, [
            'set_status',
            'get_all',
            'set_only_latest_data',
            'set_page',
        ]),
        change_status: function(status='active'){
            this.set_only_latest_data(true);
            this.set_status(status);
            this.set_page(1);

            this.get_all();

            this.set_only_latest_data(false);
        }
    },
    computed: {
        ...mapState(store, [
            'active_data_count',
            'inactive_data_count',
            'status',
        ]),
    }
}
</script>
<style lang="">

</style>
