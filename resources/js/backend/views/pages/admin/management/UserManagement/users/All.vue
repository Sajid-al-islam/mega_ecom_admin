<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header py-1 d-flex align-items-center justify-content-between">
                        <all-page-header />
                    </div>
                    <div class="card-body table-responsive table_responsive h-80vh">
                        <table class="table table-hover text-center table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="w-10 text-center">
                                        <select-all />
                                    </th>
                                    <th class="w-10"> ID </th>
                                    <th> name </th>
                                    <th> email </th>
                                    <th> phone </th>
                                    <th> image </th>
                                </tr>
                            </thead>
                            <tbody v-if="all?.data?.length">
                                <tr v-for="(item) in all?.data" :key="item.id"
                                    :class="`table_rows table_row_${item.id}`">
                                    <td>
                                        <table-row-action></table-row-action>
                                    </td>
                                    <td>
                                        <select-single :data="item" />
                                    </td>
                                    <td>
                                        {{ item.id }}
                                    </td>
                                    <td>
                                        {{ item.name }}
                                    </td>
                                    <td>
                                        {{ item.email }}
                                    </td>
                                    <td>
                                        {{ item.phone_number }}
                                    </td>
                                    <td><img src="/avatar.png" alt="" style="height: 30px;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mx-3" v-if="typeof all == `object`">
                        <pagination
                            :data="all"
                            :get_data="get_all_user"
                            :set_paginate="set_paginate"
                            :set_page="set_page" />
                    </div>
                    <div class="card-footer py-2">
                        <all-page-footer-actions></all-page-footer-actions>
                    </div>
                </div>
            </div>
        </div>

        <div class="loader export_loader">
            <div class="loader_body">
                <div class="progress"></div>
                <div class="load_amount">
                    <h4>0</h4>
                    <h5>%</h5>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState, mapWritableState } from 'pinia'
import { store as user_setup_store } from './setup/store';
import get_all_user from "./setup/store/async_actions/all";
import TableRowAction from './components/all_data_page/TableRowAction.vue';
import AllPageHeader from './components/all_data_page/AllPageHeader.vue';
import AllPageFooterActions from './components/all_data_page/AllPageFooterActions.vue';
import SelectSingle from './components/all_data_page/select_data/SelectSingle.vue';
import SelectAll from './components/all_data_page/select_data/SelectAll.vue';
import setup from "./setup";
export default {
    components: {
        TableRowAction,
        AllPageHeader,
        AllPageFooterActions,
        SelectSingle,
        SelectAll,
    },
    data: () => ({
        route_prefix: '',
        page_title: '',
        parent_item: false,
        child_items: [],
        setup,
    }),
    created: async function () {
        this.paginate = 5;
        await this.get_all_user();
    },
    methods: {
        ...mapActions(user_setup_store, {
            set_page: 'set_page',
            set_paginate: 'set_paginate',
            delete_data: 'delete',
            bulk_action: 'bulk_action',
        }),
        get_all_user,
        toggleParentCheckbox() {
            this.child_items = event.target.checked ? this.all_data.data.map(item => item.id) : []
        },
        toggleChildCheckbox(id) {
            let isChecked = event.target.checked
            if (isChecked) {
                this.child_items.push(id)
            } else {
                this.child_items = this.child_items.filter(item => item != id)
            }

        },
        bulkActions(action) {
            this.bulk_action(action, this.child_items)
            this.parent_item = false
            this.child_items = []
        }

    },
    computed: {
        ...mapWritableState(user_setup_store, {
            all: 'all',
            paginate: 'paginate',
        })
    }
}
</script>

<style></style>
