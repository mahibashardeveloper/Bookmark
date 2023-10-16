import {createRouter, createWebHistory} from "vue-router";

import layout from "../components/layout/layout.vue";
import home from "../components/children/home.vue";

const ROOT_URL = "/front";

const routes = [
    {path: ROOT_URL, name: 'layout', component: layout,
        children: [
            {path: ROOT_URL + '', name: 'home', component: home, meta: {title: 'home'}},
            {path: ROOT_URL + '/about', name: 'about', component: home, meta: {title: 'about'}},
            {path: ROOT_URL + '/contact', name: 'contact', component: home, meta: {title: 'contact'}},
            {path: ROOT_URL + '/blog', name: 'blog', component: home, meta: {title: 'blog'}},
        ],
    },
];

const router = createRouter({
    history: createWebHistory(), routes
})

export default router;
