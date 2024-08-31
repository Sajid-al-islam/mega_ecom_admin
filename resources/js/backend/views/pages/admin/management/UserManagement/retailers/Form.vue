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
                        <input type="hidden" name="role_serial" value="6">
                        <input type="hidden" name="retailer_type_id" value="1">
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
                            <input type="hidden" :name="`userAddress[${index}][is_shipping]`" value="1">
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
                                                :name="`userAddress[${index}][contact_persons][${contact_index}][${field}]`"
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
            await this.set_fields(id);
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

                if (this.item.user_address && this.item.user_address.length) {
                    this.user_addresses = this.item.user_address;
                    this.user_addresses = this.user_addresses.map((address)=>{
                        delete address.id;
                        delete address.user_id;
                        delete address.is_shipping;
                        delete address.is_billing;
                        delete address.address_types;
                        delete address.country_id;
                        delete address.state_division_id;
                        delete address.division_id;
                        delete address.district_id;
                        delete address.station_id;
                        delete address.city_id;

                        address.contacts = address.contact_persons.map((contact)=>{
                            delete contact.id;
                            delete contact.user_id;
                            delete contact.user_address_id;
                            return contact;
                        });

                        delete address.contact_persons;

                        return address;
                    });

                    let that = this;
                    setTimeout(() => {
                        that.user_addresses.forEach((item, index)=>{
                            let keys = Object.keys(item);
                            keys.forEach((key)=>{
                                if (key == 'is_present_address' || key == 'is_permanent_address') {
                                    let el = document.querySelector(`input[name="userAddress[${index}][${key}]"]`);
                                    if(el)
                                        el.checked = item[key];
                                } else {
                                    let el = document.querySelector(`input[name="userAddress[${index}][${key}]"]`);
                                    if(el)
                                        el.value = item[key];
                                }
                            });

                            if(item.contacts){
                                item.contacts.forEach((contact_item, contact_index)=>{
                                    let keys = Object.keys(contact_item);
                                    keys.forEach((key)=>{
                                            console.log(key);
                                            let el = document.querySelector(`input[name="userAddress[${index}][contact_persons][${contact_index}][${key}]"]`);
                                            if(el)
                                                el.value = contact_item[key];
                                        });
                                    });
                            }
                        })
                    }, 200);
                }
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
                // 'country_id': '',
                // 'state_division_id': '',
                // 'division_id': '',
                // 'district_id': '',
                // 'station_id': '',
                // 'city_id': '',
                'address': '',
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
