
<template>
  <div>
    <ul class="nav justify-content-center">
      <li class="nav-item">
        <router-link
          class="nav-link fw-bold text-dark fs-5"
          :to="{name:'design-price'}"
        >View Customer Selling Design</router-link>
      </li>
      <li class="nav-item">
        <router-link
          class="nav-link text-muted fs-5"
          :to="{name:'design-free'}"
        >View Customer Sharing Design</router-link>
      </li>
    </ul>
    <hr />
    <div class="container p-2 mb-2">
      <div class="title-head">
        <p class="h2">All Customer Selling Design</p>
      </div>
    </div>
    <div class="pt-2 pb-5">
      <div class="container p-2">
        <div class="row mb-md-2">
          <div
            v-for="publishedDesignSelling in publishedDesignsSelling"
            :key="publishedDesignSelling.p_design_id"
            class="col-md-6 col-lg-5"
          >
            <div class="card shadow p-3 mb-2 bg-body border-0 rounded">
              <div class="row">
                <div class="col-6 ps-1 pe-0">
                  <img
                    :src="require('@assets/publishedDesign/'+publishedDesignSelling.front_design_img)"
                    class="card-img-top"
                    alt="image"
                  />
                </div>
                <div class="col-6 ps-0 pe-1">
                  <img
                    :src="require('@assets/publishedDesign/'+publishedDesignSelling.back_design_img)"
                    class="card-img-top"
                    alt="image"
                  />
                </div>
              </div>

              <div class="card-body">
                <h5 class="fw-bold">{{ publishedDesignSelling.name }}</h5>
                <em class="text-muted">design by {{ publishedDesignSelling.cus_name }}</em>
                <div class="d-flex mb-4">
                  <div class="col pt-4">
                    <span
                      class="h4 text-dark fw-bold"
                    >{{ publishedDesignSelling.price | currency('RM') }}</span>
                  </div>
                  <div class="col text-center">
                    <button
                      class="btn btn-outline-dark"
                      data-bs-toggle="modal"
                      data-bs-target="#showDescDetails"
                      @click="showDetail(publishedDesignSelling)"
                    >View Details</button>
                  </div>
                </div>
                <div
                  class="d-flex justify-content-end"
                  v-if="(authStatus && (publishedDesignSelling.cus_id != authCus.cus_id)) && !publishedDesignSelling.has_this_design"
                >
                  <div class="d-inline p-2">
                    <button type="button" class="btn btn-dark">Add to Cart</button>
                  </div>
                  <div class="d-inline p-2">
                    <button
                      type="button"
                      class="btn btn-danger"
                      data-bs-toggle="modal"
                      data-bs-target="#showReportForm"
                      @click="initReportForm(publishedDesignSelling)"
                    >Report Design</button>
                  </div>
                </div>
                <p
                  v-if="publishedDesignSelling.has_this_design"
                >This design has been purchased by you</p>
                <p
                  v-if="publishedDesignSelling.cus_id == authCus.cus_id"
                >This design is selling by you</p>
              </div>
            </div>
          </div>
        </div>
        <div class="ms-2" v-if="publishedDesignsSelling.length == 0">
          <span>Does not have any selling design on publish</span>
        </div>
      </div>
    </div>
    <!-- showDescDetails start modal -->
    <div
      class="modal fade"
      id="showDescDetails"
      tabindex="-1"
      aria-labelledby="showDescDetails"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title fw-bold" id="exampleModalCenterTitle">
              {{ showDetails.name }}
              <span class="fst-italic">by {{ showDetails.seller_name }}</span>
            </h4>
            <button
              ref="btnClose"
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <h5 class="fw-bold text-decoration-underline">Design Description</h5>
            <p>{{ showDetails.description }}</p>
          </div>
        </div>
      </div>
    </div>
    <!-- showDescDetails end modal -->

    <!-- showReportForm start modal -->
    <div
      class="modal fade"
      id="showReportForm"
      tabindex="-1"
      aria-labelledby="showReportForm"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Report Design Form</h5>
            <button
              ref="btnClose"
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <p>Design Name : {{ reportForm.designName }}</p>
            <p>Design by {{ reportForm.author }}</p>
            <form>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Report Title:</label>
                <input
                  type="text"
                  v-model="reportForm.title"
                  class="form-control"
                  id="report-title"
                />
                <span
                  class="text-danger"
                  v-if="reportErrors['reportForm.title']"
                >{{ reportErrors['reportForm.title'][0] }}</span>
              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Report Description:</label>
                <textarea class="form-control" v-model="reportForm.description" id="report-text"></textarea>
                <span
                  class="text-danger"
                  v-if="reportErrors['reportForm.description']"
                >{{ reportErrors['reportForm.description'][0] }}</span>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="submitReportForm">Submit Report</button>
          </div>
        </div>
      </div>
    </div>
    <!-- showReportForm end modal -->
  </div>
</template>

<script>
import { mapState } from "pinia";
import Vue2Filters from "vue2-filters";
import { useAuthStore } from "../../store/auth";
export default {
  data() {
    return {
      publishedDesignsSelling: [],
      showDetails: {
        name: "",
        seller_name: "",
        description: "",
      },
      reportForm: {
        author: "",
        designName: "",
        title: "",
        description: "",
        cusID: "",
        pDesignID: "",
      },
      reportErrors: [],
    };
  },
  mixins: [Vue2Filters.mixin],
  created() {
    this.getPublishedDesignsOnSelling();
  },
  mounted() {},
  methods: {
    getPublishedDesignsOnSelling() {
      axios
        .post("/api/getPublishedDesignsOnSelling", {
          cusID: this.authCus.cus_id,
        })
        .then((response) => {
          this.publishedDesignsSelling = response.data;
        });
    },
    showDetail(publishedDesignSelling) {
      this.showDetails.name = publishedDesignSelling.name;
      this.showDetails.seller_name = publishedDesignSelling.cus_name;
      this.showDetails.description = publishedDesignSelling.description;
    },

    initReportForm(publishedDesignSelling) {
      this.reportForm.author = publishedDesignSelling.cus_name;
      this.reportForm.designName = publishedDesignSelling.name;
      this.reportForm.title = "";
      this.reportForm.description = "";
      this.reportForm.cusID = this.authCus.cus_id;
      this.reportForm.pDesignID = publishedDesignSelling.p_design_id;
    },
    submitReportForm() {
      axios
        .post("/api/reportPublishedDesign", {
          reportForm: this.reportForm,
        })
        .then((response) => {
          if (response.data.isValid) {
            swal("Successfully submit design reporting for admin review", {
              icon: "success",
            }).then(() => {
              this.$refs.btnClose.click();
            });
          } else {
            swal("Unsuccess submit design reporting due to server error", {
              icon: "error",
            }).then(() => {
              this.$refs.btnClose.click();
            });
          }
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.reportErrors = error.response.data.errors;
          }
        });
    },
  },
  computed: {
    ...mapState(useAuthStore, ["authCus", "authStatus"]),
  },
};
</script>