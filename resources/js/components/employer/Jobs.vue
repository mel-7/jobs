<template>
  <div>
      This is Jobs
  </div>
</template>

<script>
export default {
 name: "Account",
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
