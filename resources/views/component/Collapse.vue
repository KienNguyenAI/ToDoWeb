<template>
    <a-collapse v-model:activeKey="activeKey">
        <a-collapse-panel v-for="(panel, index) in panels" :key="panel.key" :header="panel.header" :showArrow="false">
            <Draggable v-if="panel.tasks && panel.tasks.length" v-model="panel.tasks" item-key="id" animation="200"
                class="draggable-list">
                <div v-for="(task, idx) in panel.tasks" :key="task.id"
                    class="allTask_sortTimeTask d-flex align-items-center draggable-item">
                    <i v-if="task.isChecked" class="fa-solid fa-circle-check fa-lg icon"
                        @click="toggleCheck(panel.key, idx)"></i>
                    <i v-else class="fa-regular fa-circle fa-lg icon" @click="toggleCheck(panel.key, idx)"></i>

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
</template>

<script setup>
import { ref, defineProps, defineEmits } from 'vue';
import { VueDraggableNext } from 'vue-draggable-next';

const Draggable = VueDraggableNext;

defineProps({
    panels: {
        type: Array,
        required: true,
    },
});

const emit = defineEmits(['add-task']);

const activeKey = ref(['1']);

const toggleCheck = (panelKey, taskIndex) => {
    const panel = panels.find((p) => p.key === panelKey);
    if (panel) {
        panel.tasks[taskIndex].isChecked = !panel.tasks[taskIndex].isChecked;
    }
};

const addTask = (panelKey) => {
    const newTask = {
        id: Date.now(),
        title: 'New Task',
        isChecked: false,
        list: 'Default',
    };
    emit('add-task', panelKey, newTask);
};
</script>
