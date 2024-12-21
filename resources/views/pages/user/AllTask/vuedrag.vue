<template>
    <div class="row">
        <div class="col-8">
            <h3>Draggable with footer</h3>

            <draggable tag="transition-group" :componentData="componentData" :list="list" class="list-group"
                draggable=".item" :animation="100" @start="dragging = true" @end="dragging = false">
                <div class="list-group-item item" v-for="element in list" :key="element.name">
                    {{ element.name }}
                </div>

                <div slot="footer" class="btn-group list-group-item" role="group" aria-label="Basic example"
                    key="footer">
                    <button class="btn btn-secondary" @click="add">Add</button>
                    <button class="btn btn-secondary" @click="replace">Replace</button>
                </div>
            </draggable>
        </div>

    </div>
</template>
<script>
import { defineComponent } from 'vue'
import { VueDraggableNext } from 'vue-draggable-next'
export default defineComponent({
    components: {
        draggable: VueDraggableNext,
    },
    data() {
        return {
            list: [
                { name: "John", id: 0 },
                { name: "Joao", id: 1 },
                { name: "Jean", id: 2 }
            ],
            dragging: false,
            componentData: {
                props: {
                    type: "transition",
                    name: "flip-list"
                }
            }
        };
    },
    methods: {
        log(event) {
            console.log(event)
        },
    },
})
</script>

<style scoped>
.flip-list-move {
    transition: transform 0.5s;
}

.no-move {
    transition: transform 0s;
}
</style>