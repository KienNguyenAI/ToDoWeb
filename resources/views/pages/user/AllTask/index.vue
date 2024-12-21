<template>
    <div class="">
        <div class="taskToolBar mt-3 align-items-center">
            <div class="taskToolBar_title">
                <i class="fa-solid fa-clipboard me-2" style="color: #a2a2a2;"></i>
                All my tasks
            </div>
            <div class="vertical-line"></div>
            <a-dropdown :placement="bottom" trigger="click">
                <div class="taskToolBar_view text">
                    <i class="fa-solid fa-arrows-up-down me-2"></i>
                    View
                </div>
                <template #overlay>
                    <div class="viewOption d-flex flex-column">

                    </div>
                </template>
            </a-dropdown>

            <div class="vertical-line"></div>
            <div class="taskToolBar_filter text">
                <i class="fa-solid fa-filter me-2"></i>
                Filter
            </div>
            <div class="vertical-line"></div>
            <div class="taskToolBar_moreOption text fa-lg">
                <i class="fa-solid fa-ellipsis"></i>
            </div>
        </div>


        <div class="taskRoute_task mt-4">
            <sortBytime :panels="panels" />
        </div>
    </div>
</template>

<script setup>


import sortBytime from './sortBytime.vue';
import { ref } from 'vue';

const panels = ref([
    {
        key: '1',
        header: 'Personal',
        tasks: [
            { id: 1, title: 'Buy groceries', isChecked: false, list: 'Personal' },
            { id: 2, title: 'Clean the house', isChecked: true, list: 'Personal' },
            { id: 3, title: 'Call mom', isChecked: false, list: 'Personal' },
        ],
    },
    { key: '2', header: 'Work', tasks: [] },
]);


</script>

<style>
.taskToolBar {
    display: inline-flex;
    background-color: #161616;
    padding: .5rem 1.5rem;
    border-radius: 2rem;
}

.vertical-line {
    width: 1px;
    height: 1.5rem;
    margin: 0 1rem;
    background-color: #424242;
    display: inline-block;
}

.taskToolBar .text {
    color: #838383;
    cursor: pointer;
}

.taskToolBar .text:hover {
    color: #0083ff;
    ;
}

.taskToolBar_title {
    color: #e4e4e4;
    font-size: 1.1rem;
    font-weight: 600;
}
</style>