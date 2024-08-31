export default [

    // {
    //     name: "account_head_id",
    //     label: "account_head_id",
    //     type: "number",
    //     value: "",
    // },
    {
        name: "department_code",
        label: "Department Code",
        type: "text",
        value: "",
    },
    {
        name: "department_name",
        label: "Department name",
        type: "text",
        value: "",
    },
    {
        name: "parent_department",
        label: "Parent department",
        type: "select",
        data_list: [
            {
                label: 'accounts',
                value: '1',
            },
            {
                label: 'marketing',
                value: "1",
            },
        ]
    },
    {
        name: "in_charge",
        label: "In charge",
        type: "text",
        value: "",
    },
    {
        name: "description",
        label: "Description",
        type: "text",
        value: "",
    },

];
