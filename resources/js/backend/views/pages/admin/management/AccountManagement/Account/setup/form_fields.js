export default [

    // {
    //     name: "account_head_id",
    //     label: "account_head_id",
    //     type: "number",
    //     value: "",
    // },
    {
        name: "title",
        label: "title",
        type: "text",
        value: "",
    },
    {
        name: "description",
        label: "description",
        type: "text",
        value: "",
    },
    {
        name: "transaction_start_date",
        label: "Date of Transaction ",
        type: "date",
        value: "",
    },
    {
        name: "account_transaction_type",
        label: "Account Transaction Type ",
        type: "select",
        data_list: [
            {
                label: 'income',
                value: 'income',
            },
            {
                label: 'expense',
                value: "expense",
            },
        ]
    },


];
