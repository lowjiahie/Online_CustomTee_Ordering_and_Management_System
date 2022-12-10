
<template>
  <div>
    <div class="container p-2 mb-1">
      <div class="title-head">
        <p class="h2">All Plain-Tee</p>
      </div>
    </div>
    <div class="pt-2 pb-5">
      <div class="container p-2">
        <div class="row mb-md-2">
          <div
            v-for="presetCustomTeeDesign in presetCustomTeeDesigns"
            :key="presetCustomTeeDesign.c_tee_design_id"
            class="col-md-6 col-lg-4"
          >
            <div class="card shadow p-3 mb-2 bg-body border-0 rounded">
              <img
                :src="require('@assets/plainTee/'+presetCustomTeeDesign.plain_tee_img)"
                class="card-img-top"
                alt="image"
              />
              <div class="card-body pb-0">
                <h5
                  class="fw-bold"
                >{{ presetCustomTeeDesign.type_name }} {{ presetCustomTeeDesign.material }} ({{ presetCustomTeeDesign.color_name }})</h5>
                <em class="text-muted">{{ presetCustomTeeDesign.description }}</em>
                <br />
                <em class="text-muted">{{ presetCustomTeeDesign.detail }}</em>
                <div class="d-flex mb-4 pt-3">
                  <div class="col-5">
                    <span
                      class="h4 text-dark fw-bold"
                    >{{ presetCustomTeeDesign.price | currency('RM') }}</span>
                  </div>
                  <div class="col-7 text-center pt-4">
                    <button type="button" class="btn btn-dark" @click="createDesign(presetCustomTeeDesign)">Create Design</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState,mapActions } from "pinia";
import { useAuthStore } from "../../store/auth";
import Vue2Filters from "vue2-filters";
import { useLastDesignStore } from "../../store/lastDesign";
export default {
  data() {
    return {
      presetCustomTeeDesigns: [],
    };
  },
  mixins: [Vue2Filters.mixin],
  mounted() {
    this.getPlainTeeTypeColor();
  },
  methods: {
    ...mapActions(useLastDesignStore, ["editEmptyCustomTeeDesign"]),
    getPlainTeeTypeColor() {
      axios.post("/api/getPlainTeeTypeColor").then((response) => {
        this.presetCustomTeeDesigns = response.data;
      });
    },
    createDesign(presetCustomTeeDesign) {
      if (!this.authStatus) {
        swal({
          title: "Unauthorized",
          text: "You are require to login to perform create design function!",
          icon: "warning",
          button: "OK",
        });
        return;
      }
      this.editEmptyCustomTeeDesign(presetCustomTeeDesign);
    },
  },
  computed: {
    ...mapState(useAuthStore, ["authStatus"]),
  },
};
</script>