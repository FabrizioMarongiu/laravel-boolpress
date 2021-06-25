//DIPENDENZE
import Vue from 'vue';
import VueRouter from 'vue-router';

// COMPONENTI PER LE PAGINE
import Home from './pages/Home.vue';
import About from './pages/About.vue';
import Blog from './pages/Blog.vue';
import NotFound from './pages/NotFound.vue';


// REGISTRAZIONE ROUTE CON VUE
Vue.use(VueRouter);

// DEFINIZIONE ROTTE APP
const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/about',
            name: 'about',
            component: About
        },
        {
            path: '/blog',
            name: 'blog',
            component: Blog
        },
        {
            path: '*',
            component: NotFound
        },
    ]
});

export default router;