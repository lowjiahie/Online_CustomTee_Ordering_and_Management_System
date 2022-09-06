import VueRouter from "vue-router";
import ExampleComponent from "./components/ExampleComponent"
import CustomTeeDesignToolComponent from "./customTeeDesignTool/CustomTeeDesignTool"
import ViewDesignWithPriceComponent from "./sharingSection/ViewDesignWithPrice"
import ViewDesignWithFreeComponent from "./sharingSection/ViewDesignWithFree"
import customerLoginComponent from "./customerMaintenance/customerLogin"
import customerRegisterComponent from "./customerMaintenance/customerRegister"
import customerPwdRecoveryComponent from "./customerMaintenance/customerPwdRecovery"

const routes = [
    {
        path: "/customer/home",
        component: ExampleComponent,
        name: 'home',
    },
    {
        path: "/customer/design-tool",
        component: CustomTeeDesignToolComponent,
        name: 'design-tool',
    },
    {
        path: "/customer/design-price",
        component: ViewDesignWithPriceComponent,
        name: 'design-price',
    },
    {
        path: "/customer/design-free",
        component: ViewDesignWithFreeComponent,
        name: 'design-free'
    },
    {
        path: "/customer/login",
        component: customerLoginComponent,
        name: 'login'
    },
    {
        path: "/customer/register",
        component: customerRegisterComponent,
        name: 'register'
    },
    {
        path: "/customer/pwdRecovery",
        component: customerPwdRecoveryComponent,
        name: 'pwdRecovery'
    },
]

const router = new VueRouter({
    routes,
    mode: 'history'
})

export default router;