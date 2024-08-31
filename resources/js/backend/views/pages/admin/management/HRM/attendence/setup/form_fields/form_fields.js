export default [
    {
        name: "user",
        label: "select user",
        type: "select",
        data_list: [
            {
                label: 'select',
                value: "",
            },
            {
                label: 'employee 1',
                value: "1",
            },
            {
                label: 'employee 2',
                value: "2",
            },
            {
                label: 'employee 3',
                value: "3",
            },
        ],
    },

    {
        name: "in_time",
        label: "In time",
        type: "time",
        value: "",
    },
    {
        name: "out_time",
        label: "Out time",
        type: "time",
        value: "",
    },

    {
        name: "Grace time",
        label: "grace_time",
        type: "text",
        value: "",
    },
    {
        name: "working_hours",
        label: "Working hours",
        type: "number",
        value: "",
    },
    {
        name: "status",
        label: "status",
        type: "select",
        data_list: [
            {
                label: 'select',
                value: "",
            },
            {
                label: 'Present',
                value: "present",
            },
            {
                label: 'Absent',
                value: "absent",
            }
        ],
    },

    {
        name: "late_time",
        label: "Late time",
        type: "number",
        value: "",
    },

    {
        name: "over_time",
        label: "Over time",
        type: "number",
        value: "",
    },

    {
        name: "early_out_time",
        label: "Early Out time",
        type: "time",
        value: "",
    },
];
