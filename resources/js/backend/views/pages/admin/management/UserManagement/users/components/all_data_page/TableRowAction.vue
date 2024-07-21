<template lang="">
    <span @click.prevent="active_row($event)" class="icon"></span>
    <div class="table_action_btns">
        <ul>
            <li>
                <details-btn />
            </li>
            <li>
                <edit/>
            </li>
            <li>
                <deactive/>
            </li>
            <li>
                <destroy/>
            </li>

            <slot />
        </ul>
    </div>
</template>
<script>
import active_row from '../../helpers/table_active_row';
import Details from './action_buttons/Details.vue';
import Edit from './action_buttons/Edit.vue';
import Deactive from './action_buttons/Deactive.vue';
import Destroy from './action_buttons/Destroy.vue';
export default {
    components: {
        DetailsBtn: Details,
        Edit,
        Deactive,
        Destroy,
    },
    methods: {
        active_row,
    }
}
</script>
<style lang="">

</style>
