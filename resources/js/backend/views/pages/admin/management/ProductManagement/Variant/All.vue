<template>
    <div class="container-fluid">
        <!-- Container-fluid starts -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="text-capitalize"> {{ page_title }}</h5>
                        <div v-if="child_items.length" class="btn-group m-1 "
                            onclick="document.getElementById('table-actions').classList.toggle('show')">
                            <button type="button" class="btn btn-light waves-effect waves-light">Actions</button>
                            <button type="button"
                                class="btn btn-light split-btn-light dropdown-toggle dropdown-toggle-split waves-effect waves-light"
                                data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                            </button>
                            <div class="dropdown-menu" style="" id="table-actions">
                                <a href="javaScript:void();" class="dropdown-item"
                                    @click="bulkActions('delete')">Delete</a>
                                <a href="javaScript:void();" class="dropdown-item"
                                    @click="bulkActions('active')">Active</a>
                                <a href="javaScript:void();" class="dropdown-item"
                                    @click="bulkActions('inactive')">Inactive</a>

                            </div>
                        </div>
                        <div>
                            <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `CreateVarientGroups` }">
                                Create Varient Group
                            </router-link>
                            <router-link class="btn ms-1 ml-1 btn-outline-warning btn-sm"
                                :to="{ name: `Create${route_prefix_name}` }">
                                Create Varients
                            </router-link>
                        </div>
                    </div>
                    <div class="card-body table-responsive h-80vh">
                        <table class="table table-hover text-center table-bordered">
                            <thead>
                                <tr>
                                    <!-- <th class="w-10"><input type="checkbox" v-model="parent_item"
                                            @click="toggleParentCheckbox"></th> -->
                                    <th class="text-start">SL</th>
                                    <th> title </th>
                                    <th> Values </th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody v-if="all_data.data?.length">
                                <tr v-for="(item, index) in all_data.data" :key="item.id">
                                    <!-- <td class="w-10">
                                        <input @click="toggleChildCheckbox(item.id)"
                                            :checked="child_items.includes(item.id)" type="checkbox">
                                    </td> -->
                                    <td class="text-start">{{ index + 1 }}</td>
                                    <th> {{ item.title }} </th>
                                    <th> {{ item.discount }} </th>
                                    <td style="width: 100px;">
                                        <div class="d-flex justify-content-between gap-2">
                                            <router-link class="btn btn-sm btn-outline-success "
                                                :to="{ name: `CreateVarientValues` }">
                                                <i class="fa fa-eye"></i>
                                                Create Varient values
                                            </router-link>
                                            <router-link class="btn btn-sm btn-outline-warning mx-2" :to="{
                                                name: `Create${route_prefix_name}`, query: {
                                                    id: item.id,
                                                },
                                            }">
                                                <i class="fa fa-pencil"></i>
                                            </router-link>
                                            <a @click.prevent="delete_data(item.id)"
                                                class="btn btn-sm btn-outline-danger ">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="8">
                                        ...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                    </div>
                    <div class="mx-5">
                        <pagination :data="all_data" :method="get_all_data" />
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts -->
    </div>
</template>

<script>
import { mapActions, mapState } from 'pinia'
import { user_setup_store } from './setup/store';
import setup from "./setup";
export default {
    data: () => ({
        route_prefix: setup.route_prefix,
        route_prefix_name: setup.route_prefix_name,
        page_title: setup.page_title,

        parent_item: false,
        child_items: []
    }),
    created: function () {
        this.get_all_data()
    },
    methods: {
        ...mapActions(user_setup_store, {
            get_all_data: 'all',
            delete_data: 'delete',
            bulk_action: 'bulk_action',
        }),
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
        ...mapState(user_setup_store, {
            all_data: 'all_data',
        })
    }
}
</script>

<style></style>
