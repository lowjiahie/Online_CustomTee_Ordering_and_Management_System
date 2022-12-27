<template>
  <div class="container-fuild">
    <h1>My Designs</h1>
    <hr />
    <div class="d-flex align-items-start">
      <div
        class="nav flex-column nav-pills me-3 border"
        id="v-pills-tab"
        role="tablist"
        aria-orientation="vertical"
      >
        <button
          ref="pillTeeDesign"
          class="nav-link active"
          id="preset-custom-tee-design-tab"
          data-bs-toggle="pill"
          data-bs-target="#v-pills-tee-design"
          type="button"
          role="tab"
          @click="getPresetDesigns"
          aria-controls="v-pills-tee-design"
          aria-selected="true"
        >My Preset Custom-Tee Design</button>
        <button
          ref="pillShareSoldDesign"
          class="nav-link"
          id="sold-design"
          data-bs-toggle="pill"
          data-bs-target="#v-pills-share-sold-design"
          type="button"
          role="tab"
          @click="getPublishDesignWithStatus('pending')"
          aria-controls="v-pills-share-sold-design"
          aria-selected="false"
        >My Share/Sold Design</button>
        <button
          ref="pillSavedPurchasedDesign"
          class="nav-link"
          id="saved-purchased-design"
          data-bs-toggle="pill"
          data-bs-target="#v-pills-saved-purchased-design"
          type="button"
          role="tab"
          aria-controls="v-pills-saved-purchased-design"
          aria-selected="false"
          @click="getSavedPurchasedDesigns"
        >My Saved/Purchased Design</button>
        <button
          ref="pillCompetitionDesign"
          class="nav-link"
          id="competition-design"
          data-bs-toggle="pill"
          data-bs-target="#v-pills-competition-design"
          type="button"
          role="tab"
          aria-controls="v-pills-competition-design"
          aria-selected="false"
        >My Competition Design</button>
      </div>
      <div class="tab-content" id="v-pills-tabContent">
        <div
          class="tab-pane fade show active"
          id="v-pills-tee-design"
          role="tabpanel"
          aria-labelledby="v-pills-tee-design"
        >
          <h4 class="fw-bold">My Preset Custom-Tee Designs</h4>
          <div v-if="presetCustomTeeDesigns.length">
            <div
              class="card mb-3"
              style="max-width: 900px;"
              v-for="presetCustomTeeDesign in presetCustomTeeDesigns"
              :key="presetCustomTeeDesign.c_tee_design_id"
            >
              <div class="row g-0">
                <div class="col-md-4">
                  <img
                    :src="getImgUrl(presetCustomTeeDesign.front_design_img)"
                    class="img-fluid rounded-start"
                  />
                </div>
                <div class="col-md-4">
                  <img
                    :src="getImgUrl(presetCustomTeeDesign.back_design_img)"
                    class="img-fluid rounded-start"
                  />
                </div>
                <div class="col-md-4">
                  <div class="card-body pe-0">
                    <h5 class="card-title fw-bold mb-3">{{presetCustomTeeDesign.name}}</h5>
                    <p class="card-text mb-1">
                      <b class="text-dark">Product:</b>
                      {{presetCustomTeeDesign.type_name}} {{presetCustomTeeDesign.material}} | {{presetCustomTeeDesign.detail}} | {{presetCustomTeeDesign.color_name}}
                    </p>
                    <p class="card-text mb-1">
                      <b class="text-dark">PlainTee Price:</b>
                      {{ presetCustomTeeDesign.price | currency('RM') }}
                    </p>
                    <p class="card-text mb-1">
                      <b class="text-dark">Saved On:</b>
                      {{convertToLocalDateTime(presetCustomTeeDesign.updated_at)}}
                    </p>
                    <div class="row mt-3">
                      <div class="col-6">
                        <button
                          type="button"
                          class="btn btn-link ps-0"
                          @click.prevent="editCustomTeeDesign(presetCustomTeeDesign.c_tee_design_id)"
                        >Edit Design</button>
                      </div>
                      <div class="col-6">
                        <button
                          type="button"
                          class="btn btn-link text-danger ps-0"
                          @click="deletePresetDesign(presetCustomTeeDesign)"
                        >Delete Design</button>
                      </div>
                    </div>
                    <div class="d-grid gap-2 col-11 mx-auto mt-2">
                      <button
                        type="button"
                        class="btn btn-dark"
                        @click="redirectToOrderComponent(presetCustomTeeDesign.c_tee_design_id)"
                      >Order this Custom-Tee</button>
                      <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModalCenter"
                        @click="setAllInput(presetCustomTeeDesign)"
                      >Share/Sell Design</button>
                      <button
                        type="button"
                        class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleCompetition"
                        @click="submitCompetition"
                      >Submit to Competition</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div
          class="tab-pane fade"
          id="v-pills-share-sold-design"
          role="tabpanel"
          aria-labelledby="v-pills-share-sold-design"
        >
          <h4 class="fw-bold">My Share/Sold Designs</h4>
          <div class="d-grid gap-2 ms-1 d-md-block mb-3">
            <button
              class="btn btn-dark"
              type="button"
              @click="getPublishDesignWithStatus('pending')"
            >Pending</button>
            <button
              class="btn btn-dark"
              type="button"
              @click="getPublishDesignWithStatus('published')"
            >Published</button>
            <button
              class="btn btn-dark"
              type="button"
              @click="getPublishDesignWithStatus('banned')"
            >Banned</button>
          </div>
          <div
            class="card mb-3"
            style="max-width: 900px;"
            v-for="publishedDesign in publishedDesigns"
            :key="publishedDesign.p_design_id"
          >
            <div class="row g-0">
              <div class="col-md-4">
                <img
                  :src="require('@assets/publishedDesign/'+publishedDesign.front_design_img)"
                  class="img-fluid rounded-start"
                />
              </div>
              <div class="col-md-4">
                <img
                  :src="require('@assets/publishedDesign/'+publishedDesign.back_design_img)"
                  class="img-fluid rounded-start"
                />
              </div>
              <div class="col-md-4">
                <div class="card-body pe-0">
                  <h5 class="card-title fw-bold mb-3">{{publishedDesign.name}}</h5>
                  <p class="card-text mb-2">
                    <b class="text-dark">Design Description:</b>
                    <br />
                    {{publishedDesign.description}}
                  </p>
                  <p class="card-text mb-1">
                    <b class="text-dark">Design Price:</b>
                    {{ checkIsFree(publishedDesign.price) }}
                  </p>
                  <p class="card-text mb-1">
                    <b class="text-dark">Publish Type:</b>
                    {{ publishedDesign.type }}
                  </p>
                  <p class="card-text mb-1">
                    <b class="text-dark">Publish Status:</b>
                    <span
                      class="fw-bold text-uppercase text-decoration-underline"
                    >{{ publishedDesign.status }}</span>
                  </p>
                  <p class="card-text mb-1">
                    <b class="text-dark">Published On:</b>
                    {{convertToLocalDateTime(publishedDesign.updated_at)}}
                  </p>
                  <p class="card-text mb-1" v-if="publishedDesign.status == 'banned'">
                    <b class="text-dark">Reason Banned:</b>
                    <span class="text-danger">{{ publishedDesign.reason_banned_denied }}</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="ms-2" v-if="publishedDesigns.length == 0">
            <span>
              Does not have publish design record with
              <b class="text-uppercase">{{ status }}</b> status
            </span>
          </div>
        </div>
        <div
          class="tab-pane fade"
          id="v-pills-saved-purchased-design"
          role="tabpanel"
          aria-labelledby="v-pills-saved-purchased-design"
        >
          <h4 class="fw-bold">My Saved Designs</h4>
          <div
            class="card mb-3"
            style="max-width: 900px;"
            v-for="savedOrPurchasedDesign in savedOrPurchasedDesigns"
            :key="savedOrPurchasedDesign.p_design_id"
          >
            <div class="row g-0">
              <div class="col-md-4">
                <img
                  :src="require('@assets/publishedDesign/'+savedOrPurchasedDesign.front_design_img)"
                  class="img-fluid rounded-start"
                />
              </div>
              <div class="col-md-4">
                <img
                  :src="require('@assets/publishedDesign/'+savedOrPurchasedDesign.back_design_img)"
                  class="img-fluid rounded-start"
                />
              </div>
              <div class="col-md-4">
                <div class="card-body pe-0">
                  <h5 class="card-title fw-bold mb-2">{{savedOrPurchasedDesign.name}}</h5>
                  <em class="text-muted mb-3">design by {{ savedOrPurchasedDesign.cus_name }}</em>
                  <p class="card-text mt-2 mb-2">
                    <b class="text-dark">Design Description:</b>
                    <br />
                    {{savedOrPurchasedDesign.description}}
                  </p>
                  <p class="card-text mb-1">
                    <b class="text-dark">Design Price:</b>
                    {{ checkIsFree(savedOrPurchasedDesign.price) }}
                  </p>
                  <p class="card-text mb-2">
                    <b class="text-dark">Publish Status:</b>
                    <span
                      class="fw-bold text-uppercase text-decoration-underline"
                    >{{ savedOrPurchasedDesign.status }}</span>
                  </p>
                  <p
                    class="card-text mb-1"
                    v-if="savedOrPurchasedDesign.reason_banned_denied != null"
                  >
                    <b class="text-dark">Reason Banned:</b>
                    {{ savedOrPurchasedDesign.reason_banned_denied }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div
          class="tab-pane fade"
          id="v-pills-competition-design"
          role="tabpanel"
          aria-labelledby="v-pills-competition-design"
        >
          <h4 class="fw-bold">Competition-design</h4>
          <div
            class="card mb-3"
            style="max-width: 900px;"
            v-for="competitionDesign in myCompetitionDesigns"
            :key="competitionDesign.competition_id"
          >
            <div class="row g-0">
              <div class="col-md-4">
                <img
                  :src="getMyDesign(competitionDesign.front_design_img)"
                  class="img-fluid rounded-start"
                />
              </div>
              <div class="col-md-4">
                <img
                  :src="getMyDesign(competitionDesign.back_design_img)"
                  class="img-fluid rounded-start"
                />
              </div>
              <div class="col-md-4">
                <div class="card-body pe-0">
                  <h5 class="card-title fw-bold mb-3">{{competitionDesign.topic}}</h5>
                  <p class="card-text mb-1">
                    <b class="text-dark">Description:</b>
                    {{competitionDesign.description}}
                  </p>
                  <p class="card-text mb-1">
                    <b class="text-dark">Rules:</b>
                    {{competitionDesign.rules}}
                  </p>
                  <p class="text-muted">
                    <b class="text-dark">Competition Time:</b>
                    {{ competitionDesign.start_date_time }}  to  {{ competitionDesign.end_date_time }}
                  </p>
                  <div class="d-grid gap-2 col-11 mx-auto mt-2">
                    <button
                      type="button"
                      class="btn btn-primary"
                      @click="withdraw(competitionDesign.competition_id)"
                    >Withdraw</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- share/sell form start modal -->
    <div
      class="modal fade"
      id="exampleModalCenter"
      tabindex="-1"
      aria-labelledby="exampleModalCenterTitle"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Share/Sell Design</h5>
            <button
              ref="btnClose"
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
              @click="resetAllInput"
            ></button>
          </div>
          <div class="modal-body">
            <div class="container">
              <label for="formPublish" class="form-label">
                Fill in all the information below for
                <b>Share/Sell</b> your design
              </label>
              <div class="row mb-3">
                <div class="col-auto">
                  <label for="lbl-type" class="col-form-label">Previous Design Name</label>
                </div>
                <div class="col-auto">
                  <span class="form-control text-secondary">{{ generalName }}</span>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-auto">
                  <label for="lbl-type" class="col-form-label">Published Design Name</label>
                </div>
                <div class="col-auto">
                  <input
                    type="text"
                    v-model="publishedDesignForm.name"
                    class="form-control"
                    :class="checkNameIsValid"
                  />
                  <span
                    class="text-danger"
                    v-if="publishedErrors['publishedDesignForm.name']"
                  >{{ publishedErrors['publishedDesignForm.name'][0] }}</span>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-auto">
                  <label for="inputPrice" class="col-form-label">Price</label>
                </div>
                <div class="col-auto">
                  <money
                    v-model="publishedDesignForm.price"
                    class="form-control"
                    v-bind="money"
                    @input="checkType"
                  ></money>
                </div>
                <div class="col-auto mt-2 ps-0">
                  <span
                    id="priceHelpInline"
                    class="form-text"
                  >Set RM 0.00 for share as free, set greater than RM 0.00 for sell</span>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-auto">
                  <label for="lbl-type" class="col-form-label">Type</label>
                </div>
                <div class="col-auto">
                  <input
                    type="text"
                    v-model="publishedDesignForm.type"
                    class="form-control"
                    :disabled="true"
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-auto">
                  <label for="lbl-desc" class="col-form-label">Description</label>
                </div>
                <div class="col-auto">
                  <textarea
                    class="form-control"
                    :class="checkDescIsValid"
                    v-model="publishedDesignForm.description"
                    rows="4"
                    cols="50"
                    placeholder="--enter your design description here--"
                  ></textarea>
                  <span
                    class="text-danger"
                    v-if="publishedErrors['publishedDesignForm.description']"
                  >{{ publishedErrors['publishedDesignForm.description'][0] }}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-primary"
              @click="publishDesignToSharingSection"
            >Publish</button>
          </div>
        </div>
      </div>
    </div>
    <!-- share/sell form end modal -->

    <!-- submit to competition form start modal -->
    <div
      class="modal fade"
      id="exampleCompetition"
      tabindex="-1"
      aria-labelledby="exampleCompetition"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleCompetition">Submit To Competition</h5>
            <button
              ref="btnClose"
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
              @click="getCurrentCompetition"
            ></button>
          </div>
          <div class="modal-body">
            <div class="container">
              <label for="formPublish" class="form-label">
                Select a competition to
                <b>submit</b> your design
              </label>
              <div class="row mb-3">
                <div class="col-auto">
                  <label for="lbl-type" class="col-form-label">Select competition</label>
                </div>
                <div class="col-auto">
                  <select v-model="selected">
                    <option
                      v-for="competition in currentCompetitions"
                      :key="competition.competition_id"
                      :value="competition.competition_id"
                    >{{ competition.topic }}</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="submitCompetition">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.tab-pane {
  height: 400px;
  overflow-y: auto;
  overflow-x: hidden;
  width: 100%;
}
.nav-link.active {
  background-color: #343a40;
  color: #fff;
}
.nav-link {
  color: #161c2d;
}
</style>
<script>
import { mapState } from "pinia";
import { useAuthStore } from "../../store/auth";
import Vue2Filters from "vue2-filters";
import { mapActions } from "pinia";
import { useLastDesignStore } from "../../store/lastDesign";
import { Money } from "v-money";

export default {
  components: { Money },
  data() {
    return {
      presetCustomTeeDesigns: [],
      savedOrPurchasedDesigns: [],
      publishedDesigns: [],
      soldDesigns: null,
      competitionDesigns: null,
      loading: false,
      checkNameIsValid: "",
      checkDescIsValid: "",
      errorMsg: "",
      generalName: "",
      publishedErrors: [],
      status: "pending",
      currentCompetitions: [],
      myCompetitionDesigns: [],
      money: {
        decimal: ".",
        thousands: ",",
        prefix: "RM ",
        suffix: "",
        precision: 2,
        masked: false,
      },
      publishedDesignForm: {
        name: null,
        description: null,
        price: 0.0,
        status: "pending",
        reasonBanned: null,
        type: "share",
        frontDesignImg: null,
        backDesignImg: null,
        frontDesignJson: null,
        backDesignJson: null,
        cusID: "",
      },
      competitionForm: {
        competition_id: null,
        cus_id: null,
        status: "participated",
        front_design_img: null,
        back_design_img: null,
      },
    };
  },
  mixins: [Vue2Filters.mixin],
  mounted() {
    this.getPresetDesigns();
    this.getCurrentCompetition();
    this.getMyCompetitionDesign();
  },
  methods: {
    ...mapActions(useLastDesignStore, ["editCustomTeeDesign"]),
    convertToLocalDateTime(datetime) {
      let cvtDateTime = datetime.replace(/T/, " ").replace(/\..+/, "");
      return cvtDateTime;
    },
    getPresetDesigns() {
      axios
        .post("/api/getPresetDesign", {
          cusID: this.authCus.cus_id,
        })
        .then((response) => {
          this.presetCustomTeeDesigns = response.data;
        });
    },
    deletePresetDesign(presetCustomTeeDesign) {
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to delete this preset custom-tee design?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((confirmUpdate) => {
        if (confirmUpdate) {
          axios
            .post("/api/deletePresetDesign", {
              customTee_id: presetCustomTeeDesign.c_tee_design_id,
              front_img: presetCustomTeeDesign.front_design_img,
              back_img: presetCustomTeeDesign.back_design_img,
            })
            .then((response) => {
              if (response.data.isValid) {
                swal(
                  "Success Delete",
                  "Successfully deleted " +
                    presetCustomTeeDesign.c_tee_design_id +
                    " preset custom-tee design!!",
                  "success"
                );
                const index = this.presetCustomTeeDesigns.findIndex(
                  (p) =>
                    p.c_tee_design_id === presetCustomTeeDesign.c_tee_design_id
                );
                this.presetCustomTeeDesigns.splice(index, 1);
              } else {
                swal(
                  "Failed Delete",
                  "Unsuccessfully deleted " +
                    presetCustomTeeDesign.c_tee_design_id +
                    " preset custom-tee design!!",
                  "error"
                );
              }
            });
        }
      });
    },
    getImgUrl(img) {
      return require("@assets/customTee/" + img);
    },
    checkType() {
      this.publishedDesignForm.type =
        this.publishedDesignForm.price > 0 ? "sell" : "share";
    },
    publishDesignToSharingSection() {
      if (this.publishedDesignForm.description) {
        this.publishedDesignForm.description =
          this.publishedDesignForm.description.trim();
      }
      if (this.publishedDesignForm.name) {
        this.publishedDesignForm.name = this.publishedDesignForm.name.trim();
      }

      axios
        .post("/api/publishDesign", {
          publishedDesignForm: this.publishedDesignForm,
        })
        .then((response) => {
          if (response.data.isValid) {
            this.checkNameIsValid = "is-valid";
            this.checkDescIsValid = "is-valid";
            this.publishedErrors = "";
            setTimeout(() => {
              swal(
                "Success Publish Design",
                "Successfully publish design on pending!!",
                "success"
              ).then(() => {
                this.$refs.btnClose.click();
                // this.$refs.pillShareSoldDesign.click();
              });
            }, 500);
          } else {
            swal(
              "Failed Publish Design",
              "Unsuccessfully publish design!!",
              "error"
            );
          }
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.publishedErrors = error.response.data.errors;
            this.checkNameIsValid = this.publishedErrors[
              "publishedDesignForm.name"
            ]
              ? "is-invalid"
              : "is-valid";
            this.checkDescIsValid = this.publishedErrors[
              "publishedDesignForm.description"
            ]
              ? "is-invalid"
              : "is-valid";
          }
        });
    },
    setAllInput(presetCustomTeeDesign) {
      this.checkNameIsValid = "";
      this.checkDescIsValid = "";
      this.publishedErrors = "";
      this.generalName = presetCustomTeeDesign.name;
      this.publishedDesignForm.name = null;
      this.publishedDesignForm.description = null;
      this.publishedDesignForm.price = 0.0;
      this.publishedDesignForm.type = "share";
      this.publishedDesignForm.frontDesignImg =
        presetCustomTeeDesign.front_design_img;
      this.publishedDesignForm.backDesignImg =
        presetCustomTeeDesign.back_design_img;
      this.publishedDesignForm.frontDesignJson =
        presetCustomTeeDesign.front_design_json;
      this.publishedDesignForm.backDesignJson =
        presetCustomTeeDesign.back_design_json;
      this.publishedDesignForm.cusID = presetCustomTeeDesign.cus_id;
    },
    resetAllInput() {
      this.publishedDesignForm.name = "";
      this.publishedDesignForm.description = null;
      this.publishedDesignForm.price = 0.0;
      this.publishedDesignForm.type = "share";
      this.publishedDesignForm.frontDesignJson = "";
      this.publishedDesignForm.backDesignJson = "";
      this.publishedDesignForm.cusID = "";
    },
    getPublishDesignWithStatus(status) {
      this.publishedDesigns = [];
      this.status = status;
      axios
        .post("/api/getPublishDesignWithStatus", {
          status: status,
          cusID: this.authCus.cus_id,
        })
        .then((response) => {
          this.publishedDesigns = response.data;
        });
    },
    checkIsFree(price) {
      return parseFloat(price) > 0 ? "RM " + price : "Free";
    },
    getSavedPurchasedDesigns() {
      axios
        .post("/api/getSavedPurchasedDesigns", {
          cusID: this.authCus.cus_id,
        })
        .then((response) => {
          this.savedOrPurchasedDesigns = response.data;
        });
    },
    redirectToOrderComponent(id) {
      this.$router.push({ name: "order", params: { id } });
    },
    getCurrentCompetition() {
      axios
        .post("/api/getCurrentCompetition", {
          cusID: this.authCus.cus_id,
        })
        .then((response) => {
          this.currentCompetitions = response.data;
        });
    },
    submitCompetition() {
      this.competitionForm.competition_id = competition.competition_id;
      this.competitionForm.cus_id = this.authCus.cus_id;
      this.competitionForm.front_design_img =
        publishedDesignForm.front_design_img;
      this.competitionForm.back_design_img =
        publishedDesignForm.back_design_img;

      axios
        .post("/api/submitCompetition", {
          competitionForm: this.competitionForm,
        })
        .then((response) => {
          if (response.data.isValid) {
            setTimeout(() => {
              swal(
                "Success submit",
                "Successfully submit design to competition!",
                "success"
              ).then(() => {
                this.$refs.btnClose.click();
              });
            }, 500);
          } else {
            swal(
              "Failed submit",
              "Unsuccessfully submit design to the competition " +
                competition.competition_id,
              "error"
            );
          }
        });
    },
    getMyCompetitionDesign() {
      axios
        .post("/api/getMyCompetitionDesign", {
          cusID: this.authCus.cus_id,
        })
        .then((response) => {
          this.myCompetitionDesigns = response.data;
        });
    },
    getMyDesign(img) {
      return require("@assets/competition/" + img);
    },
    withdraw(competition_id) {
      axios
        .post("/api/withdrawCompetition", {
          cusID: this.authCus.cus_id,
          competitionID: competition_id,
        })
        .then((response) => {
          if (response.data.isValid) {
            swal(
              "Withdraw success",
              "You have successfully withdraw from competition",
              "success"
            );
          } else {
            swal("Withdraw failed", "The competition have ended", "error");
          }

          location.reload();
        });
    },
  },
  computed: {
    ...mapState(useAuthStore, ["authCus"]),
  },
};
</script>
