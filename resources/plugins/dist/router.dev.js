"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _vue = _interopRequireDefault(require("vue"));

var _vueRouter = _interopRequireDefault(require("vue-router"));

var _Dashboard = _interopRequireDefault(require("../js/pages/Dashboard"));

var _Settings = _interopRequireDefault(require("../js/pages/Settings"));

var _Users = _interopRequireDefault(require("../js/pages/Users"));

var _Roles = _interopRequireDefault(require("../js/pages/Roles"));

var _Permissions = _interopRequireDefault(require("../js/pages/Permissions"));

var _Activities = _interopRequireDefault(require("../js/pages/Activities"));

var _requests = _interopRequireDefault(require("../js/workflow/requests"));

var _history = _interopRequireDefault(require("../js/workflow/history"));

var _inprogress = _interopRequireDefault(require("../js/workflow/inprogress"));

var _i18n = _interopRequireDefault(require("./i18n.js"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

_vue["default"].use(_vueRouter["default"]);

var routes = [{
  path: '/',
  redirect: "/".concat(_i18n["default"].locale, "/")
}, {
  path: '/:lang',
  component: {
    template: "<router-view></router-view>"
  },
  beforeEnter: function beforeEnter(to, from, next) {
    // use the language from the routing param or default language
    var language = to.params.lang;

    if (!language) {
      language = 'en';
    } // set the current language for i18n.


    _i18n["default"].locale = language;
    next();
  },
  children: [{
    path: "requests",
    component: _requests["default"],
    name: "Request"
  }, {
    path: "history",
    component: _history["default"],
    name: "History"
  }, {
    path: "/home/inprogress",
    component: _inprogress["default"]
  }, {
    path: "/admin/",
    component: _Dashboard["default"]
  }, {
    path: "/admin/users",
    component: _Users["default"]
  }, {
    path: "/admin/roles",
    component: _Roles["default"]
  }, {
    path: "/admin/permissions",
    component: _Permissions["default"]
  }, {
    path: "/admin/settings",
    component: _Settings["default"]
  }, {
    path: "/admin/activities",
    component: _Activities["default"]
  }, {
    // <---------------
    path: '*',
    redirect: function redirect() {
      return process.env.VUE_APP_I18N_LOCALE;
    }
  }]
}];
var router = new _vueRouter["default"]({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: routes
});
var _default = router;
exports["default"] = _default;