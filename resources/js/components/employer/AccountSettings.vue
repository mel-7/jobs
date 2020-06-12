<template>
  <div class="col-md-8 mx-auto">
    <account-settings-form :user="user"/>
  </div>
</template>

<script>
export default {
 name: "AccountSettings",
  props: {
    user: Object,
    default: null
  },
  data() {
      return {

      }
  },
  mounted(){
      console.log(this.user)
  }
}
</script>
