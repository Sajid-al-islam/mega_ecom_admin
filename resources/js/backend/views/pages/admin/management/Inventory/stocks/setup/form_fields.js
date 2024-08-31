export default [

    {
        name: "date",
        label: "date",
        type: "date",
        value: "",
    },
    {
        name: "stock_type",
        label: "stock_type",
        type: "select",
        data_list: [
            {
                label: 'initial',
                value: 'initial',
            },
            {
                label: 'purchase',
                value: 'purchase',
            },
            {
                label: 'sales',
                value: 'sales',
            },
            {
                label: 'return',
                value: 'return',
            },
            {
                label: 'waste',
                value: 'waste',
            },
        ],
    },

    {
        name: "product_id",
        label: "product_id",
        type: "number",
        value: "",
    },
    {
        name: "qty",
        label: "qty",
        type: "number",
        value: "",
    },
    {
        name: "bill_receipt_no",
        label: "bill_receipt_no",
        type: "text",
        value: "",
    },
    {
        name: "product_wearhouse_id",
        label: "product_wearhouse_id",
        type: "number",
        value: "",
    },
    {
        name: "purchase_order_id",
        label: "purchase_order_id",
        type: "number",
        value: "",
    },
    {
        name: "purchase_return_id",
        label: "purchase_return_id",
        type: "number",
        value: "",
    },
    {
        name: "sales_order_id",
        label: "sales_order_id",
        type: "number",
        value: "",
    },
    {
        name: "sales_return_id",
        label: "sales_return_id",
        type: "number",
        value: "",
    },

];
