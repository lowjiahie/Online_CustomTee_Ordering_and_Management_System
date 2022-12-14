<template>
  <div>
    <div class="container title-con1 mt-4">
      <h1>
        <u>Order Confirmation</u>
      </h1>
      <hr />
      <div class="row">
        <div class="col-12 col-md-6 col-sm-12">
          <span class="h4">DELIVERY DETAILS</span>
          <br />
          <hr />
          <div class="row">
            <div class="col-6">
              <p class="font-light">Name</p>
            </div>
            <div class="col-6">
              <p class="font-light-x0 text-right">{{authCus.name}}</p>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <p class="font-light">Address</p>
            </div>
            <div class="col-6">
              <p class="font-light-x0 text-right">
                <textarea
                  class="form-control"
                  rows="4"
                  cols="50"
                  v-model="address"
                  placeholder="--enter your address here--"
                ></textarea>
                <span
                  class="text-danger"
                  v-if="errors['cartData.address']"
                >{{ errors['cartData.address'][0] }}</span>
              </p>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="checkbox"
                  @click="fillInAddress"
                  id="flexCheckDefault"
                />
                <label class="form-check-label" for="flexCheckDefault">Auto fill-in address</label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-sm-12">
          <span class="h4">ORDER DETAILS</span>
          <br />
          <hr />
          <div class="row">
            <div class="col-6">
              <p class="font-light">Order Date</p>
            </div>
            <div class="col-6">
              <p class="font-light-x0 text-right">{{timestamp}}</p>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <p class="font-light">Payment Method</p>
            </div>
            <div class="col-6">
              <p class="font-light-x0 text-right">Paypal</p>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <p class="font-light">Delivery Method</p>
            </div>
            <div class="col-6">
              <p class="font-light-x0 text-right">
                <select
                  class="form-select"
                  v-model="deliveryMethod"
                  aria-label="Default select example"
                >
                  <option value="POSLAJU">POSLAJU</option>
                  <option value="J&T">J&T</option>
                  <option value="DHL">DHL</option>
                </select>
                <span
                  class="text-danger"
                  v-if="errors['cartData.deliveryMethod']"
                >{{ errors['cartData.deliveryMethod'][0] }}</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--End Row2 Delivery details & Order ID-->

    <!--Start Order Product-->
    <div class="container title-con1 font-style-dinotmt-4 mt-4 mb-4">
      <div class="row">
        <div class="col-12 col-md-12 col-sm-12">
          <span class="h4">ORDER ITEMS</span>
          <br />
          <hr />
          <!--Start Product List-->
          <div v-for="(item, index) in cusTeeCart" :key="index">
            <div v-if="item.cusID == authCus.cus_id" class="container shadow bg-white p-3" v->
              <div class="row">
                <div class="col-md-1">
                  <p class="font-light font-weight-bold text-center" style="padding-top:50px;">#</p>
                </div>
                <div class="col-md-4 product-img">
                  <div class="row">
                    <div class="col-md-6 pe-0">
                      <img
                        class="img-thumbnail border-0 pe-0"
                        :src="require('@assets/customTee/'+item.customtee.back_design_img)"
                      />
                    </div>
                    <div class="col-md-6 ps-0">
                      <img
                        class="img-thumbnail border-0 ps-0"
                        :src="require('@assets/customTee/'+item.customtee.back_design_img)"
                      />
                    </div>
                  </div>
                </div>
                <div class="col-md-7 mt-3">
                  <div class="row">
                    <div class="col-md-12">
                      <p
                        class="h4"
                      >{{item.customtee.name}} (Size->{{item.sizeName}} | {{ item.printingMethodName}})</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-6">
                      <p
                        class="font-light-x2 mb-2"
                      >Product: {{item.customtee.type_name}} {{item.customtee.material}} | {{item.customtee.detail}} | {{item.customtee.color_name}}</p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                      <p class="font-light-x2 mb-2">Size: {{item.sizeName}}</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-6">
                      <p class="font-light mb-2">{{ item.customtee.price | currency('RM') }}</p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                      <p class="font-light mb-2">QTY: {{item.qty}}</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-6">
                      <p class="font-light mb-2">{{ item.printingMethodName }}</p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                      <p class="font-light mb-2">{{ item.printingPrice | currency('RM') }}</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <p
                        class="font-light mb-0 text-right pe-4"
                        style="font-size:18px !important;"
                      >Subtotal: {{ item.subtotal | currency('RM') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Start Product List-->
        </div>
        <!--Start Total-->
        <div class="col-12 col-md-12 col-sm-12 mt-2">
          <div class="container shadow bg-white p-3">
            <div class="row">
              <div class="col-md-7 col-sm-7 col-7">
                <p
                  class="font-light-x1 mb-0 text-right pe-4"
                  style="font-size:20px !important;"
                >Subtotal</p>
              </div>
              <div class="col-md-5 col-sm-5 col-5">
                <p
                  class="font-light-x1 mb-0 text-right pe-4"
                  style="font-size:20px !important;"
                >{{ orderSummary.totalAll | currency('RM')}}</p>
              </div>
            </div>
            <div class="row pt-2 pb-2">
              <div class="col-md-7 col-sm-7 col-7">
                <p
                  class="font-light-x1 mb-0 text-right pe-4"
                  style="font-size:20px !important;"
                >Shipping</p>
              </div>
              <div class="col-md-5 col-sm-5 col-5">
                <p
                  class="font-light-x1 mb-0 text-right pe-4"
                  style="font-size:20px !important;"
                >{{ orderSummary.shippingFee | currency('RM')}}</p>
              </div>
            </div>
            <hr />
            <div class="row pt-1 pb-1">
              <div class="col-md-7 col-sm-7 col-7">
                <p class="font-light mb-0 text-right pe-4" style="font-size:20px !important;">Total</p>
              </div>
              <div class="col-md-5 col-sm-5 col-5">
                <p
                  class="font-light mb-0 text-right pe-4"
                  style="font-size:20px !important;"
                >{{ orderSummary.total | currency('RM')}}</p>
              </div>
            </div>
          </div>
        </div>
        <!--End Total-->
      </div>
    </div>
    <!--End Order Product-->

    <div class="container mb-5">
      <div class="row">
        <div class="col-12">
          <router-link :to="{name:'viewCart'}" class="btn btn-dark">Back To Previous Page</router-link>
          <button type="button" class="btn btn-dark" @click.prevent="checkOut">Confirm & Pay</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "pinia";
import { useAuthStore } from "../../store/auth";
import { useCartStore } from "../../store/cart";
import Vue2Filters from "vue2-filters";

export default {
  data() {
    return {
      timestamp: "",
      isCheck: false,
      address: "",
      deliveryMethod: "",
      cartData: {
        cusTeeCart: [],
        orderSummary: {},
        address: "",
        cusID: "",
        deliveryMethod: "",
      },
      order: {},
      errors: [],
    };
  },
  mixins: [Vue2Filters.mixin],
  mounted() {
    this.getDateTimeNow();
  },
  methods: {
    ...mapActions(useCartStore, ["removeCusCart"]),
    getDateTimeNow() {
      const today = new Date();
      const date =
        today.getFullYear() +
        "-" +
        (today.getMonth() + 1) +
        "-" +
        today.getDate();
      const time =
        today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
      const dateTime = date + " " + time;
      this.timestamp = dateTime;
    },
    fillInAddress() {
      this.isCheck = !this.isCheck;
      if (this.isCheck) {
        this.address = this.authCus.address;
      } else {
        this.address = "";
      }
    },
    checkOut() {
      this.cartData.cusTeeCart = this.cusTeeCart;
      this.cartData.orderSummary = this.orderSummary;
      this.cartData.address = this.address;
      this.cartData.deliveryMethod = this.deliveryMethod;
      this.cartData.cusID = this.authCus.cus_id;
      axios
        .post("/api/checkOut", {
          cartData: this.cartData,
        })
        .then((response) => {
          this.order = response.data;
          swal(
            "Success",
            `Successfully place an order!! This is your order id ${this.order.order_id}`,
            "success"
          ).then(() => {
            this.removeCusCart();
            this.$router.push("/customer/viewOrder");
          });
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
  },
  computed: {
    ...mapState(useAuthStore, ["authCus"]),
    ...mapState(useCartStore, ["cusTeeCart", "orderSummary"]),
  },
};
</script>
<style>
.title-con > hr {
  border-top: 1px solid #e6e6e6;
  margin-top: 15px;
}
.title-con1 > hr {
  border-top: 1px solid #e6e6e6;
  margin-top: 10px;
}
.font-light {
  color: #606975;
  font-size: 16px;
  font-weight: 500;
}
.font-light-x0 {
  color: #9c9c9c;
  font-size: 16px;
  font-weight: 500;
}
.font-light-x1 {
  color: #8a8a8a;
  font-size: 14px;
  font-weight: 500;
}
.font-light-x2 {
  color: #bfbfbf;
  font-size: 14px;
  font-weight: 500;
}
</style>