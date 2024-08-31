<template lang="">
    <div class="d-flex">
        <create />
        <export-all />
        <export-selected />
        <trash />

        <slot/>
    </div>
</template>
<script>
import Create from "./action_buttons/Create.vue"
import ExportAll from "./action_buttons/ExportAll.vue"
import ExportSelected from "./action_buttons/ExportSelected.vue"
import Trash from "./action_buttons/Trash.vue"
export default {
    components: {
        Create,
        ExportAll,
        ExportSelected,
        Trash,
    }
}
</script>
<style lang="">

</style>
