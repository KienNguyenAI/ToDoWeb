<template>
    <div class="d-flex flex-column vh-100 ">
        <a-list size="large" class="menu custom-list d-flex flex-column">
            <template #header>
                <div class="header-container d-flex align-items-center pt-3" style="padding-left: 1.5rem;">
                    <div class="avatar">
                        <template v-if="avatarSrc">
                            <img :src="avatarSrc" alt="Avatar" class="rounded-circle"
                                style="width: 2.5rem; height: 2.5rem;" @error="onImageError" />
                        </template>
                        <template v-else>
                            <div class="default-icon">

                            </div>
                        </template>
                    </div>
                    <div class="">
                        <div class="username  fs-5 ps-3" style="font-weight: 500;">Kiên</div>
                    </div>
                </div>
            </template>
            <!-- Nội dung menu-container -->
            <div class="menu">
                <router-link to="/myday" class="text">
                    <div class="content" :class="{ active: selectedContent === 'today' }"
                        @click="selectContent('today')">
                        <i class="fa-solid fa-chart-pie me-2"></i>
                        Hôm nay
                    </div>
                </router-link>
                <router-link to="/nextweek" class="text">
                    <div class="content" :class="{ active: selectedContent === 'nextWeek' }"
                        @click="selectContent('nextWeek')">
                        <i class="fa-solid fa-calendar-days me-2"></i>
                        Tuần tới
                    </div>
                </router-link>
                <router-link to="/alltask" class="text">
                    <div class="content" :class="{ active: selectedContent === 'allTasks' }"
                        @click="selectContent('allTasks')">
                        <i class="fa-brands fa-slack me-2"></i>
                        Tất cả công việc
                    </div>
                </router-link>
                <router-link to="/calendar" class="text">
                    <div class="content" :class="{ active: selectedContent === 'calendar' }"
                        @click="selectContent('calendar')">
                        <i class="fa-brands fa-slack me-2"></i>
                        Calendar
                    </div>
                </router-link>
                <div>
                    <div class="content d-flex align-items-center justify-content-between" @click="toggleSubItems">
                        <div class="title">
                            {{ listTitle }}
                        </div>
                        <i class="fa-solid fa-plus icon"></i>
                    </div>
                    <div class="subItems" ref="subItemsRef"
                        :style="{ height: isSubItemsVisible ? subItemsHeight : '0px', overflow: 'hidden', transition: 'height 0.3s ease' }">
                        <div class="item" v-for="(item, index) in subItems" :key="index">
                            <router-link :to="item.link" class="text">
                                <div class="content" :class="{ active: selectedContent === item.id }"
                                    @click="selectContent(item.id)">
                                    {{ item.text }}
                                </div>
                            </router-link>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="content d-flex align-items-center justify-content-between" @click="toggleTagSubItems">
                        <div class="title">
                            {{ tagTitle }}
                        </div>
                        <i class="fa-solid fa-plus icon"></i>

                    </div>
                    <div class="subItems" ref="tagSubItemsRef"
                        :style="{ height: isTagSubItemsVisible ? tagSubItemsHeight : '0px', overflow: 'hidden', transition: 'height 0.3s ease' }">
                        <div class="item" v-for="(item, index) in tagSubItems" :key="index">
                            <router-link :to="item.link" class="text">
                                <div class="content" :class="{ active: selectedContent === item.id }"
                                    @click="selectContent(item.id)">
                                    {{ item.text }}
                                </div>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <template #footer>
                <div class="p-2  footer">Footer</div>
            </template>
        </a-list>
    </div>
</template>



<script setup>
import { ref, nextTick } from 'vue';

const selectedContent = ref('');
const isSubItemsVisible = ref(false);
const subItemsHeight = ref('0px');
const subItemsRef = ref(null);
const isTagSubItemsVisible = ref(false);
const tagSubItemsHeight = ref('0px');
const tagSubItemsRef = ref(null);

const listTitle = ref('Danh sách của tôi');
const subItems = ref([
    { id: 'abc', text: 'Cá nhân', link: '/task/lists' },
    { id: 'b', text: 'Công việc', link: '/alltask' },
]);

const tagTitle = ref('Tag');
const tagSubItems = ref([
    { id: 'personal', text: 'Cá nhân', link: '/personal' },
]);

const selectContent = (content) => {
    selectedContent.value = content;
};

// Toggle cho "Danh sách của tôi"
const toggleSubItems = async () => {
    isSubItemsVisible.value = !isSubItemsVisible.value;
    if (isSubItemsVisible.value) {
        await nextTick();
        subItemsHeight.value = `${subItemsRef.value.scrollHeight}px`;
    } else {
        subItemsHeight.value = '0px';
    }
};

// Toggle cho "Tag"
const toggleTagSubItems = async () => {
    isTagSubItemsVisible.value = !isTagSubItemsVisible.value;
    if (isTagSubItemsVisible.value) {
        await nextTick();
        tagSubItemsHeight.value = `${tagSubItemsRef.value.scrollHeight}px`;
    } else {
        tagSubItemsHeight.value = '0px';
    }
};
</script>


<style scoped>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translate3d(0, 100%, 0);
    }

    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

.custom-list {
    background-color: rgba(0, 0, 0, 0.6);
    color: white;
    display: flex;
    flex-direction: column;
    height: 100%;

    overflow: hidden;

}

.custom-menu {
    background-color: transparent !important;
    display: flex;
    flex-direction: column;
    /* Màu nền đen */
}

.subItems {
    transition: height 0.3s ease;
}

.content {
    padding: .5rem 2rem;
    color: #b7b7b7;
    font-size: 1rem;
    cursor: pointer;
}

.content .text {
    color: #b7b7b7;
}

.content:hover {
    background-color: #424242;
}

.content.active .text,
.content.active {
    color: #0083ff;
}

.content .title {
    color: white;
    font-weight: bold;
    font-size: 1.1rem;
}



/*  */
.footer {
    flex-shrink: 0;
    background: #001427;
    padding: 1rem;
    text-align: center;

}


.default-icon {
    font-size: 1.25rem;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    border: 2px solid white;
    cursor: pointer;
}

.default-icon:hover {
    color: #0083ff;
    border: 2px solid #0083ff;
}
</style>
