<template lang="">
    <div>
        <div class="row" style="row-gap: 30px;">
            <div class="col-12">
                <h4>Product Information</h4>
            </div>
            <div class="col-md-12">
                <label>
                    Product Name <span class="text-danger">*</span>
                </label>
                <div>
                    <input type="text" name="title" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <label>
                    Product URL <span class="text-danger">*</span>
                </label>
                <div>
                    <input name="slug" type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <label>
                    Search Keywords <span class="text-danger">*</span>
                </label>
                <div>
                    <input name="search_keywords" type="text" class="form-control">
                </div>
            </div>

            <div class="col-md-4">
                <label>
                    Thumbnail Image
                </label>
                <div>
                    <input type="file" name="thumb_image" class="form-control">
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {

}
</script>
<style lang="">

</style>
