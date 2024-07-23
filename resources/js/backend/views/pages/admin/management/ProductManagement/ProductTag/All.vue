<template>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header py-1 d-flex align-items-center justify-content-between">
                        <all-page-header />
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table_responsive card_body_fixed_height">
                            <table class="table table-hover text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class="w-10 text-center">
                                            <select-all />
                                        </th>
                                        <th class="w-10"> ID </th>
                                        <th> Title </th>
                                        <th> Total Products </th>
                                    </tr>
                                </thead>
                                <tbody v-if="all?.data?.length">
                                    <tr v-for="(item) in all?.data" :key="item.id"
                                        :class="`table_rows table_row_${item.id}`">
                                        <td>
                                            <table-row-action :item="item"></table-row-action>
                                        </td>
                                        <td>
                                            <select-single :data="item" />
                                        </td>
                                        <td>
                                            {{ item.id }}
                                        </td>
                                        <td>
                                            <quick-view-column :item="item">
                                                {{ item.title }}
                                            </quick-view-column>
                                        </td>
                                        <td>
                                            {{ item.total_products }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mx-3" v-if="typeof all == `object`">
                        <pagination
                            :data="all"
                            :get_data="get_all_data"
                            :set_paginate="set_paginate"
                            :set_page="set_page" />
                    </div>
                    <div class="card-footer py-2">
                        <all-page-footer-actions></all-page-footer-actions>
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
import { mapActions, mapWritableState } from 'pinia'
import { store as data_store } from './setup/store';
import setup from "./setup";

/** helper and actions */
import get_all_data from "./setup/store/async_actions/all";

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

export default {
    data: () => ({
        setup,
    }),
    created: async function () {
        this.paginate = 10;
        await this.get_all_data();
    },
    methods: {
        ...mapActions(data_store,[
            'set_page', // needs in pagination props
            'set_paginate', // needs in pagination props
        ]),
        get_all_data,
    },
    computed: {
        ...mapWritableState(data_store, {
            all: 'all',
            paginate: 'paginate',
        })
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
    },
}
</script>

<style></style>
