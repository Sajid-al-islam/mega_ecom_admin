<template>
    <div class="container">

        <form @submit.prevent="submitHandler">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-capitalize">{{ param_id ? 'Update' : 'Create' }} {{ setup.prefix }}</h5>
                    <div>
                        <router-link v-if="item.slug" class="btn btn-info btn-sm mr-3"
                            :to="{
                                name: `Details${setup.route_prefix}`,
                                params: {
                                    id: item.slug
                                }
                            }">
                            Details
                        </router-link>
                        <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All${setup.route_prefix}` }">
                            All {{ setup.route_prefix }}
                        </router-link>
                    </div>
                </div>
                <div class="card-body card_body_fixed_height">
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
                                        <div class="form-group" style="max-width: 200px;">
                                            <label for="">Category Serial</label>
                                            <div class="mt-1 mb-3">
                                                <input class="form-control form-control-square mb-2" type="text"
                                                    name="serial" id="serial">
                                            </div>
                                        </div>
                                        <div class="form-group" style="max-width: 150px;">
                                            <label for="">Is Nav Category</label>
                                            <div class="mt-1 mb-3">
                                                <input class="form-check-input mb-2 ml-0" type="checkbox" name="is_nav"
                                                    id="is_nav">
                                            </div>
                                        </div>
                                        <div class="form-group" style="max-width: 150px;">
                                            <label for="">Is Featured</label>
                                            <div class="mt-1 mb-3">
                                                <input class="form-check-input mb-2 ml-0" type="checkbox" name="is_featured"
                                                    id="is_featured">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Cateogry Group</label>
                                        <div class="mt-1 mb-3">
                                            <CategoryGroupDropdown
                                                :value="default_group"
                                                :name="`product_category_group_id`"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Cateogry Image</label>
                                        <div class="mt-1 mb-3">
                                            <image-component :images="item.image?[load_image(item.image)]:[]" :accept="`image/*`" :name="`image`"/>
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
                                        name="page_header_title" id="page_header_title">
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Page Header Description</label>
                                <div class="mt-1 mb-3">
                                    <!-- <input class="form-control form-control-square mb-2" type="text"
                                        name="page_header_description" id="title"> -->
                                    <text-editor :set_value="set_value" :data_store="`page_header_description`" />
                                    <div class="text_output" v-html="page_header_description"></div>
                                    <textarea class="d-none" name="page_header_description"
                                        :value="page_header_description"></textarea>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Page Full Description Title</label>
                                <div class="mt-1 mb-3">
                                    <input class="form-control form-control-square mb-2" type="text"
                                        name="page_full_description_title" id="page_full_description_title">
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Page Full Description</label>
                                <div class="mt-1 mb-3">
                                    <!-- <input class="form-control form-control-square mb-2" type="text"
                                        name="page_full_description" id="title"> -->
                                    <text-editor :set_value="set_value" :data_store="`page_full_description`" />
                                    <div class="text_output" v-html="page_full_description"></div>
                                    <textarea class="d-none" name="page_full_description"
                                        :value="page_full_description"></textarea>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Page Related Product Title</label>
                                <div class="mt-1 mb-3">
                                    <input class="form-control form-control-square mb-2" type="text"
                                        name="related_product_title" id="related_product_title">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <h3>SEO</h3>
                            <div class="form-group mt-4">
                                <label for="">Meta Title</label>
                                <div class="mt-1 mb-3">
                                    <input class="form-control form-control-square mb-2" type="text" name="meta_title"
                                        id="meta_title">
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Meta Description</label>
                                <div class="mt-1 mb-3">
                                    <input class="form-control form-control-square mb-2" type="text"
                                        name="meta_description" id="meta_description">
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Meta keywords</label>
                                <div class="mt-1 mb-3">
                                    <input class="form-control form-control-square mb-2" type="text"
                                        name="meta_keywords" id="meta_keywords">
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Search keywords</label>
                                <div class="mt-1 mb-3">
                                    <input class="form-control form-control-square mb-2" type="text"
                                        name="search_keywords" id="search_keywords">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-light btn-square px-5">
                        <i class="icon-login"></i>
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
import UnitGroupDropDown from "../UnitGroup/components/dropdown/DropDownEl.vue"
import CatListRadio from '../../../../../components/CatListRadio.vue';
import CategoryGroupDropdown from '../CategoryGroup/components/dropdown/DropDownEl.vue'

export default {
    components: {
        UnitGroupDropDown,
        CatListRadio,
        CategoryGroupDropdown,
    },
    data: () => ({
        route_prefix: '',
        form_fields,
        param_id: null,
        setup,
        page_header_description: '',
        page_full_description: '',
        cat_list: [],
    }),
    created: async function () {
        let id = this.param_id = this.$route.params.id;
        this.route_prefix = setup.route_prefix;
        this.set_item({});
        this.reset_fields();

        await this.get_categories();
        if (id) {
            this.set_fields(id);
        }


    },
    methods: {
        ...mapActions(store, {
            create: 'create',
            update: 'update',
            details: 'details',
            set_item: 'set_item',
            get_all_categories: 'get_all_categories',
        }),
        get_categories: async function(){
            let res = await this.get_all_categories();
            this.cat_list = res.data;
        },
        reset_fields: function () {
            this.form_fields.forEach((item) => {
                item.value = "";
            });
        },
        set_fields: async function (id) {
            this.param_id = id;
            await this.details(id);
            if (this.item) {
                window.set_form_data({...this.item});
                this.page_header_description = this.item.page_header_description;
                this.page_full_description = this.item.page_full_description;

                $(`#cat_${this.item.id}`).parents('ul').addClass('d-block');
                $(`#cat_${this.item.parent_id}`).prop('checked',true);
                $(`.category_card_dropdown`).animate({
                    scrollTop: $(`#cat_351`).offset().top,
                });

            }

        },

        set_value: function(state, value){
            this[state] = value;
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
    },

    computed: {
        ...mapState(store, {
            item: "item",
            is_loading: 'is_loading',
        }),
        default_group: function(){
            return this.item && this.item.group ? [this.item.group] : [];
        }
    },
}
</script>
