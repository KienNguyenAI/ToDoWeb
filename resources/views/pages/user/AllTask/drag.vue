<template>
    <div class="sortable-container">
        <ul class="sortable-list">
            <li v-for="(item, index) in items" :key="item.id" class="item" draggable="true"
                @dragstart="onDragStart($event, index)" @dragover.prevent="onDragOver($event, index)"
                @drop="onDrop($event, index)" :class="{ dragging: draggingIndex === index }">
                <div class="details">
                    <img :src="item.image" alt="" />
                    <span>{{ item.name }}</span>
                </div>

            </li>
        </ul>
    </div>
</template>

<script>
import { ref } from 'vue';

export default {
    name: 'sortBytime',
    setup() {
        const items = ref([
            { id: 1, name: 'Kristina Zasiadko' },
            { id: 2, name: 'Gabriel Wilson' },
            { id: 3, name: 'Ronelle Cesicon' },
            { id: 4, name: 'James Khosravi' },
            { id: 5, name: 'Annika Hayden' },
            { id: 6, name: 'Donald Horton' },
        ]);

        const draggingIndex = ref(null);

        const onDragStart = (event, index) => {
            draggingIndex.value = index;
            event.dataTransfer.effectAllowed = 'move';
        };

        const onDragOver = (event, index) => {
            if (draggingIndex.value === null || draggingIndex.value === index) return;
            const draggedItem = items.value[draggingIndex.value];
            items.value.splice(draggingIndex.value, 1);
            items.value.splice(index, 0, draggedItem);
            draggingIndex.value = index;
        };

        const onDrop = () => {
            draggingIndex.value = null;
        };

        return {
            items,
            draggingIndex,
            onDragStart,
            onDragOver,
            onDrop,
        };
    },
};
</script>

<style scoped>
.sortable-container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background: #595db8;
}

.sortable-list {
    width: 425px;
    padding: 30px 25px 20px;
    background: #fff;
    border-radius: 7px;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.item {
    list-style: none;
    display: flex;
    cursor: move;
    background: #fff;
    align-items: center;
    border-radius: 5px;
    padding: 10px 13px;
    margin-bottom: 11px;
    border: 1px solid #ccc;
    justify-content: space-between;
    transition: opacity 0.2s;
}

.item.dragging {
    opacity: 0.6;
}

.details {
    display: flex;
    align-items: center;
}

.details img {
    height: 43px;
    width: 43px;
    pointer-events: none;
    margin-right: 12px;
    object-fit: cover;
    border-radius: 50%;
}

.details span {
    font-size: 1.13rem;
}

.item i {
    color: #474747;
    font-size: 1.13rem;
}
</style>