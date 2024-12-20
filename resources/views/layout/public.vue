<template>
    <div class="container-fluid p-0 m-0">
        <div class="todo">
            <div class="row ">
                <div class="col-sm-2 ">
                    <TheMenu />
                </div>
                <div class="col-12 col-sm-10">
                    <router-view></router-view>

                </div>
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

<style>
.todo {
    background-image: url('/storage/background/background.jpg');
    background-size: cover;
}
</style>