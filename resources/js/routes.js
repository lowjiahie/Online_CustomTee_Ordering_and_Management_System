import VueRouter from "vue-router";
import ExampleComponent from "./components/ExampleComponent"
import CustomTeeDesignToolComponent2 from "./components/customTeeDesignTool/CustomTeeDesignTool2"
import CustomTeeDesignToolComponent from "./components/customTeeDesignTool/CustomTeeDesignTool"
import ViewDesignWithPriceComponent from "./components/sharingSection/ViewDesignWithPrice"
import ViewDesignWithFreeComponent from "./components/sharingSection/ViewDesignWithFree"
import customerLoginComponent from "./components/customerMaintenance/customerLogin"
import customerRegisterComponent from "./components/customerMaintenance/customerRegister"
import customerPwdRecoveryComponent from "./components/customerMaintenance/customerPwdRecovery"

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
        path: "/customer/design-tool2",
        component: CustomTeeDesignToolComponent2,
        name: 'design-tool2',
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