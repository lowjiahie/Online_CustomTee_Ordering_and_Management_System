<template></template>

<script>
export default {
  data() {
    return {
        orderDetails:[],
    };
  },
  created() {
    axios
      .get(`/api/getOnePresetDesign/${this.$route.params.id}`)
      .then((response) => {
      });
  },
  methods: {},
  computed: {},
};
</script>

<style>
</style>