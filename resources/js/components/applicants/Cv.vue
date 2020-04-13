<template>
  <div class="col-md-8">
    <v-card class="mx-auto pa-5" width="100%">
      <personal-details class="my-5"></personal-details>
      <v-divider></v-divider>
      <work-experience class="my-5"></work-experience>
    </v-card>
  </div>
</template>

<script>
export default {
  name: "Cv"
};
</script>

<style lang="css" scoped>
.border-bottom {
  border-bottom: 2px solid;
}
</style>
