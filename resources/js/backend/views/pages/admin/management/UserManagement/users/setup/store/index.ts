import { defineStore } from "pinia";
import { initialState } from "./initia_state";

/** async actions */
import all from "./async_actions/all";
import create from "./async_actions/create";
import details from "./async_actions/details";
import update from "./async_actions/update";

/** actions */
import set_page from "./actions/set_page";
import set_paginate from "./actions/set_paginate";
import set_show_details_canvas from "./actions/set_show_details_canvas";
import set_show_filter_canvas from "./actions/set_show_filter_canvas";
import set_item from "./actions/set_item";
import set_filter_criteria from "./actions/set_filter_criteria";

export const store = defineStore("users_store", {
    state: () => initialState,
    getters: {},
    actions: {
        /* async actions */
        get_all: all,
        create: create,
        update: update,
        details: details,

        /* actions */
        set_page,
        set_paginate,
        set_show_details_canvas,
        set_item,
        set_show_filter_canvas,
        set_filter_criteria,
    },
});
