import { createRouter, createWebHistory } from "vue-router";
import publicRoutes from "./public.js";

const routes = [
    ...publicRoutes,
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});


export default router;