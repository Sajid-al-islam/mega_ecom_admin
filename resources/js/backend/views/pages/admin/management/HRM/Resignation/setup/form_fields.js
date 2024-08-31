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
        name: "is_termination",
        label: "Termination status",
        type: "select",
        data_list: [
            {
                label: 'select',
                value: "",
            },
            {
                label: 'Yes',
                value: "1",
            },
            {
                label: 'No',
                value: "0",
            }
        ],
    },

    {
        name: "is_resignation",
        label: "Resignation status",
        type: "select",
        data_list: [
            {
                label: 'select',
                value: "",
            },
            {
                label: 'Yes',
                value: "1",
            },
            {
                label: 'No',
                value: "1",
            }
        ],
    },

    {
        name: "resignation_letter",
        label: "Resignation Letter",
        type: "file",
        multiple: false
    },

    {
        name: "letter_recieved_date",
        label: "Letter recieved date",
        type: "date",
        value: "",
    },

    {
        name: "resign_date",
        label: "Resign date",
        type: "date",
        value: "",
    },

    {
        name: "applied_resign_rules",
        label: "Resign rules",
        type: "select",
        data_list: [
            {
                label: 'select',
                value: "",
            },
            {
                label: 'Sack',
                value: "1",
            },
            {
                label: 'Company Change',
                value: "2",
            }
        ],
    },

    {
        name: "status",
        label: "Status",
        type: "select",
        data_list: [
            {
                label: 'select',
                value: "",
            },
            {
                label: 'Active',
                value: "1",
            },
            {
                label: 'In active',
                value: "0",
            }
        ],
    },

    {
        name: "reason_for_resignation",
        label: "Reason for resignation",
        type: "text",
        value: "",
    },

    {
        name: "good_or_bad_activities",
        label: "Activity type",
        type: "select",
        data_list: [
            {
                label: 'select',
                value: "",
            },
            {
                label: 'Good activity',
                value: "1",
            },
            {
                label: 'Bad Activity',
                value: "0",
            }
        ],
    },

    {
        name: "is_resigned_applied",
        label: "Resigned applied",
        type: "select",
        data_list: [
            {
                label: 'select',
                value: "",
            },
            {
                label: 'Yes',
                value: "1",
            },
            {
                label: 'No',
                value: "0",
            }
        ],
    },
];
