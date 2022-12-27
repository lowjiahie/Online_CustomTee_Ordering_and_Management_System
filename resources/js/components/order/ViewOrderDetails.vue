<template>
  <div>
    <div class="container title-con1 mt-4">
      <h1>
        <u>Order Details For ({{ orderInfo.orderID }})</u>
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
              <p class="font-light">Delivery Address</p>
            </div>
            <div class="col-6">
              <p class="font-light-x0 text-right">{{shippingDetails.address}}</p>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <p class="font-light">Delivery Service</p>
            </div>
            <div class="col-6">
              <p class="font-light-x0 text-right">{{shippingDetails.service}}</p>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <p class="font-light">Delivery Tracking Number</p>
            </div>
            <div class="col-6">
              <p class="font-light-x0 text-right">{{shippingDetails.trackingNum}}</p>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <p class="font-light">Delivery Status</p>
            </div>
            <div class="col-6">
              <p class="font-light-x0 text-right">{{shippingDetails.status}}</p>
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
              <p class="font-light-x0 text-right">{{orderInfo.orderDate}}</p>
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
              <p class="font-light">Paypal reference number</p>
            </div>
            <div class="col-6">
              <p class="font-light-x0 text-right">{{orderInfo.paymentRefNum}}</p>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <p class="font-light">Order Status</p>
            </div>
            <div class="col-6">
              <p class="font-light-x0 text-right">{{orderInfo.status}}</p>
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
          <div v-for="(item, index) in orderDetails" :key="index">
            <div class="container shadow bg-white p-3">
              <div class="row">
                <div class="col-md-1">
                  <p class="font-light font-weight-bold text-center" style="padding-top:50px;">#</p>
                </div>
                <div class="col-md-4 product-img">
                  <div class="row">
                    <div class="col-md-6 pe-0">
                      <img
                        class="img-thumbnail border-0 pe-0"
                        :src="require('@assets/customTee/'+item.front_design_img)"
                      />
                    </div>
                    <div class="col-md-6 ps-0">
                      <img
                        class="img-thumbnail border-0 ps-0"
                        :src="require('@assets/customTee/'+item.back_design_img)"
                      />
                    </div>
                  </div>
                </div>
                <div class="col-md-7 mt-3">
                  <div class="row">
                    <div class="col-md-12">
                      <p class="h4">{{ customTeeName[index] }} (Size->{{item.size_name}} | {{ item.printing_name}})</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-6">
                      <p
                        class="font-light-x2 mb-2"
                      >Product: {{item.type_name}} {{item.material}} | {{item.detail}} | {{item.color_name}}</p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                      <p class="font-light-x2 mb-2">Size: {{item.size_name}}</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-6">
                      <p class="font-light mb-2">{{ item.plain_tee_price | currency('RM') }}</p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                      <p class="font-light mb-2">QTY: {{item.total_qty}}</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-6">
                      <p class="font-light mb-2">{{ item.printing_name }}</p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                      <p class="font-light mb-2">{{ item.printing_method_price | currency('RM') }}</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <p
                        class="font-light mb-0 text-right pe-4"
                        style="font-size:18px !important;"
                      >Subtotal: {{ item.sub_total | currency('RM') }}</p>
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
          <router-link :to="{name:'viewOrder'}" class="btn btn-dark">Back To View Order</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "pinia";
import { useAuthStore } from "../../store/auth";
import Vue2Filters from "vue2-filters";

export default {
  data() {
    return {
      orderDetails: [],
      orderSummary: {
        totalAll: 0.0,
        shippingFee: 5.99,
        total: 0,
      },
      customTeeName:[],
      shippingDetails: {
        address: "",
        service: "",
        trackingNum: "",
        status: "",
      },
      orderInfo: {
        orderID:"",
        orderDate: "",
        status: "",
        paymentRefNum: "",
      },
    };
  },
  mixins: [Vue2Filters.mixin],
  created() {
    axios
      .get(`/api/getOrderDetails/${this.$route.params.id}`)
      .then((response) => {
        this.orderDetails = response.data;
        for (let i = 0; i < this.orderDetails.length; i++) {
          this.orderSummary.totalAll += parseFloat(
            this.orderDetails[i]["sub_total"]
          );
          let tempName = this.orderDetails[i]['front_design_img']
          tempName = tempName.split('-');
          this.customTeeName.push(tempName[1]);
        }
        this.orderSummary.total = this.orderDetails[0]["totalPrice"];
        this.shippingDetails.address = this.orderDetails[0]["shipping_address"];
        this.shippingDetails.service = this.orderDetails[0]["delivery_service"];
        this.shippingDetails.status = this.orderDetails[0]["delivery_status"];
        console.log(this.orderDetails[0]["delivery_tracking_num"]);
        this.shippingDetails.trackingNum =
          this.orderDetails[0]["delivery_tracking_num"]==null?"Waiting for tracking number from third party..":this.orderDetails[0]["delivery_tracking_num"];
        this.orderInfo.orderDate = this.orderDetails[0]["order_date"];
        this.orderInfo.status = this.orderDetails[0]["order_status"];
        this.orderInfo.paymentRefNum = this.orderDetails[0]["payment_rf_num"];
        this.orderInfo.orderID = this.orderDetails[0]["order_id"];
        
      });
  },
  methods: {},
  computed: {
    ...mapState(useAuthStore, ["authCus"]),
  },
};
</script>

<style>
</style>