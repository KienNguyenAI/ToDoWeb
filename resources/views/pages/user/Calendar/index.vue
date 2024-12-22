<template>
    <div class="calendar">
        <a-config-provider :theme="{
            token: {
                colorPrimary: '#424242',          // Màu chính
                colorBgContainer: '#252525',     // Nền container
                colorText: '#ffffff',            // Màu chữ
                colorTextDisabled: '#8c8c8c',    // Màu chữ bị disable
                colorBorder: '#3a3a3a',          // Màu border
            },
        }">
            <a-calendar v-model:value="value">
                <template #dateCellRender="{ current }">
                    <ul class="events">
                        <li v-for="item in getListData(current)" :key="item.content">
                            <a-badge :status="item.type" :text="item.content" />
                        </li>
                    </ul>
                </template>
                <template #monthCellRender="{ current }">
                    <div v-if="getMonthData(current)" class="notes-month">
                        <section>{{ getMonthData(current) }}</section>
                        <span>Backlog number</span>
                    </div>
                </template>
            </a-calendar>
        </a-config-provider>
    </div>


</template>
<script setup>
import { ref } from 'vue';
const value = ref();
const getListData = value => {
    let listData;
    switch (value.date()) {
        case 8:
            listData = [
                {
                    type: 'warning',
                    content: 'This is warning event.',
                },
                {
                    type: 'success',
                    content: 'This is usual event.',
                },
            ];
            break;
        case 10:
            listData = [
                {
                    type: 'warning',
                    content: 'This is warning event.',
                },
                {
                    type: 'success',
                    content: 'This is usual event.',
                },
                {
                    type: 'error',
                    content: 'This is error event.',
                },
            ];
            break;
        case 15:
            listData = [
                {
                    type: 'warning',
                    content: 'This is warning event',
                },
                {
                    type: 'success',
                    content: 'This is very long usual event。。....',
                },
                {
                    type: 'error',
                    content: 'This is error event 1.',
                },
                {
                    type: 'error',
                    content: 'This is error event 2.',
                },
                {
                    type: 'error',
                    content: 'This is error event 3.',
                },
                {
                    type: 'error',
                    content: 'This is error event 4.',
                },
            ];
            break;
        default:
    }
    return listData || [];
};
const getMonthData = value => {
    if (value.month() === 8) {
        return 1394;
    }
};
</script>
<style scoped>
.calendar {
    margin-top: 2rem;
}

.events {
    list-style: none;
    margin: 0;
    padding: 0;
}

.events .ant-badge-status {
    overflow: hidden;
    white-space: nowrap;
    width: 100%;
    text-overflow: ellipsis;
    font-size: 12px;
}

.notes-month {
    text-align: center;
    font-size: 28px;
}

.notes-month section {
    font-size: 28px;
}

.a-calendar {
    background-color: #1f1f1f;
    color: #d9d9d9;
}

.a-calendar-header {
    background-color: #141414;
    color: #d9d9d9;
}

.a-calendar-cell {
    background-color: #1f1f1f;
    color: #d9d9d9;
}

.a-calendar-cell:hover {
    background-color: #3a3a3a;
}

.a-calendar-today {
    background-color: #262626 !important;
    color: #1890ff !important;
}

.a-calendar-selected-day {
    background-color: #1890ff !important;
    color: #fff !important;
}

.a-calendar-content {
    background-color: #1f1f1f;
    color: #d9d9d9;
}

.ant-picker-calendar-year-select {
    background-color: white !important;
}
</style>