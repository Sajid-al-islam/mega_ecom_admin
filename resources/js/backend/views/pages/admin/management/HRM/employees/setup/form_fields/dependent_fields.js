export default [
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
        name: "photo",
        label: "photo",
        type: "file",
        multiple: false,
        value: "",
    },
];
