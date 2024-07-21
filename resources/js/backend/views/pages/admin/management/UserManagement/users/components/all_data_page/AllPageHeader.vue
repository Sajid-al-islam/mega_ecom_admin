<template lang="">
    <h5 class="text-capitalize mb-0"> {{ setup.all_page_title }} </h5>
    <div style="flex: 1;">
        <search/>
    </div>
    <div>
        <button class="btn btn-outline-success btn-sm">
            <i class="fa fa-gear"></i>
        </button>
    </div>
</template>
<script>
import Search from './Search.vue';
import setup from '../../setup';
export default {
    components: { Search },
    data: () => ({
        setup,
    })
}
</script>
<style lang="">

</style>
