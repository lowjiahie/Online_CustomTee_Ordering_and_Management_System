import VueRouter from "vue-router";
import HomeComponent from "./components/Home/Home"
import CustomTeeDesignToolComponent from "./components/customTeeDesignTool/CustomTeeDesignTool"
import ViewDesignWithPriceComponent from "./components/sharingSection/ViewDesignWithPrice"
import ViewDesignWithFreeComponent from "./components/sharingSection/ViewDesignWithFree"
import CustomerLoginComponent from "./components/customerMaintenance/CustomerLogin"
import CustomerRegisterComponent from "./components/customerMaintenance/CustomerRegister"
import CustomerPwdRecoveryComponent from "./components/customerMaintenance/CustomerPwdRecovery"
import ViewMyDesignComponent from "./components/myDesign/ViewMyDesign"
import PlainTeeSelectionComponent from "./components/plainTee/PlainTeeSelection"
import OrderPresetCustomTeeComponent from "./components/order/OrderPresetCustomTee"

const routes = [
    {
        path: "/customer/",
        component: HomeComponent,
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
        component: CustomerLoginComponent,
        name: 'login'
    },
    {
        path: "/customer/register",
        component: CustomerRegisterComponent,
        name: 'register'
    },
    {
        path: "/customer/pwdRecovery",
        component: CustomerPwdRecoveryComponent,
        name: 'pwdRecovery'
    },
    {
        path: "/customer/myDesign",
        component: ViewMyDesignComponent,
        name: 'myDesign'
    },
    {
        path: "/customer/viewPlainTee",
        component: PlainTeeSelectionComponent,
        name: 'viewPlainTee'
    },
    {
        path: "/customer/order/:id",
        component: OrderPresetCustomTeeComponent,
        name: 'order'
    },

]

const router = new VueRouter({
    routes,
    mode: 'history'
})

export default router;