<template>
    <div class="container-fluid" style="max-width: 1400px;">

        <form @submit.prevent="submitHandler">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-capitalize">{{ param_id ? 'Update' : 'Create' }} new {{ route_prefix }}</h5>
                    <div>
                        <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All${route_prefix_name}` }">
                            All {{ route_prefix }}
                        </router-link>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row" v-if="order" style="row-gap: 30px;">
                                <div class="col-md-4">
                                    <label>
                                        Customer Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" :value="order?.order_address?.first_name" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Division
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" value="dhaka" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        District
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" value="dhaka" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Phone Number
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" :value="order?.address?.mobile_number" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label>
                                        Address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea type="text" :value="order?.address?.address" class="form-control"></textarea>
                                </div>
                            </div>

                            <hr class="my-4"/>
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <input type="search" class="form-control" placeholder="Search Products">
                                </div>
                            </div>
                            <hr class="my-4"/>

                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th class="text-center">Discount</th>
                                                <th>D.Price</th>
                                                <th style="width: 120px;" class="text-center">Qty</th>
                                                <th class="text-right" style="width: 120px;">
                                                    Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="product in order.order_details" :key="product.id">
                                                <td>
                                                    <i class="fa fa-trash"></i>
                                                </td>
                                                <td>
                                                    {{ product.product.product_name }}
                                                </td>
                                                <td>
                                                    {{ product.product_price }}
                                                </td>
                                                <td class="text-center">
                                                    <div style="gap: 10px;" class="d-flex justify-content-center align-items-center">
                                                        <input :value="0" type="text" class="form-control text-center" style="max-width: 80px;">
                                                        <span>
                                                            %
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ product.product_price }}
                                                </td>
                                                <td class="text-center">
                                                    <input :value="product.qty" type="text" class="form-control text-center" style="max-width: 80px;">
                                                </td>
                                                <td class="text-right">
                                                    {{ product.qty * product.product_price }}
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="text-end text-right">
                                            <tr>
                                                <td colspan="5" class="border-0"></td>
                                                <td class="border-top-md">Sub Total</td>
                                                <td class="border-top-md">{{ order.total_price }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="border-0"></td>
                                                <td>Delivery Charge</td>
                                                <td>
                                                    <input type="text" :value="100" class="form-control text-right" style="width: 80px;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="border-0"></td>
                                                <td>Total</td>
                                                <td class="text-info font-weight-bold">
                                                    {{ +order.total_price + 100 }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="border-0"></td>
                                                <td>Paid</td>
                                                <td class="text-warning font-weight-bold">
                                                    {{ +order.total_price + 100 }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="border-0"></td>
                                                <td>Due</td>
                                                <td>0</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <hr class="my-4" />


                            <div class="form-group mt-5 text-center">
                                <button type="submit" class="btn btn-light btn-square px-5">
                                    <i class="icon-login"></i>
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions, mapState } from 'pinia'
import { user_setup_store } from './setup/store';
import setup from "./setup";
import form_fields from "./setup/form_fields";
import axios from 'axios';

export default {
    data: () => ({
        route_prefix: setup.route_prefix,
        route_prefix_name: setup.route_prefix_name,

        form_fields,
        param_id: null,
        order: {},
    }),
    created: async function () {
        let id = this.$route.query.id;

        axios.get('https://ctgcomputer.com/api/orders/'+id)
            .then(res=>{
                this.order = res.data;
            })
        return;
        await this.get_all_data()
        this.form_fields.forEach((item) => {
            item.value = "";
        });
        if (id) {
            this.param_id = id;
            await this.get_single_data(id);
            if (this.single_data) {
                this.form_fields.forEach((field, index) => {
                    Object.entries(this.single_data).forEach((value) => {
                        if (field.name == value[0]) {
                            this.form_fields[index].value = value[1];
                        }


                    });
                });
            }
        } else {
            this.form_fields.forEach((item) => {
                item.value = "";
            });
        }
    },
    methods: {
        ...mapActions(user_setup_store, {
            get_all_data: 'all',
            get_single_data: 'get',
            store_data: 'store',
            update_data: 'update',
        }),

        submitHandler: async function ($event) {
            if (this.param_id) {
                let response = await this.update_data($event.target, this.param_id);
                if (response.data.status === "success") {
                    window.s_alert(response.data.message);
                    this.$router.push({ name: `All${this.route_prefix}` });
                }
            } else {
                let response = await this.store_data($event.target);
                if (response.data.status === "success") {
                    window.s_alert(response.data.message);
                    this.$router.push({ name: `All${this.route_prefix}` });
                }
            }
        },


    },

    computed: {
        ...mapState(user_setup_store, {
            single_data: "single_data",
            all_data: 'all_data',
        }),
    },


}
</script>
