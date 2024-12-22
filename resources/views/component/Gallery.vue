<template>
    <div class="gallery d-flex">
        <div v-for="(gallery, index) in galleries" :key="index" :style="{ animationDelay: `${index * 0.05}s` }"
            class="galleryCard d-flex flex-column me-3">
            <div class="galleryCard_header text-white fw-bold d-flex align-content-center">
                {{ gallery.header }}
                <span class="text-secondary ms-2">{{ gallery.weekDay }}</span>
            </div>
            <div class="galleryCard_content mt-3">
                <Draggable v-model="gallery.tasks" item-key="id" group="tasksGroup" animation="200"
                    class="draggable-list">
                    <div v-for="(task, index) in gallery.tasks" :key="task.id"
                        class="galleryCard_task d-flex align-items-center draggable-item">
                        <i v-if="task.isChecked" class="fa-solid fa-circle-check fa-lg icon"
                            @click="toggleCheck(task.id, gallery.id)"></i>
                        <i v-else class="fa-regular fa-circle fa-lg icon" @click="toggleCheck(task.id, gallery.id)"></i>

                        <div class="galleryCard_task w-100 ms-2 text-white">
                            <div class="title">{{ task.title }}</div>
                            <div class="d-flex align-items-center mt-1">
                                <div class="list">{{ task.list }}</div>
                            </div>
                        </div>
                        <i class="fa-solid fa-xmark icon fa-lg item icon" v-if="task.isChecked"></i>
                        <i class="fa-solid fa-ellipsis-vertical icon" v-else></i>
                    </div>
                </Draggable>
            </div>
            <div class="galleryCard_footer mt-3 d-flex flex-column">
                <transition name="fadeInUp">
                    <div v-if="gallery.isSlideUpActive" class="allTask_sortTimeAddTaskItems ps-3 pe-3 pt-2">
                        <div class="ps-2 pe-2 pt-2 pb-2">
                            <button type="button" class="btn pt-1 pb-1" @click="showModal">
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
                <div class="d-flex align-items-center gallery_addTaskItems ps-2 pe-2 ">
                    <textarea id="taskInput" class="todayAddTask_input" placeholder="Nhập tên công việc"
                        @input="adjustHeight" @focus="handleFocus(gallery)"
                        @keydown.enter.prevent="addTask(gallery)"></textarea>
                    <i class="fa-solid fa-arrow-up icon"></i>
                </div>
            </div>

        </div>

    </div>
    <a-modal v-model:open="open" :closable="false" :footer="null">
        <a-card title="List">
            <div class="header text-white">
                <div class="text fw-bold">My lists</div>
            </div>
            <div class="content text-white">
                <div class="listItems">
                    <div class="item d-flex flex-column justify-content-center">
                        <div class="line"></div>
                        <button class="w-100  btn">
                            <div class="d-flex justify-content-between align-items-center fs-6 ps-3 pe-3">
                                <div class="text">Personal</div>
                                <i class="fa-solid fa-circle-check fa-lg icon" style="color: #23ce88;"></i>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </a-card>
    </a-modal>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { VueDraggableNext } from 'vue-draggable-next';

const Draggable = VueDraggableNext;
const open = ref(false);

const props = defineProps({
    galleries: {
        type: Array,
        required: true,
    },
});
const galleries = props.galleries;

// Hàm toggle trạng thái checked của task
const toggleCheck = (taskId, galleryId) => {
    const gallery = galleries.find(g => g.id === galleryId);
    const task = gallery.tasks.find(t => t.id === taskId);
    if (task) {
        task.isChecked = !task.isChecked;
    }
};

const adjustHeight = (event) => {
    const textarea = event.target;
    textarea.style.height = "44px";
    textarea.style.height = `${textarea.scrollHeight}px`;
};
const handleFocus = (gallery) => {
    gallery.isSlideUpActive = true;
};

// Hàm mở modal
const showModal = () => {
    open.value = true;
};

const addTask = (gallery) => {
    const textarea = event.target;
    if (textarea.value.trim()) {
        const newTask = {
            id: Date.now(),
            title: textarea.value.trim(),
            list: 'Personal',
            isChecked: false,
        };

        gallery.tasks.push(newTask);
        textarea.value = '';
    }
};

const handleClickOutside = (event) => {
    const galleryFooter = event.target.closest('.galleryCard_footer');
    if (!galleryFooter) {
        galleries.forEach(gallery => {
            gallery.isSlideUpActive = false;
        });
    }
};

onMounted(() => {
    document.addEventListener('mousedown', handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener('mousedown', handleClickOutside);
});
</script>


<style>
.gallery {
    width: 100%;
    overflow-x: auto;
    display: flex;
    padding-bottom: 1rem;
    max-height: 85vh;

}

.galleryCard {
    background-color: #161616;
    width: 18rem;
    height: 90%;
    border-radius: 1rem;
    padding: .75rem;
    margin-right: 10px;
    flex-shrink: 0;
    animation: fadeInUp1 0.5s ease-out forwards;
}


.gallery::-webkit-scrollbar {
    width: 3px;
    height: 5px;
}

.gallery::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 3px;
}

.gallery::-webkit-scrollbar-track {
    background: transparent;
    border-radius: 3px;
}

.icon {
    color: #838383;
    cursor: pointer;
}

.icon:hover {
    color: #0083ff;
}

.galleryCard_task {
    padding: .25rem .5rem;
    border-radius: .5rem;
    cursor: pointer;
}

.galleryCard_task:hover {
    background-color: #252525;
}

.galleryCard_task .list {
    color: #838383;
    font-size: .7rem;
}

.galleryCard_footer {
    display: flex;
    flex-direction: column;
    margin-top: auto;
}

.allTask_sortTimeAddTaskItems {
    background-color: transparent;
    position: relative;
    z-index: 1;
}

.gallery_addTaskItems {
    background-color: #161616;
    border-radius: .5rem;
    border: 1px solid white;
    position: relative;
    z-index: 2;
}

.ant-modal-content {
    padding: 0 !important;
}

.ant-card-bordered {
    border: 0;
}

.ant-card {
    background-color: #161616;
}

.ant-card-head {
    background-color: #252525 !important;

}

.ant-card-head-wrapper {
    text-align: center;
    color: white;
}

.ant-card-body {
    background-color: #161616;
    padding: 0 0 1rem 0 !important;

}

.ant-card-body .header {
    font-size: 1.2rem;
    padding: .5rem 1rem;

}

.ant-card-body .content {
    color: white;

}

.ant-card-body .line {
    background-color: #838383;
    height: 1px;

    padding: 0 .5rem;
    margin: 0 1rem;
}

.ant-card-body button {
    background-color: transparent;
    border: 0;
    padding: .75rem 0;
    cursor: pointer;
}

.ant-card-body button:hover {
    background-color: #252525;
}

@keyframes fadeInUp1 {
    from {
        transform: translate3d(0, 100%, 0);
        visibility: visible;
        opacity: 0;
    }

    to {
        transform: translate3d(0, 0, 0);
        opacity: 1;
    }
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
