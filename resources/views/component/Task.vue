<template>
    <div class="taskLayout_card d-flex flex-column p-4">
        <div class="taskLayout_header d-flex justify-content-between" style="color: #838383;">
            <span class="taskLayout_list">My lists > Personal</span>
            <div class="taskLayout_option d-flex align-items-center">
                <span class="me-3 fw-bold item">
                    Đánh dấu hoàn thành
                </span>
                <i class="fa-solid fa-bullseye icon me-3 item"></i>
                <i class="fa-solid fa-box-archive icon me-3 item"></i>
                <i class="fa-solid fa-xmark icon fa-lg item" @click="$emit('close')"></i>
            </div>
        </div>
        <div class="taskLayout_content d-flex flex-column mt-3">
            <textarea class="taskLayout_title" @input="adjustHeight"
                v-model="taskTitle">Create your first task</textarea>
            <div class="d-flex">
                <button class="btn me-3" type="button">
                    <i class="fa-regular fa-note-sticky me-2" style="color: #f5a623;"></i>
                    <span>Personal</span>
                </button>
                <button class="btn" type="button">
                    <i class="fa-solid fa-quote-left me-2" style="color: #096bc8;"></i>
                    <span>Tags</span>
                </button>
            </div>
            <div class="notes d-flex flex-column mt-4">
                <span class="mb-3" style="color: #838383;">NOTES</span>
                <textarea class="taskLayout_notes" @input="adjustHeight" placeholder="Nhập ghi chú của bạn tại đây"
                    v-model="notes"></textarea>
            </div>
            <div class="subtask d-flex flex-column mt-4">
                <span class="mb-3" style="color: #838383;">SUBTASKS</span>
                <!-- Thêm Draggable vào đây -->
                <Draggable v-model="subtasks" item-key="id" animation="200" class="taskLayout_subtasksList">
                    <div v-for="(subtask, index) in subtasks" :key="subtask.id"
                        class="taskLayout_subtasks d-flex align-items-center mb-2 draggable-item">

                        <i v-if="subtask.isChecked" class="fa-solid fa-circle-check"
                            style="color: #838383; cursor: pointer;" @click="toggleCheck(index)"></i>
                        <i v-else class="fa-regular fa-circle" style="color: #838383; cursor: pointer;"
                            @click="toggleCheck(index)"></i>
                        <textarea ref="subtaskInputs" class="ms-3 taskLayout_subtasksItems"
                            placeholder="Thêm mới subtasks" v-model="subtask.text"
                            :class="{ 'text-checked': subtask.isChecked }" @input="adjustHeight"
                            @focus="handleFocus(index)" @blur="handleBlur(index)"></textarea>
                        <i class="fa-solid fa-xmark icon fa-lg item deleteTask" style="color: #838383; cursor: pointer;"
                            @click="deleteSubtask(index)"></i>
                    </div>
                </Draggable>

                <div class="taskLayout_subtasksDisabled d-flex align-items-center" @click="addSubtask">
                    <i class="fa-regular fa-circle" style="color: #838383; pointer-events: none;"></i>
                    <textarea class="ms-3 taskLayout_subtasksItems" placeholder="Thêm mới subtasks" disabled
                        style="pointer-events: none;"></textarea>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, nextTick } from "vue";
import { VueDraggableNext } from "vue-draggable-next";

const Draggable = VueDraggableNext;

const taskTitle = ref("Create your first task");
const notes = ref("");

const subtasks = ref([
    { id: 1, text: "Subtask 1", isChecked: false, isFocused: false },
    { id: 2, text: "Subtask 2", isChecked: false, isFocused: false },
]);

const subtaskInputs = ref([]);

const addSubtask = async () => {
    const newId = Date.now(); // Sử dụng timestamp làm unique id
    subtasks.value.push({ id: newId, text: "", isChecked: false, isFocused: false });
    await nextTick();
    const newSubtaskInput = subtaskInputs.value[subtasks.value.length - 1];
    if (newSubtaskInput) {
        newSubtaskInput.focus();
    }
};

const handleFocus = (index) => {
    subtasks.value[index].isFocused = true;
};

const handleBlur = (index) => {
    if (!subtasks.value[index].text.trim()) {
        subtasks.value.splice(index, 1);
    } else {
        subtasks.value[index].isFocused = false;
    }
};

const toggleCheck = (index) => {
    subtasks.value[index].isChecked = !subtasks.value[index].isChecked;
};

const deleteSubtask = (index) => {
    subtasks.value.splice(index, 1);
};

const adjustHeight = (event) => {
    const textarea = event.target;
    textarea.style.height = "44px";
    textarea.style.height = `${textarea.scrollHeight}px`;
};
</script>

<style scoped>
@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.taskLayout_card {
    background-color: #161616;
    border-radius: 1rem;
    width: 35rem;
    padding: 1.5rem;
    height: 90%;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
    overflow-y: auto;
    animation: slideUp 0.5s ease-out;
}

.taskLayout_card::-webkit-scrollbar {
    width: 3px;
}

.taskLayout_card::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 3px;
}

.taskLayout_card::-webkit-scrollbar-track {
    background: transparent;
    border-radius: 3px;
}

.taskLayout_header span {
    font-size: 0.8rem;
    cursor: pointer;
}

.taskLayout_header .taskLayout_list:hover {
    text-decoration: underline;
}

.taskLayout_option .item:hover {
    color: #0083ff;
    cursor: pointer;
}

.taskLayout_content .taskLayout_notes,
.taskLayout_content .taskLayout_title {
    background-color: transparent;
    width: 100%;
    height: 2.75rem;
    border: none;
    resize: none;
    color: #e4e4e4;
    box-sizing: border-box;
    overflow: hidden;
    white-space: pre-wrap;
    word-wrap: break-word;
    min-height: 2.75rem;
    transition: height 0.1s ease-in-out;
}

.text-checked {
    text-decoration: line-through;
    color: #838383;
}

.taskLayout_content .taskLayout_notes:focus,
.taskLayout_content .taskLayout_title:focus {
    outline: none;
}

.taskLayout_title {
    font-size: 1.25rem;
    font-weight: 600;
}

.taskLayout_content .btn {
    background-color: #252525;
    padding: 0.5rem 1rem;
    color: #e4e4e4;
    border: 0;
    border-radius: 1rem;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.taskLayout_content .btn:hover {
    transform: translateY(-5px);
}

.taskLayout_subtasks.focused {
    border: 1px solid #0083ff;
}

.taskLayout_content .btn span {
    font-size: 0.8rem;
    font-weight: 600;
}

.taskLayout_notes {
    font-size: 0.85rem;
}

.taskLayout_subtasksDisabled,
.taskLayout_subtasks {
    background-color: transparent;
    padding: 0.5rem;
    cursor: pointer;
    border-radius: 0.5rem;
}

.taskLayout_subtasks:hover {
    background-color: #252525;
    border: 1px solid #0083ff;
}

.taskLayout_subtasksItems {
    background-color: transparent;
    cursor: pointer;
    width: 100%;
    height: 1.5rem;
    border: none;
    resize: none;
    color: #e4e4e4;
    box-sizing: border-box;
    overflow: hidden;
    white-space: pre-wrap;
    word-wrap: break-word;
    min-height: 1.5rem;
    transition: height 0.01s ease-in-out;
}

.taskLayout_subtasksItems:focus {
    outline: none;
}
</style>
