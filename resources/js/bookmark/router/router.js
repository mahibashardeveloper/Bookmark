import {createRouter, createWebHistory} from "vue-router";

import login from "../components/auth/login.vue";
import register from "../components/auth/register.vue";
import forget from "../components/auth/forget.vue";

import layout from "../components/layout/layout.vue";
import dashboard from "../components/children/dashboard.vue";
import bookmark from "../components/children/bookmark.vue";
import profile from "../components/children/profile.vue";

const ROOT_URL = "/user";

const routes = [
    {path: ROOT_URL + '/auth/login', name: 'login', component: login, meta: {title: 'login'}},
    {path: ROOT_URL + '/auth/register', name: 'register', component: register, meta: {title: 'register'}},
    {path: ROOT_URL + '/auth/forget', name: 'forget', component: forget, meta: {title: 'forget'}},
    {path: ROOT_URL, name: 'layout', component: layout,
        children: [
            {path: ROOT_URL + '/dashboard', name: 'dashboard', component: dashboard, meta: {title: 'dashboard'}},
            {path: ROOT_URL + '/bookmark', name: 'bookmark', component: bookmark, meta: {title: 'bookmark'}},
            {path: ROOT_URL + '/profile', name: 'profile', component: profile, meta: {title: 'profile'}},
        ],
    },
];

const router = createRouter({
    history: createWebHistory(), routes
})

export default router;
