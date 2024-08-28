export default [
    {
        name: "name",
        label: "name",
        type: "text",
        value: "",
    },

    {
        name: "email",
        label: "email",
        type: "text",
        value: "",
    },
    {
        name: "password",
        label: "password",
        type: "text",
        value: "",
    },

    {
        name: "phone_number",
        label: "phone",
        type: "text",
        value: "",
    },

    {
        name: "role_serial",
        label: "User Role",
        type: "select",
        data_list: [
            {
                label: 'admin',
                value: 2,
            },
            {
                label: 'customer',
                value: 3,
            },
            {
                label: 'sales',
                value: 4,
            },
            {
                label: 'account',
                value: 5,
            },
            {
                label: 'retailer',
                value: 6,
            },
            {
                label: 'supplier',
                value: 7,
            },
            {
                label: 'delivary man',
                value: 8,
            },
            {
                label: 'employee',
                value: 9,
            },
        ],
    },

    {
        name: "photo",
        label: "photo",
        type: "file",
        multiple: false,
        value: "",
    },
];
