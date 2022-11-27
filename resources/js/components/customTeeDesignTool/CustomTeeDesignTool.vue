<template>
  <div class="container-fluid text-center">
    <div class="row">
      <div class="col col-lg-3 text-bg-primary">1 of 3</div>
      <div class="col text-bg-secondary">
        Variable width content12312312312
        xretdxtrctrxcrtxtrxrtxrtxrtxtrxrtxrtxtrrx
        hfufuyfuyfyfuyfyufuyfuyfyuffffffffffffffff
        tdtdytdytdtydtdytdytdtydytytd
        </div>
      <div class="col col-lg-6 text-bg-warning">3 of 3</div>
    </div>
  </div>
</template>
<script>
import router from "../../routes";
export default {
  data() {
    return {
      customTee:[],
    };
  },
  created() {
    this.customTee = this.$route.params.customTee
    console.log(this.customTee);
  },
  methods: {},
};
</script>