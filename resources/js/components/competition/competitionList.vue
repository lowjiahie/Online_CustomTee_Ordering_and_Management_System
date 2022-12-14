<template>
  <div>
    <div class="container p-2 mb-1">
      <div class="title-head">
        <p class="h2">Competition List</p>
      </div>
    </div>
    <div class="pt-2 pb-5">
      <div class="container p-2">
        <div class="row mb-md-2">
          <div
            v-for="competition in competitionList"
            :key="competition.competition_id"
            class="col-md-6 col-lg-4"
          >
            <div class="card shadow p-3 mb-2 bg-body border-0 rounded">
              <div class="card-body pb-0">
                <h5
                  class="fw-bold"
                >{{ competition.topic }}</h5>
                <em class="text-muted">{{ competition.description }}</em>
                <br /><br />
                Rules:
                <em class="text-muted">{{ competition.rules }}</em>
                <br /><br />
                <em class="text-muted">
                  {{ competition.start_date_time }}
                  &nbsp to &nbsp
                  {{ competition.end_date_time }}
                </em>
                <br /><br />
                <p
                  v-if="competition.winner != null"
                >
                  Winner:
                  <em class="text-muted">{{ competition.winner }}</em>
                </p>
                <p
                  v-else
                >
                  <button type="button" class="btn btn-dark" @click="participate">Participate</button>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "pinia";
import { useAuthStore } from "../../store/auth";
import Vue2Filters from "vue2-filters";
import { useLastDesignStore } from "../../store/lastDesign";
export default {
  data() {
    return {
      competitionList: [],
    };
  },
  mixins: [Vue2Filters.mixin],
  mounted() {
    this.getAllCompetition();
  },
  methods: {
    ...mapActions(useLastDesignStore, ["editEmptyCustomTeeDesign"]),
    getAllCompetition() {
      axios.post("/api/getCompetitionList").then((response) => {
        this.competitionList = response.data;
      });
    },
    participate(){
      this.$router.push({ name: "myDesign"});
    },

  },
  computed: {
    ...mapState(useAuthStore, ["authStatus"]),
  },
};
</script>
