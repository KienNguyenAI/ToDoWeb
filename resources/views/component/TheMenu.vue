<template>
    <div class="d-flex flex-column vh-100 m-0 p-0">
        <a-list size="large" bordered class="menu custom-list d-flex flex-column">
            <template #header>
                <div class="p-2 border-bottom">Header</div>
            </template>
            <!-- Nội dung menu-container -->
            <div class="menu-container flex-grow-1 overflow-auto">
                <a-menu v-model:openKeys="state.openKeys" v-model:selectedKeys="state.selectedKeys" mode="inline"
                    theme="dark" :inline-collapsed="state.collapsed">
                    <a-menu-item key="1">
                        <template #icon>
                            <PieChartOutlined />
                        </template>
                        Today
                    </a-menu-item>
                    <a-menu-item key="2">
                        <template #icon>
                            <DesktopOutlined />
                        </template>
                        Next 7 days
                    </a-menu-item>
                    <a-menu-item key="3">
                        <template #icon>
                            <InboxOutlined />
                        </template>
                        All my tasks
                    </a-menu-item>
                    <a-menu-item key="4">
                        <template #icon>
                            <InboxOutlined />
                        </template>
                        Calendar
                    </a-menu-item>
                    <a-sub-menu key="5" :expand-icon="() => null">
                        <template #title>
                            <div class="submenu-title">
                                <h3>My lists</h3>
                                <PlusOutlined @click.stop="addSubItem('5')" class="icon" />
                            </div>
                        </template>
                        <a-menu-item v-for="(item, index) in state.myLists" :key="`5-${index}`">
                            {{ item }}
                        </a-menu-item>
                    </a-sub-menu>
                    <a-sub-menu key="6" :expand-icon="() => null">
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
            </div>
            <!-- Footer -->
            <template #footer>
                <div class="p-2 border-top footer">Footer</div>
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
    PlusOutlined
} from '@ant-design/icons-vue';

const state = reactive({
    collapsed: false,
    selectedKeys: ['1'],
    openKeys: ['sub1'],
    preOpenKeys: ['sub1'],
    myLists: ['Work', 'Personal', 'Projects'],
    tags: ['Urgent', 'Important', 'Optional'],
});

watch(
    () => state.openKeys,
    (_val, oldVal) => {
        state.preOpenKeys = oldVal;
    },
);

const toggleCollapsed = () => {
    state.collapsed = !state.collapsed;
    state.openKeys = state.collapsed ? [] : state.preOpenKeys;
};

const addSubItem = (key) => {
    if (key === '5') {
        state.myLists.push(`New Item ${state.myLists.length + 1}`);
    } else if (key === '6') {
        state.tags.push(`New Tag ${state.tags.length + 1}`);
    }
};

</script>

<style scoped>
.custom-list {
    background-color: #001427;
    color: white;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.menu-container {
    flex-grow: 1;
    overflow-y: auto;
}

.footer {
    /* Đảm bảo footer cố định ở cuối list */
    flex-shrink: 0;
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
</style>
