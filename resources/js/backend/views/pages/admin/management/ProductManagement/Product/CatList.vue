<template>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header py-1 d-flex align-items-center justify-content-between">
                        <!-- <all-page-header /> -->
                        <h5>All Categories</h5>
                    </div>
                    <div class="card-body">
                        <div class="category_card_dropdown card_body_fixed_height mt-2" style="max-height: unset; overflow-y: unset;">
                            <cat-list-component :list="list" />
                        </div>
                    </div>
                    <div class="card-footer py-2">
                        <all-page-footer-actions>
                            <router-link href="" :to="{name:'AllCategory'}"
                                class="btn action_btn mr-2 btn-sm btn-secondary d-flex align-content-center align-items-center">
                                <i class="fa fa-list mr-2"></i>
                                All Category
                            </router-link>
                        </all-page-footer-actions>
                    </div>
                </div>
            </div>
        </div>
        <export-all-loader />
        <quick-view />
        <filter-data />
    </div>
</template>

<script>
/** plugins */
import { mapActions } from 'pinia'
import { store } from './setup/store';
import setup from "./setup";

/** components */
import TableRowAction from './components/all_data_page/TableRowAction.vue';
import AllPageHeader from './components/all_data_page/AllPageHeader.vue';
import AllPageFooterActions from './components/all_data_page/AllPageFooterActions.vue';
import SelectSingle from './components/all_data_page/select_data/SelectSingle.vue';
import SelectAll from './components/all_data_page/select_data/SelectAll.vue';
import ExportAllLoader from './components/all_data_page/ExportAllLoader.vue';
import QuickView from './components/canvas/QuickView.vue';
import QuickViewColumn from './components/all_data_page/QuickViewColumn.vue';
import FilterData from './components/canvas/FilterData.vue';
import DropDownEl from './components/dropdown/DropDownEl.vue';
import CatListComponent from './CatListComponent.vue';

export default {
    data: () => ({
        setup,
        list: [],
    }),
    created: async function () {
        await this.get_categories();
    },
    methods: {
        ...mapActions(store, [
            'get_all_categories',
        ]),
        get_categories: async function(){
            let res = await this.get_all_categories();
            this.list = res.data;
        },
    },
    computed: {

    },
    components: {
        TableRowAction,
        AllPageHeader,
        AllPageFooterActions,
        SelectSingle,
        SelectAll,
        ExportAllLoader,
        QuickView,
        QuickViewColumn,
        FilterData,
        DropDownEl,
        CatListComponent,
    },
}
</script>

<style></style>
