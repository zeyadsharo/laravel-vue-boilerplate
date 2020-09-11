"use strict";

var _sweetalert = _interopRequireDefault(require("sweetalert2"));

var _moment = _interopRequireDefault(require("moment"));

var _vue = _interopRequireDefault(require("vue"));

require("vuetify/src/styles/main.sass");

var _vuetify = _interopRequireDefault(require("../plugins/vuetify"));

var _vueRouter = _interopRequireDefault(require("vue-router"));

var _index = _interopRequireDefault(require("../store/index"));

require("vuetify/dist/vuetify.min.css");

var _auth = _interopRequireDefault(require("./auth"));

var _login = _interopRequireDefault(require("./pages/login.vue"));

var _home = _interopRequireDefault(require("./pages/home.vue"));

var _router = _interopRequireDefault(require("../plugins/router"));

var _i18n = _interopRequireDefault(require("../plugins/i18n"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

window.Swal = _sweetalert["default"];

require("./bootstrap");

require("../sass/app.scss");

_vue["default"].use(_vuetify["default"]);

window.Vue = require("Vue");

_vue["default"].use(_vueRouter["default"]);

_vue["default"].prototype.$auth = new _auth["default"](window.user);

_vue["default"].component("example-component", require("./components/ExampleComponent.vue")["default"]);

_vue["default"].component("admin", require("./components/Admin.vue")["default"]);

_vue["default"].component("login", require("./pages/login.vue")["default"]);

_vue["default"].component("home", require("./pages/home.vue")["default"]);

_vue["default"].filter("upText", function (text) {
  return text.charAt(0).toUpperCase() + text.slice(1);
});

_vue["default"].filter("createDate", function (created) {
  return (0, _moment["default"])(created).startOf('hour').fromNow();
});

_vue["default"].filter("updateDate", function (update) {
  return (0, _moment["default"])(update).format("MMM Do YY");
});

_vue["default"].config.productionTip = false; // router.beforeEach((to, from, next) => {
//     // use the language from the routing param or default language
//     let language = to.params.lang;
//     if (!language) {
//         language = 'en'
//     }
//     // set the current language for i18n.
//     i18n.locale = language
//     next()
// })

var app = new _vue["default"]({
  el: "#app",
  vuetify: _vuetify["default"],
  store: _index["default"],
  router: _router["default"],
  i18n: _i18n["default"],
  components: {
    login: _login["default"],
    home: _home["default"]
  }
}).$mount("#app");