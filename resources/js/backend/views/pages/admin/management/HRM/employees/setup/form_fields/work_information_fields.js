export default [
    {
        name: "joining_date",
        label: "Joining Date",
        type: "date",
        value: "",
    },

    {
        name: "payslip_generation_date",
        label: "Payslip Date",
        type: "date",
        value: "",
    },

    {
        name: "confirmation_date",
        label: "Confirmation Date",
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
        name: "department_id",
        label: "Department",
        type: "select",
        data_list: [
            {
                label: 'Accounting',
                value: "1",
            },
            {
                label: 'HR',
                value: "2",
            },
            {
                label: 'Engineering',
                value: "3",
            }
        ],
    },

    {
        name: "user_employee_job_position_id",
        label: "Job position",
        type: "select",
        data_list: [
            {
                label: 'Senior Accountant',
                value: "1",
            },
            {
                label: 'Senior software engineer',
                value: "2",
            }
        ],
    },

    {
        name: "user_employee_job_title_id",
        label: "Job title",
        type: "select",
        data_list: [
            {
                label: 'Account system manager',
                value: "1",
            },
            {
                label: 'Senior software engineer',
                value: "2",
            }
        ],
    },

    {
        name: "user_employee_office_location_id",
        label: "Employee office location",
        type: "select",
        data_list: [
            {
                label: 'Banani',
                value: "1",
            },
            {
                label: 'Mirpur',
                value: "2",
            }
        ],
    },

    {
        name: "user_employee_office_location_id",
        label: "Employee office location",
        type: "select",
        data_list: [
            {
                label: 'Banani',
                value: "1",
            },
            {
                label: 'Mirpur',
                value: "2",
            }
        ],
    },

    {
        name: "user_employee_type_id",
        label: "Employee Type",
        type: "select",
        data_list: [
            {
                label: 'Permanant',
                value: "1",
            },
            {
                label: 'Part time',
                value: "2",
            }
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
        name: "is_allow_flexible_time",
        label: "Flexible time allowed",
        type: "select",
        data_list: [
            {
                label: 'YES',
                value: "1",
            },
            {
                label: 'NO',
                value: "0",
            }
        ],
    },

    {
        name: "flexible_time_minitues",
        label: "Flexible time",
        type: "time",
        value: "",
    },

    {
        name: "re_joining_date",
        label: "Re-joining date",
        type: "date",
        value: "",
    },

    {
        name: "appoinment_letter",
        label: "Appoinment Letter",
        type: "file",
        multiple: false
    },
    // {
    //     name: "nid",
    //     label: "NID card scan copy",
    //     type: "file",
    //     multiple: false,
    //     value: "",
    // },
    // {
    //     name: "photo",
    //     label: "photo",
    //     type: "file",
    //     multiple: false,
    //     value: "",
    // },
];
