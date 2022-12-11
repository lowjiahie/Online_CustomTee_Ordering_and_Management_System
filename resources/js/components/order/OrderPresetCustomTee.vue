<template>
  <div>
    <h1>Order My Preset Custom-Tee</h1>
    <hr />
    <div class="card mb-3">
      <div class="row g-0">
        <div class="col-md-3">
          <img
            :src="require('@assets/customTee/'+presetCustomTee.front_design_img)"
            class="img-fluid rounded-start"
          />
        </div>
        <div class="col-md-3">
          <img
            :src="require('@assets/customTee/'+presetCustomTee.back_design_img)"
            class="img-fluid rounded-start"
          />
        </div>
        <div class="col-md-6">
          <div class="card-body pe-0">
            <h3 class="card-title fw-bold mb-3">{{presetCustomTee.name}}</h3>
            <p class="card-text mb-2">
              <b class="text-dark">PlainTee:</b>
              {{presetCustomTee.type_name}} {{presetCustomTee.material}} | {{presetCustomTee.detail}}
            </p>
            <p class="card-text mb-2">
              <b class="text-dark">Color:</b>
              {{presetCustomTee.color_name}}
            </p>
            <p class="card-text mb-2">
              <b class="text-dark">PlainTee Price:</b>
              {{ presetCustomTee.price | currency('RM') }}
            </p>
            <p class="card-text mb-2">
              <b class="text-dark">Printing Method:</b>
              {{ minimumOrder }}
              <select
                class="form-select mt-2"
                v-model="selectedPrintingMethod"
                @change="showMinimumOrder"
                style="width:250px"
              >
                <option
                  v-for="availablePrintingMethod in availablePrintingMethods"
                  :key="availablePrintingMethod.p_method_id"
                  :value="availablePrintingMethod.p_method_id"
                >{{ availablePrintingMethod.name }}-{{ availablePrintingMethod.price | currency('RM') }}</option>
              </select>
            </p>
            <p class="card-text mb-4">
              <b class="text-dark">PlainTee Size:</b>
              <select class="form-select mt-2" v-model="selectedSize" style="width:250px">
                <option
                  v-for="availableSize in availableSizes"
                  :key="availableSize.plain_tee_size_id"
                  :value="availableSize.plain_tee_size_id"
                >{{ availableSize.size_name }}</option>
              </select>
            </p>
            <p class="card-text mb-4">
              <b class="text-dark">Order Quantity:</b>
              <vue-numeric-input v-model="orderQty" :min="1" :mousewheel="true" align="center" @input="checkOrder"></vue-numeric-input>
            </p>
            <div class="d-grid gap-2 d-md-flex">
              <h5>Total Price = [{{ this.printingMethodPrice | currency('RM') }}+{{ this.presetCustomTee.price | currency('RM') }}]*{{ this.orderQty }} = {{ ((parseFloat(this.printingMethodPrice)+parseFloat(this.presetCustomTee.price))*this.orderQty) | currency('RM') }}</h5>
            </div>
            <ul>
              <li class="text-danger" v-for="error in orderErrors" :key="error">{{ error }}</li>
            </ul>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <button class="btn btn-dark me-4" type="button">Add to cart</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Vue2Filters from "vue2-filters";
import VueNumericInput from "vue-numeric-input";

export default {
  components: {
    VueNumericInput,
  },
  data() {
    return {
      selectedSize: "",
      selectedPrintingMethod: "",
      displayMinimumOrder: "",
      minimumOrder: "",
      presetCustomTee: "",
      orderQty: 1,
      ttlPrice: 0.0,
      printingMethodPrice: 0.0,
      availableSizes: [],
      availablePrintingMethods: [],
      orderErrors: [],
    };
  },
  mixins: [Vue2Filters.mixin],
  created() {
    axios
      .get(`/api/getOnePresetDesign/${this.$route.params.id}`)
      .then((response) => {
        this.presetCustomTee = response.data[0];

        axios
          .get(`/api/getAvailableSize/${this.presetCustomTee.pt_type_color_id}`)
          .then((response) => {
            this.availableSizes = response.data;
          });
        axios.post(`/api/getAvailablePrintingMethods`).then((response) => {
          this.availablePrintingMethods = response.data;
        });
      });
  },
  mounted() {},

  methods: {
    showMinimumOrder() {
      this.availablePrintingMethods.forEach((item) => {
        if (item.p_method_id === this.selectedPrintingMethod) {
          this.displayMinimumOrder = "minimum order- " + item.minimum_order;
          this.minimumOrder = item.minimum_order;
          this.printingMethodPrice = item.price;
        }
      });
    },
    checkOrder() {
      this.orderErrors = [];
      if (this.selectedPrintingMethod == "") {
        this.orderErrors.push("Please select a printing method");
      }

      if (this.selectedSize == "") {
        this.orderErrors.push("Please select a size");
      }

      if(this.orderQty < this.minimumOrder){
        this.orderErrors.push("Order quantity cannot smaller than minimum order");
      }

    },
  },
  computed: {},
};
</script>