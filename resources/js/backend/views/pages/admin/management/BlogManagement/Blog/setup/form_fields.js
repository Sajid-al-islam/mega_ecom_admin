export default [


    {
        name: "title",
        label: "Enter your title",
        type: "text",
        value: "",
    },

    {
        name: "blog_type",
        label: "Select blog type",
        type: "select",
        value: "",
        multiple: false,
        data_list: [
            {
                "label": "Youtube link",
                "value": "Youtube_link",
            },
            {
                "label": "M3u8 link",
                "value": "m3u8_link",
            },

        ],
    },
    {
        name: "url",
        label: "Enter your url",
        type: "text",
        value: "",
    },
    {
        name: "tags",
        label: "Enter your  tag",
        type: "text",
        value: '',
    },
    {
        name: "publish_date",
        label: "Enter your publish date",
        type: "date",
        value: '',
    },
    {
        name: "writer",
        label: "Enter writer name",
        type: "text",
        value: '',
    },
    {
        name: "meta_title",
        label: "Enter your meta title",
        type: "text",
        value: "",
    },
    {
        name: "meta_description",
        label: "Enter your meta description",
        type: "text",
        value: '',
    },
    {
        name: "meta_keywords",
        label: "Enter your meta keywords",
        type: "text",
        value: '',
    },

    {
        name: "thumbnail_image",
        label: "Upload thumbnail image",
        type: "file",
        value: null,
        multiple: false
    },
    {
        name: "privecy_status",
        label: "Privecy status",
        type: "select",
        value: 'public',
        multiple: false,
        data_list: [
            {
                label: 'Private',
                value: 'private',
            },
            {
                label: 'Public',
                value: 'public',
            }
        ]
    },
    {
        name: "description",
        label: "Enter your description",
        type: "textarea",
        value: "",
    },



];
