<template>
    <div class="">
        <div class="taskToolBar mt-3 align-items-center">
            <div class="taskToolBar_title">
                <i class="fa-solid fa-clipboard me-2" style="color: #a2a2a2;"></i>
                All my tasks
            </div>
            <div class="vertical-line"></div>
            <a-dropdown trigger="click" :open="isSortVisible" @click="toggleSortVisibility">
                <div class="taskToolBar_view text" @click.stop>
                    <i class="fa-solid fa-arrows-up-down me-2"></i>
                    View
                </div>
                <template #overlay>
                    <div class="option mt-3  d-flex flex-column p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <span>Sort by</span>
                            <button class="viewPicker" v-if="currentView === `time`" @click.stop
                                @click="handleViewChange('nothing')">Time</button>
                            <button class="viewPicker" v-if="currentView === `nothing`" @click.stop
                                @click="handleViewChange('time')">List</button>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <span>Task details</span>
                            <button class="viewPicker" v-if="viewState === 'show'" @click.stop
                                @click="toggleView('hide')">Hide</button>
                            <button class="viewPicker" v-else @click="toggleView('show')" @click.stop>Show</button>
                        </div>
                    </div>
                </template>
            </a-dropdown>


            <div class="vertical-line"></div>
            <div class="taskToolBar_moreOption text fa-lg">
                <i class="fa-solid fa-ellipsis"></i>
            </div>
        </div>


        <div class="taskRoute_task mt-4">
            <div v-if="viewState === 'show'">
                <sortBytime :panels="filteredPanels" />
            </div>
        </div>
    </div>
</template>

<script setup>


import sortBytime from '../AllTask/sortBytime.vue';
import { ref, onMounted, onUnmounted, computed } from 'vue';


const isSortVisible = ref(false);

const viewState = ref('show');
const currentView = ref('nothing');

const toggleView = (state) => {
    viewState.value = state;
};

const toggleSortVisibility = () => {
    isSortVisible.value = !isSortVisible.value;
};

const handleViewChange = (view) => {
    currentView.value = view;

};
const handleOutsideClick = (event) => {
    const dropdownFilter = document.querySelector('.ant-dropdown');
    const tooltip = document.querySelector('.ant-tooltip-inner');
    if (dropdownFilter && !dropdownFilter.contains(event.target) && (!tooltip || !tooltip.contains(event.target))) {
        isFilterVisible.value = false;
    }

    const dropdownSort = document.querySelector('.ant-dropdown');
    if (dropdownSort && !dropdownSort.contains(event.target) && (!tooltip || !tooltip.contains(event.target))) {
        isSortVisible.value = false;
    }
};


onMounted(() => {
    document.addEventListener('click', handleOutsideClick);
});

onUnmounted(() => {
    document.removeEventListener('click', handleOutsideClick);
});


const filteredPanels = computed(() => {
    const currentItem = items.value.find(item => item.type === currentView.value);
    return currentItem ? currentItem.panels : [];
});


const items = ref([
    {
        type: 'time',
        panels: [
            {
                key: '1',
                header: 'Today',
                tasks: [
                    { id: 1, title: 'Buy groceries', isChecked: false, list: 'Today' },
                    { id: 2, title: 'Clean the house', isChecked: true, list: 'Today' },
                    { id: 3, title: 'Call mom', isChecked: false, list: 'Today' },
                ],
            },
            {
                key: '2',
                header: 'Tomorrow',
                tasks: [
                    { id: 1, title: 'a', isChecked: false, list: 'Tomorrow' },
                    { id: 2, title: 'b', isChecked: true, list: 'Tomorrow' },
                ],
            },
            { key: '3', header: 'Upcoming', tasks: [] },
            { key: '4', header: 'SomeDay', tasks: [] },
        ]
    },
    {
        type: 'nothing',
        panels: [
            {
                key: '1',
                header: '',
                tasks: [
                    { id: 1, title: 'Buy groceries', isChecked: false, list: 'Today' },
                    { id: 2, title: 'Clean the house', isChecked: true, list: 'Today' },
                    { id: 3, title: 'Call mom', isChecked: false, list: 'Today' },
                ],
            }
        ],
    },
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

.option {
    background-color: #252525;
    color: #e4e4e4;
    border-radius: .5rem;
    width: 15rem;
}

.option button {
    background-color: transparent;
    border: 0;
    cursor: pointer;
    color: #0083ff;
}


.filterOption_items:hover,
.filterOption:hover {
    cursor: pointer;
    background-color: #838383;
}

.ant-tooltip-inner {
    background-color: #252525 !important;
    padding: 0 !important;
}
</style>