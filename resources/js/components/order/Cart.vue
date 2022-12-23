<template>
  <!--Start Cart Content-->
  <div>
    <h1>Custom-Tee Cart</h1>
    <hr />
    <div class="container-fluid mb-4">
      <div class="row">
        <div class="col-lg-9 col-md-8 col-sm-12 ps-0 pe-0">
          <div class="container-fluid vertical-scrollable">
            <div v-for="(item, index) in cusTeeCart" :key="index">
              <div v-if="item.cusID == authCus.cus_id" class="card mb-3 p-2">
                <div class="row g-0">
                  <div class="col-md-3">
                    <img
                      :src="require('@assets/customTee/'+item.customtee.front_design_img)"
                      class="img-fluid rounded-start"
                    />
                  </div>
                  <div class="col-md-3">
                    <img
                      :src="require('@assets/customTee/'+item.customtee.back_design_img)"
                      class="img-fluid rounded-start"
                    />
                  </div>
                  <div class="col-md-6">
                    <div class="card-body pe-0">
                      <h5
                        class="card-title fw-bold mb-3"
                      >{{item.customtee.name}} (Size->{{item.sizeName}} | {{ item.printingMethodName}})</h5>
                      <p class="card-text mb-2">
                        <b class="text-dark">Product :</b>
                        <br />
                        {{item.customtee.type_name}} {{item.customtee.material}} | {{item.customtee.detail}} | {{item.customtee.color_name}}
                      </p>
                      <p class="card-text mb-1">
                        <b class="text-dark">PlainTee Price:</b>
                        {{ item.customtee.price | currency('RM') }}
                      </p>
                      <p class="card-text mb-1">
                        <b class="text-dark">Printing Method:</b>
                        {{ item.printingMethodName }}
                      </p>
                      <p class="card-text mb-1">
                        <b class="text-dark">Printing Price:</b>
                        {{ item.printingPrice | currency('RM') }}
                      </p>
                      <p class="card-text mb-1">
                        <b class="text-dark">Size:</b>
                        <span
                          class="fw-bold text-uppercase text-decoration-underline"
                        >{{ item.sizeName }}</span>
                      </p>
                      <p class="card-text mb-2">
                        <b class="text-dark">Order Quantity:</b>
                        <vue-numeric-input
                          v-model="item.qty"
                          :min="1"
                          :mousewheel="true"
                          align="center"
                        ></vue-numeric-input>
                      </p>
                      <p class="card-text mb-1">
                        <b class="text-dark">Sub-Total:</b>
                        <span
                          class="fw-bold text-uppercase text-decoration-underline"
                        >{{ calculatePrice(item) | currency('RM') }}</span>
                      </p>
                      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button
                          class="btn btn-danger"
                          type="button"
                          @click="deleteItemFromCart(index)"
                        >Delete</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12 pl-3 payment-column" v-if="cartCount != 0">
          <div class="container-fluid bg-white">
            <div class="row p-2" style="background-color:#000000;">
              <p class="h5 text-white pl-2 pt-1">Order Summary</p>
            </div>
            <div class="row pt-3 pb-2 font-size-14">
              <div class="col-md-6 col-sm-6 col-6 font-light">Sub Total</div>
              <div class="col-md-6 col-sm-6 col-6 text-right font-light">
                <span>{{ orderSummary.totalAll | currency('RM')}}</span>
              </div>
            </div>
            <div class="row pb-3 font-size-14">
              <div class="col-md-6 col-sm-6 col-6 font-light">Shipping</div>
              <div class="col-md-6 col-sm-6 col-6 text-right font-light">
                <span>{{ orderSummary.shippingFee | currency('RM')}}</span>
              </div>
            </div>
            <div class="border-line-2"></div>
            <div class="row pb-2 pt-2 font-size-19">
              <div class="col-md-6 col-sm-6 col-6">Total</div>
              <div class="col-md-6 col-sm-6 col-6 text-right">
                <span>{{ orderSummary.total | currency('RM')}}</span>
              </div>
            </div>
            <div class="row pb-3 font-size-13">
              <div class="col-md-12 col-sm-12 col-12 font-light">
                <span>*Estimate delivery time will be in 7 working days</span>
              </div>
            </div>
            <div class="border-line-2"></div>
            <div class="row pt-3 pb-3">
              <div class="col-md-12 col-sm-12 col-12">
                <button
                  type="submit"
                  class="btn text-white btn-block"
                  @click="redirectToOrderConfirmation"
                  style="border-radius: 50px !important;background-color:#000000;"
                >Checkout</button>
              </div>
            </div>
          </div>
        </div>
        <div class="ms-2" v-if="cartCount == 0">
          <span>Does not have any item inside cart.</span>
        </div>
      </div>
    </div>
    <!-- <h1>Design Cart</h1>
    <hr />
    <div class="container-fluid mb-4">
      <div class="row">
        <div class="col-lg-9 col-md-8 col-sm-12 ps-0 pe-0">
          <div class="container-fluid vertical-scrollable">
            <div class="card mb-3" style="max-width: 900px;">
              <div class="row g-0">
                <div class="col-md-4">
                  <img
                    :src="require('@assets/customTee/CS00001-123-TC00001-back-preset.jpg')"
                    class="img-fluid rounded-start"
                  />
                </div>
                <div class="col-md-4">
                  <img
                    :src="require('@assets/customTee/CS00001-123-TC00001-front-preset.jpg')"
                    class="img-fluid rounded-start"
                  />
                </div>
                <div class="col-md-4">
                  <div class="card-body pe-0">
                    <h5 class="card-title fw-bold mb-3">{{123}}</h5>
                    <p class="card-text mb-2">
                      <b class="text-dark">Design Description:</b>
                      <br />
                      {{}}
                    </p>
                    <p class="card-text mb-1">
                      <b class="text-dark">Design Price:</b>
                      {{  }}
                    </p>
                    <p class="card-text mb-1">
                      <b class="text-dark">Publish Type:</b>
                      {{ }}
                    </p>
                    <p class="card-text mb-1">
                      <b class="text-dark">Publish Status:</b>
                      <span class="fw-bold text-uppercase text-decoration-underline">{{ 123}}</span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card mb-3" style="max-width: 900px;">
              <div class="row g-0">
                <div class="col-md-4">
                  <img
                    :src="require('@assets/customTee/CS00001-123-TC00001-back-preset.jpg')"
                    class="img-fluid rounded-start"
                  />
                </div>
                <div class="col-md-4">
                  <img
                    :src="require('@assets/customTee/CS00001-123-TC00001-front-preset.jpg')"
                    class="img-fluid rounded-start"
                  />
                </div>
                <div class="col-md-4">
                  <div class="card-body pe-0">
                    <h5 class="card-title fw-bold mb-3">{{}}</h5>
                    <p class="card-text mb-2">
                      <b class="text-dark">Design Description:</b>
                      <br />
                      {{}}
                    </p>
                    <p class="card-text mb-1">
                      <b class="text-dark">Design Price:</b>
                      {{  }}
                    </p>
                    <p class="card-text mb-1">
                      <b class="text-dark">Publish Type:</b>
                      {{ }}
                    </p>
                    <p class="card-text mb-1">
                      <b class="text-dark">Publish Status:</b>
                      <span class="fw-bold text-uppercase text-decoration-underline">{{ 123}}</span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12 pl-3 payment-column">
          <div class="container-fluid bg-white">
            <div class="row p-2" style="background-color:#000000;">
              <p class="h5 text-white pl-2 pt-1">Order Summary</p>
            </div>
            <div class="row pt-3 pb-2 font-size-14">
              <div class="col-md-6 col-sm-6 col-6 font-light">Sub Total</div>
              <div class="col-md-6 col-sm-6 col-6 text-right font-light">
                <span>RM</span>
              </div>
            </div>
            <div class="row pb-3 font-size-14">
              <div class="col-md-6 col-sm-6 col-6 font-light">Shipping</div>
              <div class="col-md-6 col-sm-6 col-6 text-right font-light">
                <span>RM</span>
              </div>
            </div>
            <div class="border-line-2"></div>
            <div class="row pb-2 pt-2 font-size-19">
              <div class="col-md-6 col-sm-6 col-6">Total</div>
              <div class="col-md-6 col-sm-6 col-6 text-right">
                <span>RM</span>
              </div>
            </div>
            <div class="row pb-3 font-size-13">
              <div class="col-md-12 col-sm-12 col-12 font-light">
                <span>*Estimate delivery time will be in 7 working days</span>
              </div>
            </div>
            <div class="border-line-2"></div>
            <div class="row pt-3 pb-3">
              <div class="col-md-12 col-sm-12 col-12">
                <form action="PaymentControl" method="POST">
                  <input type="hidden" value="reviewOrder" name="paymentAction" />
                  <input type="hidden" value="<%=orderSubTtl%>" name="orderSubTtl" />
                  <input type="hidden" value="<%=shippingFee%>" name="shippingFee" />
                  <input type="hidden" value="<%=orderTtl%>" name="orderTtl" />
                  <button
                    type="submit"
                    class="btn text-white btn-block"
                    style="border-radius: 50px !important;background-color:#000000;"
                  >Checkout</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>-->
  </div>
</template>

<script>
import Vue2Filters from "vue2-filters";
import VueNumericInput from "vue-numeric-input";
import { mapState, mapActions } from "pinia";
import { useCartStore } from "../../store/cart";
import { useAuthStore } from "../../store/auth";

export default {
  components: {
    VueNumericInput,
  },
  data() {
    return {
      orderSummary: {
        totalAll: 0.0,
        shippingFee: 5.99,
        total: 0,
      },
      calTtlTimeOut:"",
    };
  },
  mixins: [Vue2Filters.mixin],
  created() {
    // axios
    //   .post(`/api/`, {
    //     cart:
    //   })
    //   .then((response) => {
    //     console.log(response);
    //   });
  },
  mounted() {
    this.calculateTotalAll();
  },

  methods: {
    ...mapActions(useCartStore, ["deleteItemFromCart", "setOrderSummary"]),
    calculatePrice(item) {
      item.subtotal =
        (parseFloat(item.customtee.price) + parseFloat(item.printingPrice)) *
        item.qty;
      return item.subtotal;
    },
    calculateTotalAll() {
      this.calTtlTimeOut = setInterval(() => {
        this.orderSummary.totalAll = 0;
        this.orderSummary.total = 0;
        for (var i = 0; i < this.cusTeeCart.length; i++) {
          if (this.cusTeeCart[i].cusID == this.authCus.cus_id) {
            this.orderSummary.totalAll +=
              (parseFloat(this.cusTeeCart[i].customtee.price) +
                parseFloat(this.cusTeeCart[i].printingPrice)) *
              this.cusTeeCart[i].qty;
          }
        }
        this.orderSummary.total =
          parseFloat(this.orderSummary.totalAll) +
          parseFloat(this.orderSummary.shippingFee);
      }, 300);
    },
    redirectToOrderConfirmation() {
      this.setOrderSummary(this.orderSummary);
      clearTimeout(this.calTtlTimeOut);
      this.$router.push("/customer/orderConfirmation");
      location.reload();
    },
  },
  computed: {
    ...mapState(useCartStore, ["cusTeeCart", "cartCount"]),
    ...mapState(useAuthStore, ["authCus"]),
  },
};
</script>
<style scope>
.tab-pane {
  height: 400px;
  overflow-y: auto;
  overflow-x: hidden;
  width: 100%;
}
.title-con > hr {
  border-top: 1px solid #bdbdbd;
  margin-top: 45px;
}
.btn {
  border-radius: 0 !important;
  padding: 10px;
}
.vertical-scrollable {
  width: 100%;
  max-height: 400px;
  overflow-y: scroll;
}
.product-container {
  margin-left: 20px;
  padding: 1px;
  padding-left: 0px;
  margin-bottom: 15px;
  background-color: white;
}
.input-style {
  border-radius: 30px;
  width: 50%;
  padding-left: 20px;
  font-size: 14px;
}
.input-style2 {
  border-radius: 30px;
  padding-left: 20px;
  font-size: 14px;
}
.font-light {
  color: #8a8a8a;
}
.font-size-13 {
  font-size: 13px;
}
.font-size-14 {
  font-size: 14.5px;
}
.font-size-19 {
  font-size: 17px;
}
.border-line-2 {
  width: 100%;
  height: 1px;
  background: #cdcdcd;
}
/* Hide scrollbar for Chrome, Safari and Opera */
.vertical-scrollable::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.vertical-scrollable {
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}
@media screen and (max-width: 768px) {
  .payment-column {
    margin-top: 20px !important;
  }
  .product-img {
    padding-top: 0 !important;
    padding-bottom: 0 !important;
  }
  .button-gap {
    margin-bottom: 10px !important;
  }
  .button-gap-left {
    padding-left: 0 !important;
  }
  .font-size-19 {
    font-size: 19px;
  }
}
</style>