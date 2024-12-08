<template>


    <TheHeader />


    <div class="container-fluid mt-3">
        <div class="row">

            <div class="col-12 col-sm-9">
                <router-view></router-view>
            </div>
        </div>
    </div>

</template>

<script>
import TheHeader from '../component/TheHeader.vue';
export default {
    components: {
        TheHeader
    }
}
</script>