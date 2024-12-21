<template>
    <div class="taskLayout">
        <Task @close="$emit('close')" />
    </div>
</template>

<script setup>
import Task from './Task.vue';
</script>

<style>
.taskLayout {
    background-color: rgba(0, 0, 0, 0.5);
    position: fixed;
    border-radius: 0.5rem;
    transition: box-shadow 0.3s ease;
    top: 0;
    left: 0;
    z-index: 1000;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
