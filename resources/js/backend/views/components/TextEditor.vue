<template lang="">
    <div>
        <div>
            <button type="button" @click="is_show = !is_show;" class="btn btn-info">Click Here to Modify</button>
        </div>
        <div class="editor_description_box" :class="{active: is_show}">
            <div class="editor_box" :id="data_store">
                <div class="container">
                    <div :id="`editor`+data_store" v-html="data"></div>
                    <button type="button" @click="is_show = !is_show;" class="btn btn-info my-3">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    props: {
        default_data: {
            type: String,
            default: '',
        },
        data_store: String,
        set_value: {
            type: Function,
            default: () => '',
            required: true,
        },
    },
    created: function () {
        if (this.default_data) {
            this.data = this.default_data;
        }

        // let that = this;
        // setTimeout(() => {
        //     that.editor = CKEDITOR.replace('editor');
        // }, 500);
    },
    mounted: function () {
        this.editor = CKEDITOR.replace('editor' + this.data_store);
    },
    watch: {
        'data': {
            handler: function (v) {
                this.set_value(this.data_store, v);
            }
        },
        'editor': {
            handler: function (v) {
                v.on('change', this.set_data);
            },
        }
    },
    data: () => ({
        data: '',
        is_show: false,
        editor: null,
    }),
    methods: {
        onEditorInput: function (data, event, editor) {
            // console.log(data);
        },
        set_data: function (e) {
            this.data = e.editor.getData();
            // console.log(this.data);
        }
    },
}
</script>
<style scoped>
.ck-editor__main {
    max-height: calc(100vh - 215px);
    overflow-y: auto;
}

.editor_description_box {
    position: fixed;
    height: 100vh;
    width: 100vw;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, .5);
    z-index: 9999;
    transform: scale(0);
    opacity: 0;
    visibility: hidden;
    transition-duration: .3s;

    .editor_box {
        position: absolute;
        top: calc(50% + 13px);
        left: 50%;
        height: calc(100% - 79px);
        width: calc(100% - 20px);
        overflow-y: auto;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }

    &.active {
        transform: scale(1);
        opacity: 1;
        visibility: visible;
    }

}

.list_card tbody tr td {
    text-align: unset;
}

.ck-content .table {
    float: left;
}

.cke_notifications_area {
    display: none !important;
}

/* .ck-content .table table {
        border-style: dashed;
        border-color: hsl(90, 75%, 60%);
        border-width: 3px;
    } */

/* .ck-content .table table td {
        text-align: center;
        vertical-align: middle;
        padding: 10px
    } */
</style>
