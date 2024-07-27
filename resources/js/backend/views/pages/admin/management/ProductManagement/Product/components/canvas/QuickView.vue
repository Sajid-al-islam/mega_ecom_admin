<template lang="">
    <div class="off_canvas quick_view" :class="{active: show_details_canvas}">
        <div class="off_canvas_body">
            <div class="header">
                <h3 class="heading_text">Quick View</h3>
                <button @click.prevent="set_show_details_canvas(false)"
                    class="btn btn-sm btn-outline-danger">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <div class="data_content">
                <table class="table quick_modal_table">
                    <tbody>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>
                                <img v-if="item.image" :src="load_image(item.image)" alt="" style="height: 130px;">
                            </th>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <th>:</th>
                            <th>
                                {{ item.title }}
                            </th>
                        </tr>
                        <tr>
                            <th>Parent</th>
                            <th>:</th>
                            <th>
                                {{ item?.parent?.title }}
                            </th>
                        </tr>
                        <tr>
                            <th>Group</th>
                            <th>:</th>
                            <th>
                                {{ item?.group?.title }}
                            </th>
                        </tr>
                        <tr>
                            <th>Is Featured</th>
                            <th>:</th>
                            <th>
                                <input
                                    :checked="item.is_featured"
                                    class="form-check-input ml-0"
                                    type="checkbox">
                            </th>
                        </tr>
                        <tr>
                            <th>Is Nav</th>
                            <th>:</th>
                            <th>
                                <input
                                    :checked="item.is_nav"
                                    class="form-check-input ml-0"
                                    type="checkbox">
                            </th>
                        </tr>
                        <tr>
                            <th>Serial</th>
                            <th>:</th>
                            <th>
                                {{ item.serial != "9999999"? item.serial : '' }}
                            </th>
                        </tr>
                        <tr>
                            <th>total products</th>
                            <th>:</th>
                            <th>
                                {{ item.total_products }}
                            </th>
                        </tr>
                        <tr>
                            <th>Search Keywords</th>
                            <th>:</th>
                            <th>
                                {{ item.search_keywords }}
                            </th>
                        </tr>
                        <tr>
                            <th>Meta Title</th>
                            <th>:</th>
                            <th>
                                {{ item.meta_title }}
                            </th>
                        </tr>
                        <tr>
                            <th>Meta Description</th>
                            <th>:</th>
                            <th>
                                {{ item.meta_description }}
                            </th>
                        </tr>
                        <tr>
                            <th>Meta Keywords</th>
                            <th>:</th>
                            <th>
                                {{ item.meta_keywords }}
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="off_canvas_overlay"></div>
    </div>
</template>
<script>
import { mapActions, mapWritableState } from 'pinia';
import { store } from '../../setup/store';

export default {
    methods: {
        ...mapActions(store, [
            'set_show_details_canvas'
        ]),
    },
    computed: {
        ...mapWritableState(store, [
            'show_details_canvas',
            'item',
        ])
    }
};
</script>
<style lang="">
</style>
