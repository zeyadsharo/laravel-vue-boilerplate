import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);


import Dashboard from "../js/pages/Dashboard";
import Settings from "../js/pages/Settings";
import Users from "../js/pages/Users";
import Roles from "../js/pages/Roles";
import Permissions from "../js/pages/Permissions";
import Activities from "../js/pages/Activities";

import Request from "../js/workflow/requests";
import History from "../js/workflow/history";
import Inprogress from "../js/workflow/inprogress";
import i18n from './i18n.js'

const routes = [

     {
         path: '/',
         redirect: `/${i18n.locale}/`
     },
    {
        path: '/:lang',
        component: {
            template: "<router-view></router-view>"
        },
        beforeEnter: (to, from, next) => {

                    // use the language from the routing param or default language
                    let language = to.params.lang;
                    if (!language) {
                        language = 'en'
                    }

                    // set the current language for i18n.
                    i18n.locale = language
                    next()
                },
        children: [{
                path: "requests",
            component: Request,
                name:"Request"
            },
            {
                path: "history",
                component: History,
                 name: "History"
            },
            {
                path: "/home/inprogress",
                component: Inprogress
            },

            {
                path: "/admin/",
                component: Dashboard
            },
            {
                path: "/admin/users",
                component: Users
            },
            {
                path: "/admin/roles",
                component: Roles
            },
            {
                path: "/admin/permissions",
                component: Permissions
            },
            {
                path: "/admin/settings",
                component: Settings
            },
            {
                path: "/admin/activities",
                component: Activities
            },
            { // <---------------
                path: '*',
                redirect() {
                    return process.env.VUE_APP_I18N_LOCALE;
                }
            }
        ]
    }
];

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
});

export default router;
