<template>
    <div class="container">
        <form @submit.prevent="submitHandler">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-capitalize">{{ param_id ? 'Update' : 'Create' }} new {{ route_prefix }}</h5>
                    <div>
                        <router-link v-if="item.slug" class="btn btn-outline-info mr-2 btn-sm"
                            :to="{ name: `Details${route_prefix}`, params: {id: item.slug} }">
                            Details {{ route_prefix }}
                        </router-link>
                        <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All${route_prefix}` }">
                            All {{ route_prefix }}
                        </router-link>
                    </div>
                </div>
                <div class="card-body card_body_fixed_height">
                    <div class="row">
                        <input type="hidden" name="role_serial" value="3">
                        <input type="hidden" name="customer_type_id" value="1">
                        <div class="col-md-6" v-for="(form_field, index) in form_fields" :key="index">
                            <common-input
                                :label="form_field.label"
                                :type="form_field.type"
                                :name="form_field.name"
                                :multiple="form_field.multiple"
                                :value="form_field.value"
                                :data_list="form_field.data_list" />
                        </div>
                    </div>
                    <h4 class="mt-5"> User address</h4>
                    <div>
                        <div v-for="(address, index) in user_addresses" :key="index">
                            <input type="hidden" :name="`addresses[${index}][is_shipping]`" value="1">
                            <div class="row">
                                <div class="col-md-6" v-for="(field, field_index) in Object.keys(address)" :key="field_index">
                                    <common-input
                                        v-if="field != 'contacts'"
                                        :label="field.replace(/_/g, ' ')"
                                        :type="(field == `is_present_address` || field == `is_permanent_address`)? 'checkbox':  'text'"
                                        :name="`userAddress[${index}][${field}]`"
                                        :value="(field == `is_present_address` || field == `is_permanent_address`)? '1':  ''" />
                                </div>
                            </div>
                            <h5>contact numbers</h5>
                            <div>
                                <div v-for="(contacts, contact_index) in address.contacts" :key="contact_index">
                                    <h6 class="mt-4 text-info" >contact {{ contact_index + 1 }}</h6>
                                    <div class="row">
                                        <div class="col-md-6" v-for="(field, contact_field_index) in Object.keys(contacts)" :key="contact_field_index">
                                            <common-input
                                                v-if="field != 'contacts'"
                                                :label="field.replace(/_/g, ' ')"
                                                :type="'text'"
                                                :name="`addresses[${index}][contact][${contact_index}][${field}]`"
                                                :value="''" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-light btn-square px-5">
                        <i class="icon-lock"></i>
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions, mapState } from 'pinia'
import { store } from './setup/store';
import setup from "./setup";
import form_fields from "./setup/form_fields";

export default {
    data: () => ({
        route_prefix: '',
        form_fields,
        param_id: null,
        user_addresses: [],
    }),
    created: async function () {
        let id = this.param_id = this.$route.params.id;
        this.route_prefix = setup.route_prefix;
        this.reset_fields();

        this.user_addresses.push(this.make_address_array());

        if (id) {
            this.set_fields(id);
        }
    },
    methods: {
        ...mapActions(store, {
            create: 'create',
            update: 'update',
            details: 'details',
        }),
        reset_fields: function () {
            this.form_fields.forEach((item) => {
                item.value = "";
            });
        },
        set_fields: async function (id) {
            this.param_id = id;
            await this.details(id);
            if (this.item) {
                this.form_fields.forEach((field, index) => {
                    Object.entries(this.item).forEach((value) => {
                        if (field.name == value[0]) {
                            this.form_fields[index].value = value[1];
                        }
                    });
                });
            }
        },

        submitHandler: async function ($event) {
            if (this.param_id) {
                let response = await this.update($event);
                if ([200, 201].includes(response.status)) {
                    window.s_alert("data updated");
                    this.$router.push({ name: `Details${this.route_prefix}` });
                }
            } else {
                let response = await this.create($event);
                if ([200, 201].includes(response.status)) {
                    window.s_alert("data created");
                    this.$router.push({ name: `All${this.route_prefix}` });
                }
            }
        },

        make_address_array: function(){
            let address = {
                // 'user_id': '',
                // 'is_shipping': '',
                // 'is_billing': '',
                // 'address_types': '',
                'address': '',
                // 'country_id': '',
                // 'state_division_id': '',
                // 'division_id': '',
                // 'district_id': '',
                // 'station_id': '',
                // 'city_id': '',
                'zip_code': '',
                'is_present_address': '',
                'is_permanent_address': '',
                'contacts': [
                    {
                        // 'user_id': "",
                        // 'user_address_id': "",
                        'name': "",
                        'phone_number': "",
                        'email': "",
                    },
                    {
                        // 'user_id': "",
                        // 'user_address_id': "",
                        'name': "",
                        'phone_number': "",
                        'email': "",
                    }
                ]
            };
            return address;
        }
    },

    computed: {
        ...mapState(store, {
            item: "item",
        }),
    },
}
</script>
