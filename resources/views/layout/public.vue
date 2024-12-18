<template>


    <div class="container-fluid p-0 m-0">
        <div class="row ">
            <div class="col-sm-2 p-0">
                <TheMenu />
            </div>
            <div class="col-12 col-sm-10">
                <router-view></router-view>
                b
            </div>
        </div>
    </div>

</template>

<script>
import TheHeader from '../component/TheHeader.vue';
import TheMenu from '../component/TheMenu.vue';
export default {
    components: {
        TheHeader,
        TheMenu
    }
}
</script>