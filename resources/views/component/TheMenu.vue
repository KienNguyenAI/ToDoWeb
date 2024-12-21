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
                                <SettingOutlined class="icon" />
                            </div>

                        </template>
                    </div>
                    <div class="">
                        <div class="username  fs-5 ps-3" style="font-weight: 500;">Kiên</div>

                    </div>
                </div>
            </template>
            <!-- Nội dung menu-container -->
            <a-menu v-model:openKeys="state.openKeys" v-model:selectedKeys="state.selectedKeys" mode="inline"
                :inline-collapsed="state.collapsed" class="custom-menu">
                <a-menu-item key="1" class="menu-item">
                    <div class="content">
                        <PieChartOutlined class="me-2" />
                        <router-link to="/myday" class="text">My Day</router-link>
                    </div>
                </a-menu-item>
                <a-menu-item key="2" class="menu-item">
                    <div class="content">
                        <DesktopOutlined class="me-2" />
                        <router-link to="/nextweek" class="text">Next 7 days</router-link>
                    </div>
                </a-menu-item>
                <a-menu-item key="3" class="menu-item">
                    <div class="content">
                        <InboxOutlined class="me-2" />
                        <router-link to="/alltask" class="text">All my tasks</router-link>
                    </div>
                </a-menu-item>
                <a-menu-item key="4" class="menu-item">
                    <div class="content">
                        <InboxOutlined class="me-2" />
                        <router-link to="/calendar" class="text">Calendar</router-link>
                    </div>
                </a-menu-item>

                <a-sub-menu key="5" :expand-icon="() => null" class="item">
                    <template #title>


                        <div class="submenu-title">
                            <h3>My lists</h3>
                            <PlusOutlined @click.stop="addSubItem('5')" class="icon" />
                        </div>
                    </template>
                    <router-link to="/task/lists" style="color: #b7b7b7;">
                        <a-menu-item v-for="(item, index) in state.myLists" :key="`5-${index}`" class="menu-item">
                            {{ item }}
                        </a-menu-item>
                    </router-link>

                </a-sub-menu>
                <a-sub-menu key="6" :expand-icon="() => null" class="item">
                    <template #title>
                        <div class="submenu-title">
                            <h3>Tags</h3>
                            <PlusOutlined @click.stop="addSubItem('6')" class="icon" />
                        </div>
                    </template>
                    <a-menu-item v-for="(item, index) in state.tags" :key="`6-${index}`">
                        {{ item }}
                    </a-menu-item>
                </a-sub-menu>
            </a-menu>
            <!-- Footer -->
            <template #footer>
                <div class="p-2  footer">Footer</div>
            </template>
        </a-list>
    </div>
</template>



<script setup>
import { reactive, watch, h } from 'vue';
import {
    PieChartOutlined,
    DesktopOutlined,
    InboxOutlined,
    PlusOutlined,
    SettingOutlined
} from '@ant-design/icons-vue';

const state = reactive({
    collapsed: false,
    selectedKeys: ['1'],
    openKeys: ['sub1'],
    preOpenKeys: ['sub1'],
    myLists: ['Work', 'Personal', 'Projects'],
    tags: ['Urgent', 'Important', 'Optional'],
    avatarSrc: '../../../public/storage/avatar/1732920513-default.webp',
    hasAvatar: true,
});

watch(
    () => state.openKeys,
    (_val, oldVal) => {
        state.preOpenKeys = oldVal;
    },
);


const addSubItem = (key) => {
    if (key === '5') {
        state.myLists.push(`New Item ${state.myLists.length + 1}`);
    } else if (key === '6') {
        state.tags.push(`New Tag ${state.tags.length + 1}`);
    }
};
const onImageError = () => {
    state.avatarSrc = null;
};
</script>

<style scoped>
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

/* menu item */
.menu-item {
    color: #b7b7b7;
    font-size: 1rem;
    transition: background-color 0.3s, color 0.3s;
}

.menu-item .content {
    display: flex;
    align-items: center;
    padding: 0.6rem 1rem;
    color: #b7b7b7;
}

.menu-item.ant-menu-item-selected {
    background-color: #0083ff !important;
    color: white !important;
}

.menu-item.ant-menu-item-selected .me-2,
.menu-item.ant-menu-item-selected .text {
    color: #0083ff !important;
}


.menu-item:hover {
    background-color: #424242;
    color: #ffffff;
}

.menu-item .text {
    color: #b7b7b7;
    text-decoration: none;
}

.menu-item .content:hover,
.menu-item .text:hover {
    color: #0083ff;
}

/*  */
.footer {
    flex-shrink: 0;
    background: #001427;
    padding: 1rem;
    text-align: center;

}

.submenu-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: white;
}


.submenu-title .icon {
    color: white;
    cursor: pointer;
}

.submenu-title .icon:hover {
    color: #0083ff;
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

/* .custom-menu .item {
    margin: 4px;
    padding-left: 24px;
    padding-right: 24px;
    font-size: 1rem;
    color: #b7b7b7;
}

.custom-menu .item .content {
    padding-top: .6rem;
    padding-bottom: .6rem;
}

.custom-menu .item .content .text {
    color: #b7b7b7
}

.custom-menu .item.selected .content .text {
    color: #0083ff !important;
}

.custom-menu .item:hover {
    background-color: #424242;
} */
</style>
