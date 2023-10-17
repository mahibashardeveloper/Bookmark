import {createRouter, createWebHistory} from "vue-router";

import Layout from "../layout/layout.vue";
import Portal from "../layout/portal.vue";
import Home from "../pages/home.vue";
import Login from "../pages/login.vue";
import Registration from "../pages/registration.vue";
import Forget from "../pages/forget.vue";

import Dashboard from "../pages/dashboard.vue";
import Bookmark from "../pages/bookmark.vue";

const ROOT_URL = "/";
const PORTAL_URL = "/portal/";

const routes = [
    {path: ROOT_URL, name: 'layout', component: Layout,
        children: [
            {path: ROOT_URL + '', name: 'home', component: Home, meta: {title: 'home'}},
            {path: ROOT_URL + 'login', name: 'login', component: Login, meta: {title: 'login'}},
            {path: ROOT_URL + 'register', name: 'register', component: Registration, meta: {title: 'register'}},
            {path: ROOT_URL + 'forget', name: 'forget', component: Forget, meta: {title: 'forget'}},
        ],
    },
    {path: PORTAL_URL, name: 'portal', component: Portal,
        children: [
            {path: PORTAL_URL + "dashboard", name: "dashboard", component: Dashboard, meta: { title: "dashboard" }},
            {path: PORTAL_URL + "bookmark", name: "bookmark", component: Bookmark, meta: { title: "bookmark" }},
        ],
    },
];

const router = createRouter({
    history: createWebHistory(), routes
})

export default router;
