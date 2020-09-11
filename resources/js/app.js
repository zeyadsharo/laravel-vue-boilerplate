import Swal from "sweetalert2";
window.Swal = Swal;
import moment from "moment";
require("./bootstrap");
require("../sass/app.scss");
import Vue from "vue";
Vue.use(Vuetify);
window.Vue = require("Vue");
import 'vuetify/src/styles/main.sass'
import Vuetify from '../plugins/vuetify'
import VueRouter from "vue-router";
import Store from '../store/index'
Vue.use(VueRouter);
import "vuetify/dist/vuetify.min.css";
import Auth from "./auth";
Vue.prototype.$auth = new Auth(window.user);
Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
Vue.component("admin", require("./components/Admin.vue").default);
Vue.component("login", require("./pages/login.vue").default);
Vue.component("home", require("./pages/home.vue").default);

Vue.filter("upText", function (text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter("createDate", function (created) {
    return moment(created).startOf('hour').fromNow();
});

Vue.filter("updateDate", function (update) {
    return moment(update).format("MMM Do YY");
});



import login from "./pages/login.vue";
import home from "./pages/home.vue";
import router from "../plugins/router"

import i18n from '../plugins/i18n'
Vue.config.productionTip = false
// router.beforeEach((to, from, next) => {

//     // use the language from the routing param or default language
//     let language = to.params.lang;
//     if (!language) {
//         language = 'en'
//     }

//     // set the current language for i18n.
//     i18n.locale = language
//     next()
// })


const app = new Vue({
    el: "#app",
    vuetify: Vuetify,
    store: Store,
    router,
    i18n,
    components: {
        login,
        home
    },
}).$mount("#app");
