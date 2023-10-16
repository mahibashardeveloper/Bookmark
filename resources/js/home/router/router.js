import {createRouter, createWebHistory} from "vue-router";

import layout from "../components/layout/layout.vue";
import home from "../components/children/home.vue";
import about from "../components/children/about.vue";
import contact from "../components/children/contact.vue";
import blog from "../components/children/blog.vue";

const ROOT_URL = "/front";

const routes = [
    {path: ROOT_URL, name: 'layout', component: layout,
        children: [
            {path: ROOT_URL + '/home', name: 'home', component: home, meta: {title: 'home'}},
            {path: ROOT_URL + '/about', name: 'about', component: about, meta: {title: 'about'}},
            {path: ROOT_URL + '/contact', name: 'contact', component: contact, meta: {title: 'contact'}},
            {path: ROOT_URL + '/blog', name: 'blog', component: blog, meta: {title: 'blog'}},
        ],
    },
];

const router = createRouter({
    history: createWebHistory(), routes
})

export default router;
