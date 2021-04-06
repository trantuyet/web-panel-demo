import Vue from 'vue'
import Router from 'vue-router'
import EditUserComponent from "../components/EditUserComponent";
import LoginComponent from "../components/LoginComponent";
import HomeComponent from "../components/HomeComponent";
import RegisterComponent from "../components/RegisterComponent";

Vue.use(Router)

export default new Router({
    mode: "history",
    routes: [
        {
            path: '/',
            alias: '/',
            name: 'Home',
            component: HomeComponent
        },
        {
            path: '/create',
            name: 'CreateUser',
            component: RegisterComponent
        },
        {
            path: '/login',
            name: 'LoginUser',
            component: LoginComponent
        },
        {
            path: '/:id/update',
            name: 'Update',
            component: EditUserComponent
        }
    ]
})
