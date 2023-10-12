import {createRouter, createWebHistory} from "vue-router";

import layout from "../components/layout/layout.vue";
import home from "../components/children/home.vue";

const ROOT_URL = "/home";

const routes = [
    {path: ROOT_URL, name: 'layout', component: layout,
        children: [
            {path: ROOT_URL + '', name: 'home', component: home, meta: {title: 'home'}},
        ],
    },
];

const router = createRouter({
    history: createWebHistory(), routes
})

export default router;
