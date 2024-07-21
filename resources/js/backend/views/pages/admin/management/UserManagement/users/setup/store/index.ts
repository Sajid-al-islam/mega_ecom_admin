import axios from "axios";
import { defineStore } from "pinia";
import { anyObject } from "../../../../../../../../common_types/object";
import { initialState } from "./initia_state";

import all from "./async_actions/all";
import set_page from "./actions/set_page";
import set_paginate from "./actions/set_paginate";

let s_alert = (window as anyObject).s_alert;
let s_confirm = (window as anyObject).s_confirm;

export const store = defineStore("users_store", {
    state: () => initialState,
    getters: {},
    actions: {
        /* async actions */
        get_all: all,

        /* actions */
        set_page,
        set_paginate,

        get: async function (id) {
            let response = await axios.get(this.api+id);
            response = response.data.data;
            this.single_data = response;
        },

        store: async function (form) {
            let formData = new FormData(form);
            let response = await axios.post(this.api, formData);
            return response;
        },

        update: async function (form, id) {
            let formData = new FormData(form);
            let response = await axios.post(`${this.api}${id}?_method=PATCH`, formData);
            return response;
        },

        delete: async function (id) {
            var data = await s_confirm();
            if (data) {
                let response = await axios.delete(this.api+id);
                s_alert("Data deleted");
                this.all();
                console.log(response.data);
            }
        },
        bulk_action: async function (action, data) {
            let response = await axios.post(`${this.api}bulk-action`, { action, data })
            if (response.data.status === "success") {
                s_alert(response.data.message);
                this.all();
            }
        },

        // additional function
        // additional function


    },
});
