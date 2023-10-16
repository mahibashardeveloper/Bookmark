import {createRouter, createWebHistory} from "vue-router";

import layout from "../components/layout/layout.vue";
import home from "../components/children/home.vue";
import membership from "../components/children/membership.vue";

const ROOT_URL = "/front";

const routes = [
    {path: ROOT_URL, name: 'layout', component: layout,
        children: [
            {path: ROOT_URL + '/home', name: 'home', component: home, meta: {title: 'home'}},
            {path: ROOT_URL + '/membership', name: 'membership', component: membership, meta: {title: 'membership'}},
        ],
    },
];

const router = createRouter({
    history: createWebHistory(), routes
})

export default router;
