<template>
    <div class="container">

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
                        <div class="col-xl-7">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Title</label>
                                        <div class="mt-1 mb-3">
                                            <input class="form-control form-control-square mb-2" type="text"
                                                name="title" id="title">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex flex-wrap" style="gap: 20px;">
                                        <div class="form-group" style="max-width: 100px;">
                                            <label for="">serial</label>
                                            <div class="mt-1 mb-3">
                                                <input class="form-control form-control-square mb-2" type="text"
                                                    name="serial" id="serial">
                                            </div>
                                        </div>
                                        <div class="form-group" style="max-width: 150px;">
                                            <label for="">Is Nav Category</label>
                                            <div class="mt-1 mb-3">
                                                <input class="form-control mb-2" type="checkbox" name="is_nav"
                                                    id="is_nav">
                                            </div>
                                        </div>
                                        <div class="form-group" style="max-width: 150px;">
                                            <label for="">Is Featured</label>
                                            <div class="mt-1 mb-3">
                                                <input class="form-control mb-2" type="checkbox" name="is_featured"
                                                    id="is_featured">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Cateogry Group</label>
                                        <div class="mt-1 mb-3">
                                            <select name="" id="" class="form-control">
                                                <option value="">select</option>
                                                <option value="">group 1</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Cateogry Image</label>
                                        <div class="mt-1 mb-3">
                                            <input class="form-control form-control-square mb-2" type="file"
                                                name="image" id="image">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 pt-3">
                                    <label>Select Category Parent</label>
                                    <div class="category_card_dropdown mt-2 custom_scroll">
                                        <cat-list-radio :list="cat_list"></cat-list-radio>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-12 pt-4 pb-4">
                            <h3>Page Details</h3>
                            <div class="form-group mt-4">
                                <label for="">Page Header Title</label>
                                <div class="mt-1 mb-3">
                                    <input class="form-control form-control-square mb-2" type="text"
                                        name="page_header_title" id="title">
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Page Header Description</label>
                                <div class="mt-1 mb-3">
                                    <!-- <input class="form-control form-control-square mb-2" type="text"
                                        name="page_header_description" id="title"> -->
                                    <text-editor :set_value="set_value" :data_store="`page_header_description`" />
                                    <div class="text_output" v-html="page_header_description"></div>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Page Full Description Title</label>
                                <div class="mt-1 mb-3">
                                    <input class="form-control form-control-square mb-2" type="text"
                                        name="page_full_description_title" id="title">
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Page Full Description</label>
                                <div class="mt-1 mb-3">
                                    <!-- <input class="form-control form-control-square mb-2" type="text"
                                        name="page_full_description" id="title"> -->
                                    <text-editor :set_value="set_value" :data_store="`page_full_description`" />
                                    <div class="text_output" v-html="page_full_description"></div>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Page Related Product Title</label>
                                <div class="mt-1 mb-3">
                                    <input class="form-control form-control-square mb-2" type="text"
                                        name="related_product_title" id="title">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <h3>SEO</h3>
                            <div class="form-group mt-4">
                                <label for="">Meta Title</label>
                                <div class="mt-1 mb-3">
                                    <input class="form-control form-control-square mb-2" type="text" name="meta_title"
                                        id="title">
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Meta Description</label>
                                <div class="mt-1 mb-3">
                                    <input class="form-control form-control-square mb-2" type="text"
                                        name="meta_description" id="title">
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Meta keywords</label>
                                <div class="mt-1 mb-3">
                                    <input class="form-control form-control-square mb-2" type="text"
                                        name="meta_keywords" id="title">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-light btn-square px-5">
                                <i class="icon-login"></i>
                                Submit
                            </button>
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
import CatListRadio from '../../../../../components/CatListRadio.vue';
import TextEditor from '../../../../../components/TextEditor.vue';

export default {
    components: { CatListRadio, TextEditor },
    data: () => ({
        route_prefix: setup.route_prefix,
        route_prefix_name: setup.route_prefix_name,

        form_fields,
        param_id: null,

        cat_list: [],

        page_full_description: '',
        page_header_description: '',
    }),
    created: async function () {
        let id = this.$route.query.id;
        this.form_fields.forEach((item) => {
            item.value = "";
        });

        await this.get_cats();

        return;
        await this.get_all_data()
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

        get_cats: function () {
            axios.get('https://ctgcomputer.com/api/cats')
                .then(res => {
                    this.cat_list = res.data;
                })
        },

        set_value: function (key = '', value) {
            this[key] = value;
        }

    },

    computed: {
        ...mapState(user_setup_store, {
            single_data: "single_data",
            all_data: 'all_data',
        }),
    },


}
</script>
