<template>
  <div class="col-12">
    <Messages :user-data="user"/>
  </div>
</template>

<script>
import Messages from '../Messages'
export default {
  props: {
    user: Object,
    default: null
  },
  components: {
      Messages
  }
};
</script>
