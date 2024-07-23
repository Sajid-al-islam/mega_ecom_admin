<template lang="">
    <div class="d-flex">
        <create />
        <export-all />
        <export-selected />
        <trash />
        <clear-selected />

        <slot/>
    </div>
</template>
<script>
import Create from "./action_buttons/Create.vue"
import ExportAll from "./action_buttons/ExportAll.vue"
import ExportSelected from "./action_buttons/ExportSelected.vue"
import Trash from "./action_buttons/Trash.vue"
import ClearSelected from "./action_buttons/ClearSelected.vue"
import clear_selected from '../../setup/store/actions/clear_selected';
export default {
    components: {
        Create,
        ExportAll,
        ExportSelected,
        Trash,
        ClearSelected,
    }
}
</script>
<style lang="">

</style>
