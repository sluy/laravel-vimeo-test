import Vue from "vue";
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import App from "./layouts/App";
import routes from "./routes";
//Global plugins (lodash, axios, echo, pusher, etc)
require("./plugins/index");
import VueRouter from "vue-router";
// Install BootstrapVue
Vue.use(BootstrapVue);
// Install the BootstrapVue Icon components plugin
Vue.use(IconsPlugin);
// Install Vue Router
Vue.use(VueRouter);
// Configuring Routes
const router = new VueRouter({
    mode: "history",
    routes
});
// Configuring Vue
const app = new Vue({
    el: "#app",
    components: { App },
    router
});
