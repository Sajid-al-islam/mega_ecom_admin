<template>
    <div>
        <form @submit.prevent="submitHandler">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-capitalize">Details {{ setup.route_prefix }}</h5>
                    <div>
                        <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All${setup.route_prefix}` }">
                            All {{ setup.route_prefix }}
                        </router-link>
                    </div>
                </div>
                <div class="card-body card_body_fixed_height">
                    <div class="row">
                        <div class="col-lg-8">
                            <table class="table quick_modal_table">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <th>:</th>
                                        <th>
                                            {{ item.name }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <th>:</th>
                                        <th>
                                            {{ item.email }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Phone Number</th>
                                        <th>:</th>
                                        <th>
                                            {{ item.phone_number }}
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <router-link class="btn btn-outline-warning btn-sm"
                        :to="{
                            name: `Edit${setup.route_prefix}`,
                            params: { id: item.slug}
                        }">
                        Edit {{ setup.route_prefix }}
                    </router-link>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions, mapState } from 'pinia'
import { store } from './setup/store';
import setup from "./setup";

export default {
    data: () => ({
        setup,
    }),
    created: async function () {
        let id = this.param_id = this.$route.params.id;
        await this.details(id);
    },
    methods: {
        ...mapActions(store, {
            details: 'details',
        }),
    },

    computed: {
        ...mapState(store, {
            item: "item",
        }),
    },
}
</script>
