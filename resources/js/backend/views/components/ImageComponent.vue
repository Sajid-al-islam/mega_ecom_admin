<template>
    <div>

        <input @change="preview" class="form-control" type="file" ref="input_files" :accept="accept" :class="classNames"
            :name="name" :multiple="multiple">


        <template v-if="multiple">
            <div class="uploaded_image_preview my-2 d-flex gap-1 flex-wrap" >
                <img v-show="images?.length" v-for="image in images" :key="image" :src="image" :class="image != '' ? 'border' : ''" style="width: 200px; height: 80px;
                object-fit: contain;" alt="image" target="_black">
            </div>
        </template>

        <template v-else>
            <div class="uploaded_image_preview my-2 d-flex gap-1 flex-wrap" >
                <img v-if="value" :src="value" style="max-width: 200px; height: 80px;
                object-fit: contain;" alt="image" target="_black" class="border">
            </div>
        </template>



    </div>
</template>

<script>
export default {
    props: {
        name: {
            required: true,
            default: 'selected_images'
        },
        multiple: {
            default: false,
        },
        classNames: {
            default: "form-control",
        },
        accept: {
            required: true,
        },
        images: {
            default: [],
            required: false,
        },

    },
    data: () => ({
        component_images: [],
        value: null
    }),
    watch: {
        images: function (v) {
            this.component_images = this.images;
            this.value = this.images[0];
        }
    },

    methods: {
        preview: function () {
            let that = this;
            console.log("image", that)
            that.component_images = [];
            that.value = null;
            [...that.$refs.input_files.files].forEach(el => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const base64String = e.target.result;
                    that.component_images.push(base64String);
                    that.value = base64String;
                };
                reader.readAsDataURL(el);
            })
        }


    }
}
</script>

<style></style>
