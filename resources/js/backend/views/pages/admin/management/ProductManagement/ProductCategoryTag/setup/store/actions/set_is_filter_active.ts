import { mapActions, mapWritableState } from "pinia";
import { store } from "..";

async function set_is_filter_active (data=false){
    let state = mapWritableState(store, [
        'is_filter_active'
    ]);

    state.is_filter_active.set(data);
}

export default set_is_filter_active;
