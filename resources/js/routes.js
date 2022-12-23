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
import CustomerProfileNavComponent from "./components/customerMaintenance/CustomerProfileNav"
import CustomerEditProfileComponent from "./components/customerMaintenance/CustomerEditProfile"
import CustomerEditPaypalAccComponent from "./components/customerMaintenance/CustomerEditPaypalAcc"
import CustomerChangePasswordComponent from "./components/customerMaintenance/CustomerChangePassword"
import CustomerPwdRecoveryFormComponent from "./components/customerMaintenance/CustomerPwdRecoveryForm"
import CartComponent from "./components/order/Cart"
import OrderConfirmationComponent from "./components/order/OrderConfirmation"
import ViewOrderComponent from "./components/order/ViewOrder"
import ViewOrderDetailsComponent from "./components/order/ViewOrderDetails"
import CompetitionListComponent from "./components/competition/competitionList"

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
    {
        path: "/customer/profileNav",
        component: CustomerProfileNavComponent,
        name: 'profileNav'
    },
    {
        path: "/customer/editProfile",
        component: CustomerEditProfileComponent,
        name: 'editProfile'
    },
    {
        path: "/customer/editPaypalProfile",
        component: CustomerEditPaypalAccComponent,
        name: 'editPaypalProfile'
    },
    {
        path: "/customer/changePassword",
        component: CustomerChangePasswordComponent,
        name: 'changePassword'
    },
    {
        path: "/customer/pwdRecoveryForm/:token",
        component: CustomerPwdRecoveryFormComponent,
        name: 'pwdRecoveryForm'
    },
    {
        path: "/customer/viewCart",
        component: CartComponent,
        name: 'viewCart',
    },
    {
        path:"/customer/orderConfirmation",
        component: OrderConfirmationComponent,
        name:'orderConfirmation',
        meta:{
            hideNavbar:true,
        }
    },
    {
        path:"/customer/viewOrder",
        component: ViewOrderComponent,
        name:'viewOrder',
    },
    {
        path:"/customer/viewOrderDetails/:id",
        component: ViewOrderDetailsComponent,
        name:'viewOrderDetails',
    },
    {
        path: "/customer/viewCompetitionList",
        component: CompetitionListComponent,
        name: 'viewCompetitionList'
    },

]

const router = new VueRouter({
    routes,
    mode: 'history'
})

export default router;
