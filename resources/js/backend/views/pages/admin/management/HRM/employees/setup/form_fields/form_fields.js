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
        name: "gender",
        label: "gender",
        type: "select",
        data_list: [
            {
                label: 'select',
                value: "",
            },
            {
                label: 'male',
                value: "male",
            },
            {
                label: 'female',
                value: "female",
            },
            {
                label: 'other',
                value: "other",
            },
        ],
    },

    {
        name: "nick_name",
        label: "nick name",
        type: "text",
        value: "",
    },
    {
        name: "employee_code",
        label: "employee code",
        type: "text",
        value: "",
    },
    {
        name: "date_of_birth",
        label: "date of birth",
        type: "date",
        value: "",
    },

    // {
    //     name: "role_serial",
    //     label: "User Role",
    //     type: "select",
    //     data_list: [
    //         {
    //             label: 'admin',
    //             value: 2,
    //         },
    //         {
    //             label: 'customer',
    //             value: 3,
    //         },
    //         {
    //             label: 'sales',
    //             value: 4,
    //         },
    //         {
    //             label: 'account',
    //             value: 5,
    //         },
    //         {
    //             label: 'retailer',
    //             value: 6,
    //         },
    //         {
    //             label: 'supplier',
    //             value: 7,
    //         },
    //         {
    //             label: 'delivary man',
    //             value: 8,
    //         },
    //         {
    //             label: 'employee',
    //             value: 9,
    //         },
    //     ],
    // },
    {
        name: "date_of_birth",
        label: "date of birth",
        type: "date",
        value: "",
    },
    {
        name: "relation_ship",
        label: "Relation Ship status",
        type: "select",
        data_list: [
            {
                label: 'select',
                value: "",
            },
            {
                label: 'single',
                value: "single",
            },
            {
                label: 'married',
                value: "married",
            },
            {
                label: 'other',
                value: "other",
            },
        ],
    },
    {
        name: "nid",
        label: "NID card scan copy",
        type: "file",
        multiple: false,
        value: "",
    }
];
