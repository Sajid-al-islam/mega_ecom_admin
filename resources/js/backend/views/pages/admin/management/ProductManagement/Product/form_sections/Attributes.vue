<template lang="">
    <div>
        <div class="row" style="row-gap: 30px;">
            <div class="col-12">
                <h4>Attributes</h4>
            </div>
            <div class="col-md-12">
                <label>
                    Category
                </label>
                <categoryDropDown :name="'categories'" :multiple="true"/>
            </div>
            <div class="col-md-4">
                <label>
                    Category Group
                </label>
                <CategoryGroupDropDown :name="`product_category_group_id`" />
            </div>
            <div class="col-md-4">
                <label>
                    Brand
                </label>
                <BrandDropDown :name="`product_brand_id`" />
            </div>
            <div class="col-md-4">
                <label>
                    Unit
                </label>
                <UnitDropDown :name="`product_unit_id`" />
            </div>
            <div class="col-md-4">
                <label>
                    Manufacturer
                </label>
                <ManufactureDropDown :name="`product_menufecturer_id`"/>
            </div>
            <div class="col-md-4">
                <label>
                    SKU
                </label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-4">
                <label>
                    Barcode
                </label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-4">
                <label>
                    Weight (kg)
                </label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-4">
                <label>
                    Height (inc)
                </label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-4">
                <label>
                    Alert Quantity
                </label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-4">
                <label>
                    Seller Point
                </label>
                <input type="text" class="form-control">
            </div>

        </div>
    </div>
</template>
<script>
import categoryDropDown from "../../Category/components/dropdown/DropDownEl.vue"
import BrandDropDown from "../../Brand/components/dropdown/DropDownEl.vue"
import UnitDropDown from "../../Unit/components/dropdown/DropDownEl.vue"
import ManufactureDropDown from "../../Manufacture/components/dropdown/DropDownEl.vue"
import CategoryGroupDropDown from "../../CategoryGroup/components/dropdown/DropDownEl.vue"
export default {
    components: {
        categoryDropDown,
        BrandDropDown,
        UnitDropDown,
        ManufactureDropDown,
        CategoryGroupDropDown,
    }
}
</script>
<style lang="">

</style>
