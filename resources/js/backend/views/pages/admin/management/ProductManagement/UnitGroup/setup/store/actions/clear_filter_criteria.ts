import { mapActions, mapWritableState } from "pinia";
import { store } from "..";

async function clear_filter_criteria (){
    let state = mapWritableState(store, [
        'filter_criteria'
    ]);

    state.filter_criteria.set({});
}

export default clear_filter_criteria;
