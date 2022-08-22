import VueRouter from "vue-router";
import ExampleComponent from "./components/ExampleComponent"

const routes = [
    {
        path:"/customer/home",
        component: ExampleComponent,
        name: 'home',
    },
]

const router = new VueRouter({
    routes,
    mode:'history'
})

export default router;