<template>
    <div class="d-flex allTask_sortTime ">
        <div class="allTask_sortTimeItem ">
            <div class="allTask_sortTimeContent">
                <a-collapse v-model:activeKey="activeKey">
                    <a-collapse-panel v-for="(panel, index) in panels" :key="panel.key" :header="panel.header"
                        :showArrow="false">
                        <Draggable v-if="panel.tasks && panel.tasks.length" v-model="panel.tasks" item-key="id"
                            animation="200" class="draggable-list">
                            <div v-for="(task, idx) in panel.tasks" :key="task.id"
                                class="allTask_sortTimeTask d-flex align-items-center draggable-item">
                                <i v-if="task.isChecked" class="fa-solid fa-circle-check fa-lg icon"
                                    @click="toggleCheck(panel.key, idx)"></i>
                                <i v-else class="fa-regular fa-circle fa-lg icon"
                                    @click="toggleCheck(panel.key, idx)"></i>


                                <div class="allTask_sortTimeTask_content w-100 ms-2">
                                    <div class="title">{{ task.title }}</div>
                                    <div class="d-flex align-items-center" v-if="!task.isChecked">
                                        <div class="tag"></div>
                                        <div style="color: #838383; font-size: .5rem;" class="me-2 ms-2">
                                            |
                                        </div>
                                        <div class="list">{{ task.list }}</div>
                                    </div>
                                </div>
                                <i class="fa-solid fa-xmark icon fa-lg item icon" v-if="task.isChecked"></i>
                                <i class="fa-solid fa-ellipsis-vertical icon" v-else></i>
                            </div>
                        </Draggable>

                    </a-collapse-panel>
                </a-collapse>
            </div>
            <div class="allTask_sortTimeAddTask  ">
                <transition name="fadeInUp" v-if="(isSlideUpActive)">
                    <div v-if="(activeView === 'mylists' && myLists.length > 0) || (activeView === 'tag')"
                        class="allTask_sortTimeItems pb-4 ps-3 pe-3">
                        <div v-if="activeView === 'mylists'" class="item myLists mt-3" v-for="(item, index) in myLists"
                            :key="index">
                            <div class="name">{{ item.name }}</div>
                            <div class="quantity">{{ item.quantity }}</div>
                        </div>

                        <div v-if="activeView === 'tag'" class="item tag mt-3">
                            #Priority
                        </div>
                    </div>
                </transition>

                <transition name="fadeInUp">
                    <div v-if="isSlideUpActive" class="allTask_sortTimeAddTaskItems ps-3 pe-3 pt-2">
                        <div class="ps-2 pe-2 pt-2 pb-2">
                            <button type="button" class="btn pt-1 pb-1" @click="toggleView('mylists')">
                                <i class="fa-regular fa-note-sticky fa-lg icon me-2"></i>
                            </button>
                        </div>
                        <div class="ps-2 pe-2 pt-2 pb-2">
                            <button type="button" class="btn pt-1 pb-1">
                                <i class="fa-solid fa-bell icon"></i>
                            </button>
                        </div>
                        <div class="ps-2 pe-2 pt-2 pb-2">
                            <button type="button" class="btn pt-1 pb-1" @click="toggleView('tag')">
                                <i class="fa-solid fa-quote-left fa-lg me-2 icon"></i>
                            </button>
                        </div>
                    </div>
                </transition>

                <div style="background-color: #252525;" class="p-3 allTask_addTask">
                    <div class="d-flex align-items-center allTask_addTaskItems ps-2 pe-2 ">
                        <textarea id="taskInput" class="todayAddTask_input" placeholder="Nhập tên công việc"
                            v-model="newTask" @input="adjustHeight" @focus="isSlideUpActive = true"
                            @keydown.enter.prevent="addTask"></textarea>
                        <i class="fa-solid fa-arrow-up icon"></i>
                    </div>
                </div>
            </div>
        </div>
        <Task />
    </div>
</template>



<script setup>
import Task from '../../../component/Task.vue';
import { ref, onMounted, onUnmounted, watch } from 'vue';
import { VueDraggableNext } from 'vue-draggable-next'

const props = defineProps({
    panels: {
        type: Array,
        required: true,
    },
});


const Draggable = VueDraggableNext;
const isSlideUpActive = ref(false);
const activeKey = ref(['1']);
const activeView = ref('');



const newTask = ref('');

const addTask = () => {
    if (newTask.value.trim() !== '') {
        const panel = props.panels.find((p) => p.key === activeKey.value[0]) || props.panels[0];

        if (panel) {
            panel.tasks.push({
                id: Date.now(),
                title: newTask.value.trim(),
                isChecked: false,
                list: panel.header,
            });
            newTask.value = '';
        }
    }
};

const toggleCheck = (panelKey, taskIndex) => {
    const panelIndex = props.panels.findIndex((p) => p.key === panelKey);
    if (panelIndex !== -1 && props.panels[panelIndex].tasks[taskIndex]) {
        props.panels[panelIndex].tasks[taskIndex].isChecked = !props.panels[panelIndex].tasks[taskIndex].isChecked;
    }
};


const myLists = ref([
    { name: 'Personal', quantity: '3 Tasks' },
    { name: 'Work', quantity: '5 Tasks' },
]);




const toggleView = (view) => {
    activeView.value = activeView.value === view ? '' : view;
};


const adjustHeight = (event) => {
    const textarea = event.target;
    textarea.style.height = "44px";
    textarea.style.height = `${textarea.scrollHeight}px`;
};

const handleClickOutside = (event) => {
    const addTaskElement = document.querySelector('.allTask_sortTimeAddTask');
    if (addTaskElement && !addTaskElement.contains(event.target)) {
        isSlideUpActive.value = false;
    }
};

onMounted(() => {
    document.addEventListener('mousedown', handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener('mousedown', handleClickOutside);
});

watch(isSlideUpActive, (newValue) => {
    if (newValue) {
        activeView.value = '';
    }
});
</script>


<style>
.allTask_sortTime {
    height: 95vh;

}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.allTask_sortTimeContent {
    height: 90%;
    overflow-y: auto;
}

.allTask_sortTimeContent::-webkit-scrollbar {
    width: 3px;
}

.allTask_sortTimeContent::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 3px;
}

.allTask_sortTimeContent::-webkit-scrollbar-track {
    background: transparent;
    border-radius: 3px;
}


.allTask_sortTimeItem {
    background-color: #161616;
    margin-right: 1.5rem;
    width: 40%;
    border-radius: 1rem;
    height: 90%;

    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
    animation: slideUp 0.3s ease-out;

    display: flex;
    flex-direction: column;
    justify-content: space-between;
    overflow: hidden;
}

.allTask_sortTimeTask {
    padding: .25rem .5rem;
    border-radius: .5rem;
    cursor: pointer;
}

.allTask_sortTimeTask:hover {
    background-color: #252525;
}

.allTask_sortTimeTask .list {
    color: #838383;
    font-size: .7rem;
}

.allTask_sortTimeItem .icon {
    color: #838383;
    cursor: pointer;
}

.allTask_sortTimeItem .icon:hover {
    color: #0083ff;
}

.allTask_sortTimeTask_content .title {
    font-size: 1rem;
}


.allTask_sortTimeAddTask {
    display: flex;
    flex-direction: column;
    margin-top: auto;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
}

.allTask_addTask {
    position: relative;
    z-index: 3;
}

.allTask_sortTimeAddTaskItems {
    position: relative;
    z-index: 2;
}

.allTask_sortTimeItems {
    position: relative;
    z-index: 1;
}

.allTask_sortTimeAddTask .allTask_addTaskItems {
    border: .25px solid #838383;
    border-radius: .5rem;
    background-color: #424242;

}

.allTask_sortTimeAddTask .allTask_addTaskItems:hover {
    border: 1px solid #0083ff;
}

.allTask_sortTimeAddTaskItems {
    background-color: #252525;
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    box-shadow: 0 -5px 10px rgba(0, 0, 0, 0.3);
    gap: 1rem;
}

.allTask_sortTimeAddTaskItems .btn {
    width: 100%;
    border-radius: .5rem;
    background-color: transparent;
    border: 0;
    cursor: pointer;
}

.allTask_sortTimeAddTaskItems .btn:active {
    background-color: #838383;
}

.allTask_sortTimeAddTaskItems .btn:hover .icon {
    color: #0083ff;
}

.allTask_sortTimeItems {
    background-color: #252525;
}

.allTask_sortTimeItems .name {
    color: #0083ff;
}

.allTask_sortTimeItems .quantity {
    color: #838383;
    font-size: .8rem;
}

.allTask_sortTimeItems .tag {
    color: #ecc81f;
}

/* ant */
.allTask_sortTimeItem .ant-collapse {
    border: none;
    background-color: transparent;
    color: white;
    padding: .5rem 1rem;
}

.allTask_sortTimeItem .ant-collapse-item {
    border: none;
}

.allTask_sortTimeItem .ant-collapse-header {
    border-bottom: none;
}

.allTask_sortTimeItem .ant-collapse-content {
    border-top: none;
    background-color: transparent;
}

.allTask_sortTimeItem .ant-collapse-header {
    color: #ffffff !important;
    font-weight: 600;
    font-size: 1rem;
}

.allTask_sortTimeItem .ant-collapse-header:hover {
    color: #0083ff !important;

}

.allTask_sortTimeItem .ant-collapse-content {
    color: #ffffff;
}

.allTask_sortTimeItem .ant-collapse-content>p {
    color: #ffffff;
}

.allTask_sortTimeItem .ant-collapse-content-box {
    padding: 0 !important;
}

@keyframes fadeInUp {
    from {
        transform: translate3d(0, 100%, 0);
        visibility: visible;
    }

    to {
        transform: translate3d(0, 0, 0);
    }
}

.fadeInUp-enter-active {
    animation: fadeInUp 0.5s ease-out;
}

.fadeInUp-leave-active {
    animation: fadeInUp 0.5s ease-in reverse;
}
</style>