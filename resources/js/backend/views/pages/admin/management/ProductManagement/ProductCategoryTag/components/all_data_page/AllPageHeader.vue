<template lang="">
    <h5 class="text-capitalize mb-0"> {{ setup.all_page_title }} </h5>
    <div style="flex: 1;">
        <search/>
    </div>
    <div>
        <button v-if="is_filter_active" @click.prevent="clear_filter()"
            class="btn btn-danger btn-sm mr-2">
            <i class="fa fa-close"></i> clear filter
        </button>
        <button @click.prevent="set_show_filter_canvas(true)"
            class="btn btn-success btn-sm">
            <i class="fa fa-gear"></i>
        </button>
    </div>
</template>
<script>
import Search from './Search.vue';
import setup from '../../setup';
import { mapActions, mapState } from 'pinia';
import { store } from '../../setup/store';
export default {
    components: { Search },
    data: () => ({
        setup,
    }),
    methods: {
        ...mapActions(store, [
            'set_show_filter_canvas',
            'clear_filter_criteria',
            'get_all',
            'set_only_latest_data',
            'set_is_filter_active',
        ]),
        clear_filter: async function(){
            this.clear_filter_criteria();
            this.set_is_filter_active(false);

            this.set_only_latest_data(true);
            await this.get_all();
            this.set_only_latest_data(false);
        }
    },
    computed: {
        ...mapState(store,[
            'is_filter_active',
        ]),
    }
}
</script>
<style lang="">

</style>
