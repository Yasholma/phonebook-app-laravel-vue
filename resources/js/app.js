/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
import "bulma";
import VueRouter from "vue-router";
import Header from "./components/Header";
import Footer from "./components/Footer";
import Home from "./components/Home";
import About from "./components/About";
import AddModal from "./components/AddModal";
import ViewModal from "./components/ViewModal";
import EditModal from "./components/EditModal";
import Login from "./components/Login";
import Register from "./components/Register";

window.Vue = require("vue");

Vue.use(VueRouter);

Vue.component("pb-header", Header);
Vue.component("pb-footer", Footer);
Vue.component("pb-home", Home);
Vue.component("pb-about", About);
Vue.component("pb-add-modal", AddModal);
Vue.component("pb-view-modal", ViewModal);
Vue.component("pb-edit-modal", EditModal);
Vue.component("pb-login", Login);
Vue.component("pb-register", Register);

const routes = [
    { path: "/", component: Login },
    { path: "/phonebook", component: Home },
    { path: "/about", component: About },
    { path: "/register", component: Register }
];

const router = new VueRouter({
    routes,
    mode: "history"
});

const app = new Vue({
    el: "#app",
    router,
    data: {
        isAuthenticated: false,
        user: {}
    },
    components: { Home, About, Login, Register }
});
