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
                        <div class="col-xl-12">

                            <product-informations />

                            <hr class="my-5" />

                            <Attributes />

                            <hr class="my-5" />

                            <discount-info />

                            <hr class="my-5" />

                            <pricing/>

                            <hr class="my-5" />

                            <inventroy />

                            <hr class="my-5" />

                            <presentation-criterion />

                            <hr class="my-5" />

                            <details-inforamtion/>

                            <hr class="my-5" />

                            <seo-information/>

                            <div class="form-group">
                                <button type="submit" class="btn mt-4 btn-light btn-square px-5">
                                    <i class="icon-login"></i>
                                    Submit
                                </button>
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
import { store as category_store } from '../Category/setup/store';

import setup from "./setup";
import form_fields from "./setup/form_fields";
import UnitGroupDropDown from "../UnitGroup/components/dropdown/DropDownEl.vue"
import CatListRadio from '../../../../../components/CatListRadio.vue';
import CategoryGroupDropdown from '../CategoryGroup/components/dropdown/DropDownEl.vue';

import ProductInformations from './form_sections/ProductInformations.vue';
import Attributes from './form_sections/Attributes.vue';
import DiscountInfo from './form_sections/DiscountInfo.vue';
import Pricing from './form_sections/Pricing.vue';
import Inventroy from './form_sections/Inventroy.vue';
import PresentationCriterion from './form_sections/PresentationCriterion.vue';
import DetailsInforamtion from './form_sections/DetailsInforamtion.vue';
import SeoInformation from './form_sections/SeoInformation.vue';

export default {
    components: {
        UnitGroupDropDown,
        CatListRadio,
        CategoryGroupDropdown,

        ProductInformations,
        Attributes,
        DiscountInfo,
        Pricing,
        Inventroy,
        PresentationCriterion,
        DetailsInforamtion,
        SeoInformation
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

        // await this.get_categories();
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
        }),
        ...mapActions(category_store, {
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
