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
                                        <th> Image </th>
                                        <th> Title </th>
                                        <th> Code </th>
                                        <th> Categories </th>
                                        <th> Brand </th>
                                        <th> Sales Price </th>
                                        <th> Stock </th>
                                        <th> status </th>
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
                                            <img v-if="item.product_image" class="bg-white"
                                                :src="load_image(item.product_image?.url)" alt=""
                                                style="height: 30px;">
                                        </td>
                                        <td>
                                            <quick-view-column :item="item">
                                                {{ item.title }}
                                            </quick-view-column>
                                        </td>
                                        <td>
                                            {{ item.barcode }}
                                        </td>
                                        <td>
                                            {{ item.product_categories?.map(i=>i.title).join(' / ') }}
                                        </td>
                                        <td>
                                            {{ item.product_brand?.title }}
                                        </td>
                                        <td>
                                            {{ item.current_price }}
                                        </td>
                                        <td>
                                            {{ item.stock }}
                                        </td>
                                        <td>
                                            {{ item.is_available ? 'avaiable' : 'stockout' }}
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mx-3" v-if="typeof all == `object`">
                        <pagination :data="all" :get_data="get_all_data" :set_paginate="set_paginate"
                            :set_page="set_page" />
                    </div>
                    <div class="card-footer py-2">
                        <all-page-footer-actions>
                            <router-link href="" :to="{ name: 'AllCategories' }"
                                class="btn action_btn mr-2 btn-sm btn-secondary d-flex align-content-center align-items-center">
                                <i class="fa fa-list mr-2"></i>
                                All Category Tree
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
        ...mapActions(data_store, [
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
