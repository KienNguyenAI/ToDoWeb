<template>
    <div class="today">
        <div class="today-content">
            <div class="today-title mb-5 text-white">
                Chào, Kiên
            </div>
            <div class="todayRoute mb-5">
                <div class="todayRoute_content d-flex p-3 pt-2 pb-2">
                    <div class="todayRoute_calendar d-flex flex-column align-items-center" style="color: #e4e4e4;">
                        <div class="todayRoute_calendarWeekDay fw-bold">{{ weekday }}</div>
                        <div class="todayRoute_calendarDay fs-1 fw-bold">{{ day }}</div>
                        <div class="todayRoute_calendarWeekDayMonth">{{ month }}</div>
                    </div>

                    <div class="todayRoute_event ms-3 p-2 w-100 d-flex align-items-center">
                        <!-- <div class="todayRoute_empty text-secondary fs-6 ">
                            Bạn không sự kiện nào được lên lịch cho hôm nay
                        </div> -->
                        <div class="d-flex flex-column">
                            <ul class="todayRoute_list text-white d-flex align-items-center m-0 p-0">
                                <span class="todayRoute_list_indicator  me-3"
                                    style="color: rgb(159, 198, 231);">•</span>
                                <button class="buttonInlineText  me-3">10:30PM - 11:00PM</button>
                                <span class="d-flex">
                                    <button class="buttonInlineText">abc</button>
                                </span>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <addtask />

        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import addtask from "./addtask.vue";


const weekday = ref("");
const day = ref("");
const month = ref("");

const adjustHeight = (event) => {
    const textarea = event.target;
    console.log("Scroll height:", textarea.scrollHeight);
    textarea.style.height = "44";
    textarea.style.height = `${textarea.scrollHeight}px`;
};


onMounted(() => {
    const daysOfWeek = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
    const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];

    const now = new Date();
    weekday.value = daysOfWeek[now.getDay()];
    day.value = now.getDate();
    month.value = months[now.getMonth()];
});
</script>


<style>
.today {
    padding: 0;
    margin: 0;
    height: auto;
    justify-content: space-between;
}

.today-content {
    margin-left: 24rem;
    margin-right: 24rem;
    margin-top: 2rem;
}

.today-title {
    font-size: 1.8rem;
    color: #4a4a4a;
    font-weight: 600;
}

.todayRoute {
    background-color: rgb(0, 0, 0, 0.5);
    border-radius: 0.5rem;
}

.buttonInlineText {
    background: none;
    border: 0;
    cursor: pointer;
    font-size: .9rem;
}

.buttonInlineText:hover {
    color: #0083ff;
}
</style>