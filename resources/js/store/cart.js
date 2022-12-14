import { defineStore } from 'pinia';
import { useAuthStore } from "./auth";
import axios from 'axios';

export const useCartStore = defineStore("cart", {
    state: () => ({
        cusTeeCart: [],
        designCart: [],
        cartCount: 0,
        orderSummary: {
            totalAll: 0.0,
            shippingFee: 5.99,
            total: 0,
        },
    }),
    getters: {
        ctCart: (state) => state.cusTeeCart,
        dCart: (state) => state.designCart,
        count: (state) => state.designCart,
    },
    actions: {

        setCustomTeeCart(data) {
            let checkUpdate = false;
            if (this.cusTeeCart.length > 0) {
                for (let i = 0; i < this.cusTeeCart.length; i++) {
                    if (this.cusTeeCart[i].customtee.pt_type_color_id == data.customtee.pt_type_color_id &&
                        this.cusTeeCart[i].printingMethodID == data.printingMethodID &&
                        this.cusTeeCart[i].sizeID == data.sizeID &&
                        this.cusTeeCart[i].cusID == data.cusID) {
                        this.cusTeeCart[i].qty = data.qty;
                        swal(
                            "Success",
                            "Successfully update size qty to you cart!!",
                            "success"
                        ).then(() => { location.reload(); })
                        checkUpdate = true;
                    }
                }
            }
            if (!checkUpdate) {
                this.cusTeeCart.push(data);
                swal(
                    "Success",
                    "Successfully added this custom-tee to you cart!!",
                    "success"
                ).then(() => { location.reload(); })
            }

            this.setCartCount();
        },
        setCartCount() {
            const auth = useAuthStore();
            let countCustomTee = 0;
            let countDesign = 0;
            if (this.cusTeeCart.length > 0) {
                for (let i = 0; i < this.cusTeeCart.length; i++) {
                    if (this.cusTeeCart[i].cusID == auth.authCus.cus_id) {
                        countCustomTee += 1;
                    }
                }
            }
            if (this.designCart.length > 0) {
                for (let i = 0; i < this.designCart.length; i++) {
                    if (this.cusTeeCart[i].cusID == auth.authCus.cus_id) {
                        countDesign += 1;
                    }
                }
            }

            this.cartCount = countCustomTee + countDesign;
        },
        deleteItemFromCart(index) {
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to delete this item from cart?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then(() => {
                this.cusTeeCart.splice(index, 1);
                swal(
                    "Success",
                    "Successfully delete item from cart!!",
                    "success"
                )
            })
            this.setCartCount();
        },
        setOrderSummary(data) {
            this.orderSummary = data;
        },
        removeCusCart() {
            const auth = useAuthStore();
            var newArr = this.cusTeeCart.filter(item =>
                item.cusID !== auth.authCus.cus_id
            );
            this.cusTeeCart = newArr;
        }

    },
    persist: true,
},
)