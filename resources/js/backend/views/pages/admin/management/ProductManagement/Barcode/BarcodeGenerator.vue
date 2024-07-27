<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Print Labels</h4>
            </div>
            <div class="card-body">
                <div>
                    <button class="btn btn-info mr-2" @click.prevent="generate_code">
                        generate code
                    </button>

                    <button @click.prevent="print_codes" class="btn btn-secondary">
                        Print
                    </button>
                </div>
                <div class="card_body_fixed_height" id="print_area" v-show="show">
                    <div v-for="i in count" :key="i" class="mb-3 text-center">
                        <div class="bg-white d-inline-block text-dark p-3" style="max-width: 250px;">
                            <div>{{ company }}</div>
                            <div>{{ product }}</div>
                            <div><b>Price:</b>৳{{ price }}</div>
                            <svg :id="`barcode${i}`"></svg>
                            <div>{{ label }}</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: ()=>({
        count: 100,
        label: 'EL12940',
        price: 435,
        product: "Vention NAFB0 USB Apt-X Bluetooth 5.1 Adapter",
        company: "ETEK Enterprise",
        show: false,
    }),
    mounted: function () {

    },
    methods: {
        generate_code: function () {
            this.show = true;
            try {
                for (let index = 1; index <= this.count; index++) {
                    JsBarcode("#barcode"+index, this.label, {
                        format: "CODE39",
                        lineColor: "#000",
                        width: 1,
                        height: 40,
                        displayValue: false
                    });
                }
            } catch (error) {
                console.log(error);
            }
        },
        print_codes: function(){
            $("#print_area").print(/*options*/);
        }
    }
}
</script>

<style></style>
