<template>
  <div class>
    <div class="container p-2">
      <div class="row">
        <div class="col-md-8 col-sm-12 col-12">
          <div class="row btn-center">
            <div class="col-2 p-2">
              <button
                type="button"
                @click="getOrderWithStatus('pending')"
                class="btn btn-dark"
              >Pending</button>
            </div>
            <div class="col-2 p-2">
              <button
                type="button"
                @click="getOrderWithStatus('processing')"
                class="btn btn-dark"
              >Processing</button>
            </div>
            <div class="col-2 p-2">
              <button
                type="button"
                @click="getOrderWithStatus('completed')"
                class="btn btn-dark"
              >Completed</button>
            </div>
            <div class="col-2 p-2">
              <button
                type="button"
                @click="getOrderWithStatus('cancelled')"
                class="btn btn-dark"
              >Cancelled</button>
            </div>
            <div class="col-2 p-2">
              <button
                type="button"
                @click="getOrderWithStatus('failed')"
                class="btn btn-dark"
              >Failed</button>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-12 col-12">
          <div class="input-group p-2">
            <input
              type="text"
              class="form-control"
              v-model="orderID"
              placeholder="Search by Order ID"
            />
            <div class="input-group-btn">
              <button
                class="btn btn-default border border-1"
                @click="searchByOrderID"
                type="button"
              >
                <svg
                  t="1616676596883"
                  class="icon"
                  viewBox="0 0 1024 1024"
                  version="1.1"
                  xmlns="http://www.w3.org/2000/svg"
                  p-id="7531"
                  width="20"
                  height="20"
                >
                  <path
                    d="M416 192C537.6 192 640 294.4 640 416S537.6 640 416 640 192 537.6 192 416 294.4 192 416 192M416 128C256 128 128 256 128 416S256 704 416 704 704 576 704 416 576 128 416 128L416 128z"
                    p-id="7532"
                    fill="#2c2c2c"
                  />
                  <path
                    d="M832 864c-6.4 0-19.2 0-25.6-6.4l-192-192c-12.8-12.8-12.8-32 0-44.8s32-12.8 44.8 0l192 192c12.8 12.8 12.8 32 0 44.8C851.2 864 838.4 864 832 864z"
                    p-id="7533"
                    fill="#2c2c2c"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Start Order Status-->
    <div class="container title-con">
      <span class="h4 text-uppercase">{{ statusTitle }}</span>
      <br />
      <hr />
    </div>

    <div class="container mb-5">
      <div
        v-for="(item, index) in order"
        :key="index"
        class="container mb-4 shadow bg-white rounded"
      >
        <div class="row">
          <div class="col-md-2">
            <p class="h5 text-center setGap-no" style="padding-top:80px;">{{index+1}}</p>
          </div>
          <div v-if="item" class="col-md-3 bg-dark rounded">
            <!-- Pending -->
            <div v-if="item.status == 'pending'" class="text-center p-3 pt-3 mt-5">
              <svg
                t="1670985821798"
                class="icon"
                viewBox="0 0 1024 1024"
                version="1.1"
                xmlns="http://www.w3.org/2000/svg"
                p-id="6448"
                width="80"
                height="80"
              >
                <path
                  d="M513.93 741.69c11.01-95.02 85.96-174.08 180.29-189.96 34.86-5.87 68.41-3.34 99.15 5.75 23.98 7.09 47.9-10.87 47.9-35.88V128.03c0-30.32-24.58-54.89-54.89-54.89H164.73c-30.31 0-54.89 24.57-54.89 54.89v767.93c0 30.31 24.58 54.89 54.89 54.89H520.2c29.99 0 48.29-33.64 31.19-58.27-29.13-41.97-43.98-94.59-37.46-150.89zM256.27 240.91c0-11.94 9.68-21.62 21.62-21.62H673.5c11.94 0 21.62 9.68 21.62 21.62v29.9c0 11.94-9.68 21.62-21.62 21.62H277.89c-11.94 0-21.62-9.68-21.62-21.62v-29.9z m0 146.28c0-11.94 9.68-21.62 21.62-21.62h322.47c11.94 0 21.62 9.68 21.62 21.62v29.9c0 11.94-9.68 21.62-21.62 21.62H277.89c-11.94 0-21.62-9.68-21.62-21.62v-29.9zM475.7 563.38c0 11.94-9.68 21.62-21.62 21.62H277.89c-11.94 0-21.62-9.68-21.62-21.62v-29.9c0-11.94 9.68-21.62 21.62-21.62h176.19c11.94 0 21.62 9.68 21.62 21.62v29.9z"
                  fill="#ffffff"
                  p-id="6449"
                />
                <path
                  d="M731.56 585.14c-100.99 0-182.86 81.87-182.86 182.86s81.87 182.86 182.86 182.86S914.41 868.99 914.41 768s-81.86-182.86-182.85-182.86z m81.95 246.12l-18.09 18.23c-5.67 5.72-14.91 5.75-20.63 0.08l-70.67-70.14V693.3c0-8.06 6.53-14.58 14.59-14.58h25.68c8.06 0 14.59 6.53 14.59 14.58v63.27l54.45 54.06c5.72 5.68 5.76 14.91 0.08 20.63z"
                  fill="#ffffff"
                  p-id="6450"
                />
              </svg>
              <p class="text-white">Pending</p>
            </div>
            <!-- Processing -->
            <div v-if="item.status == 'processing'" class="text-center p-3 pt-3 mt-5">
              <svg
                t="1616738832490"
                class="icon"
                viewBox="0 0 1024 1024"
                version="1.1"
                xmlns="http://www.w3.org/2000/svg"
                p-id="5332"
                data-spm-anchor-id="a313x.7781069.0.i1"
                width="80"
                height="80"
              >
                <path
                  d="M972.288 305.152c0-0.512 0-1.536-0.512-2.048V302.08c-0.512-2.56-1.024-5.632-2.56-8.192 0-1.024-0.512-1.536-1.024-2.048-0.512-1.024-1.024-1.536-1.536-2.56-0.512-1.536-2.048-2.56-3.072-4.096l-3.072-3.072c-0.512-0.512-1.024-1.024-2.048-1.536-0.512-0.512-1.024-0.512-1.536-1.024l-0.512-0.512h-0.512s-0.512-0.512-1.024-0.512-1.024-0.512-1.536-1.024c-0.512-0.512-1.536-1.024-2.048-1.024l-220.672-92.16L527.36 98.816c-7.68-3.584-16.896-3.584-25.6-0.512L35.84 266.752h-1.024c-2.56 1.024-5.632 2.048-8.192 4.608l-1.024 1.024c-0.512 0.512-1.024 0.512-1.024 1.024-0.512 0.512-1.024 1.024-2.048 1.536l-0.512 0.512v1.024l-0.512 0.512c-0.512 0.512-0.512 1.024-1.024 1.024l-1.024 1.024c-1.536 1.536-2.048 3.072-2.56 4.608-0.512 0.512-0.512 1.536-1.024 2.048 0 0.512 0 0.512-0.512 1.024l-1.024 2.56c-0.512 1.024-1.024 2.56-1.024 4.096v1.024c0 1.024-0.512 2.048-0.512 3.072v363.52c0 13.312 7.168 25.088 18.944 30.72l433.152 220.672v1.024h2.048c0.512 0 0.512 0.512 1.024 0.512s1.024 0.512 1.024 0.512c0.512 0 0.512 0 1.024 0.512v0.512h0.512c0.512 0 1.024 0.512 2.048 0.512h0.512c0.512 0 1.024 0.512 2.048 0l0.512 0.512H481.28c1.024 0 3.072 0 4.608-0.512h0.512c1.024 0 1.536 0 2.048-0.512h1.024c1.024 0 2.048-0.512 2.56-1.024h1.024c0.512 0 1.024 0 1.536-0.512 1.024 0 1.536-0.512 2.048-1.024l156.672-70.144c8.192-3.584 14.848-10.752 18.432-19.456 3.072-8.704 3.072-17.92-1.024-26.624-8.192-17.408-28.672-25.088-45.568-17.408l-108.544 48.128v-302.08l387.072-166.4v113.664c0 18.944 15.36 34.816 34.816 34.816s34.816-15.36 34.816-34.816V305.152h-1.024z m-123.392 3.072L481.28 466.432 344.576 401.408l371.712-148.48 132.608 55.296z m-711.68-4.096L512 167.936l112.128 47.104-365.568 145.92-121.344-56.832z m308.736 221.696v299.52L81.92 640V354.304l364.032 171.52z"
                  fill="#ffffff"
                  p-id="5333"
                  data-spm-anchor-id="a313x.7781069.0.i0"
                  class
                />
                <path
                  d="M878.08 771.584c-5.12 0-9.216-1.536-12.8-5.12l-39.936-33.792c-4.608-3.584-7.168-9.216-7.168-15.36v-68.608c0-11.264 8.704-19.968 19.968-19.968s19.968 8.704 19.968 19.968v58.88l32.768 27.648c8.704 7.168 9.216 19.456 2.048 28.672-3.072 5.12-9.216 7.68-14.848 7.68z"
                  fill="#f1f1f1"
                  p-id="5334"
                  data-spm-anchor-id="a313x.7781069.0.i2"
                  class="selected"
                />
                <path
                  d="M848.896 872.448c-94.72 0-172.032-77.312-172.032-172.032s77.312-172.032 172.032-172.032 172.032 77.312 172.032 172.032-77.312 172.032-172.032 172.032z m0-290.816c-65.536 0-118.784 53.248-118.784 118.784S783.36 819.2 848.896 819.2s118.784-53.248 118.784-118.784-53.76-118.784-118.784-118.784z"
                  fill="#f1f1f1"
                  p-id="5335"
                  data-spm-anchor-id="a313x.7781069.0.i3"
                  class="selected"
                />
              </svg>
              <p class="text-white">Processing</p>
            </div>
            <!-- Cancelled -->
            <div v-if="item.status == 'cancelled'" class="text-center p-3 pt-3 mt-5">
              <svg
                t="1670987732577"
                class="icon"
                viewBox="0 0 1024 1024"
                version="1.1"
                xmlns="http://www.w3.org/2000/svg"
                p-id="8227"
                width="80"
                height="80"
              >
                <path
                  d="M864 440.96V864c0 53.12-42.88 96-96 96H256a94.72 94.72 0 0 1-94.72-85.76L224 835.2v28.8c0 17.92 14.08 32 32 32h512c17.92 0 32-14.08 32-32V480.64l64-39.68z m47.04-180.288l33.568 54.496L112.992 827.328 79.424 772.8 911.04 260.672zM256 128v64c-17.92 0-32 14.08-32 32v383.36l-64 39.68V224c0-53.12 42.88-96 96-96z m448-64v192H320V64h384z m64 64c49.28 0 90.24 37.76 94.72 85.76L800 252.8V224c0-17.92-14.08-32-32-32z m-128 0h-256v64h256V128z"
                  fill="#ffffff"
                  p-id="8228"
                />
              </svg>
              <p class="text-white">Cancelled</p>
            </div>
            <!-- Failed -->
            <div v-if="item.status == 'failed'" class="text-center p-3 pt-3 mt-5">
              <svg
                t="1670987842458"
                class="icon"
                viewBox="0 0 1024 1024"
                version="1.1"
                xmlns="http://www.w3.org/2000/svg"
                p-id="13232"
                width="80"
                height="80"
              >
                <path
                  d="M512 85.333333c235.648 0 426.666667 191.018667 426.666667 426.666667s-191.018667 426.666667-426.666667 426.666667S85.333333 747.648 85.333333 512 276.352 85.333333 512 85.333333z m181.034667 185.301334L512 451.669333 330.965333 270.634667 270.634667 330.965333 451.669333 512l-181.034666 181.034667 60.330666 60.330666L512 572.330667l181.034667 181.034666 60.330666-60.330666L572.330667 512l181.034666-181.034667-60.330666-60.330666z"
                  fill="#ffffff"
                  p-id="13233"
                />
              </svg>
              <p class="text-white">Failed</p>
            </div>
            <!-- completed -->
            <div v-if="item.status == 'completed'" class="text-center p-3 pt-3 mt-5">
              <svg
                t="1616740793201"
                class="icon"
                viewBox="0 0 1024 1024"
                version="1.1"
                xmlns="http://www.w3.org/2000/svg"
                p-id="7517"
                data-spm-anchor-id="a313x.7781069.0.i26"
                width="80"
                height="80"
              >
                <path
                  d="M972.288 305.152c0-0.512 0-1.536-0.512-2.048V302.08c-0.512-2.56-1.024-5.632-2.56-8.192 0-1.024-0.512-1.536-1.024-2.048-0.512-1.024-1.024-1.536-1.536-2.56-0.512-1.536-2.048-2.56-3.072-4.096l-3.072-3.072c-0.512-0.512-1.024-1.024-2.048-1.536-0.512-0.512-1.024-0.512-1.536-1.024l-0.512-0.512h-0.512s-0.512-0.512-1.024-0.512-1.024-0.512-1.536-1.024c-0.512-0.512-1.536-1.024-2.048-1.024l-220.672-92.16L527.36 98.816c-7.68-3.584-16.896-3.584-25.6-0.512L35.84 266.752h-1.024c-2.56 1.024-5.632 2.048-8.192 4.608l-1.024 1.024c-0.512 0.512-1.024 0.512-1.024 1.024-0.512 0.512-1.024 1.024-2.048 1.536l-0.512 0.512v1.024l-0.512 0.512c-0.512 0.512-0.512 1.024-1.024 1.024l-1.024 1.024c-1.536 1.536-2.048 3.072-2.56 4.608-0.512 0.512-0.512 1.536-1.024 2.048 0 0.512 0 0.512-0.512 1.024l-1.024 2.56c-0.512 1.024-1.024 2.56-1.024 4.096v1.024c0 1.024-0.512 2.048-0.512 3.072v363.52c0 13.312 7.168 25.088 18.944 30.72l433.152 220.672v1.024h2.048c0.512 0 0.512 0.512 1.024 0.512s1.024 0.512 1.024 0.512c0.512 0 0.512 0 1.024 0.512v0.512h0.512c0.512 0 1.024 0.512 2.048 0.512h0.512c0.512 0 1.024 0.512 2.048 0l0.512 0.512H481.28c1.024 0 3.072 0 4.608-0.512h0.512c1.024 0 1.536 0 2.048-0.512h1.024c1.024 0 2.048-0.512 2.56-1.024h1.024c0.512 0 1.024 0 1.536-0.512 1.024 0 1.536-0.512 2.048-1.024l156.672-70.144c8.192-3.584 14.848-10.752 18.432-19.456 3.072-8.704 3.072-17.92-1.024-26.624-8.192-17.408-28.672-25.088-45.568-17.408l-108.544 48.128v-302.08l387.072-166.4v113.664c0 18.944 15.36 34.816 34.816 34.816s34.816-15.36 34.816-34.816V305.152h-1.024z m-123.392 3.072L481.28 466.432 344.576 401.408l371.712-148.48 132.608 55.296z m-711.68-4.096L512 167.936l112.128 47.104-365.568 145.92-121.344-56.832z m308.736 221.696v299.52L81.92 640V354.304l364.032 171.52z"
                  fill="#ffffff"
                  p-id="7518"
                  data-spm-anchor-id="a313x.7781069.0.i23"
                  class
                />
                <path
                  d="M997.888 575.488c-15.36-12.8-37.376-11.264-50.688 3.584L798.72 752.64l-76.8-87.552c-6.144-7.168-15.36-11.264-24.576-12.288-9.728-0.512-18.944 2.56-26.112 9.216-14.336 13.312-15.872 35.84-3.072 50.688l104.448 119.296c6.144 7.68 16.384 12.288 27.136 12.288 11.264-0.512 20.48-5.12 26.624-12.8l175.616-204.8c12.288-15.872 10.752-37.888-4.096-51.2z"
                  fill="#fafafa"
                  p-id="7519"
                  data-spm-anchor-id="a313x.7781069.0.i24"
                  class="selected"
                />
              </svg>
              <p class="text-white">Completed</p>
            </div>
          </div>
          <div class="col-md-7">
            <div class="row pt-2">
              <div class="col-12">
                <p class="h3">Order ID - {{ item.order_id }}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-12 pt-2">
                <p class="font-light-x1">Order Date : {{ item.order_date }}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-12 pt-2">
                <p class="font-light-x1">Shipping Address : {{ item.shipping_address }}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-12 pt-2">
                <p class="font-light-x1">
                  Payment method :
                  <span class="text-uppercase">{{ item.payment_method }}</span>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-6 pt-2">
                <p class="font-light">Total Price : {{ item.totalPrice | currency('RM')}}</p>
              </div>
              <div class="col-6 text-right">
                <button type="submit" class="btn btn-dark" @click="redirectToOrderDetails(item.order_id)">View Order</button>
                <button
                  type="submit"
                  class="btn btn-danger"
                  v-if="item.status == 'pending'"
                  @click="cancelOrder(item.order_id)"
                >Cancel Order</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container mb-5" v-if="order.length == 0">
      <p>Does not have any order with this status</p>
    </div>
    <!--End Order Status-->
  </div>
</template>

<script>
import { mapState, mapActions } from "pinia";
import { useAuthStore } from "../../store/auth";
import Vue2Filters from "vue2-filters";
export default {
  data() {
    return {
      order: [],
      statusTitle: "",
      orderID: "",
    };
  },
  mounted() {
    this.getOrderWithStatus("pending");
  },
  mixins: [Vue2Filters.mixin],
  methods: {
    getOrderWithStatus(status) {
      this.statusTitle = status;
      this.order = [];
      axios
        .post("/api/getOrderWithStatus", {
          status: status,
          cusID: this.authCus.cus_id,
        })
        .then((response) => {
          this.order = response.data;
        });
    },
    searchByOrderID() {
      axios
        .post("/api/searchOrderByID", {
          orderID: this.orderID,
        })
        .then((response) => {
          this.order = response.data;
        });
    },
    cancelOrder(id) {
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to cancel this order?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((confirmUpdate) => {
        if (confirmUpdate) {
          axios
            .post("/api/cancelOrder", {
              orderID: id,
            })
            .then((response) => {
              swal("Success Cancel", "Successfully cancel order!!", "success");
              this.getOrderWithStatus(this.statusTitle);
            });
        }
      });
    },
    redirectToOrderDetails(id) {
        this.$router.push({ name: "viewOrderDetails", params: { id } });
    },
  },
  computed: {
    ...mapState(useAuthStore, ["authCus"]),
  },
};
</script>

<style>
.title-con > hr {
  border-top: 1px solid #e6e6e6;
  margin-top: 0px;
}
input,
input::-webkit-input-placeholder {
  font-size: 15px;
}
.font-light-x1 {
  color: #8a8a8a;
  font-size: 14px;
  font-weight: 500;
}
.font-light {
  color: #606975;
  font-size: 16px;
  font-weight: 500;
}
@media screen and (max-width: 768px) {
  .btn-center {
    justify-content: center;
  }
  .setGap-no {
    padding-top: 30px !important;
    padding-bottom: 20px !important;
  }
}
</style>