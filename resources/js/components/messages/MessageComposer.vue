<template>
  <div class="pa-3" style="border-top:1px solid #f1f1f1;">
    <v-text-field
      autofocus
      v-model="message"
      @keydown.enter="send"
      outlined
      single-line
      hide-details
      dense
      append-icon="mdi-send"
      placeholder="Enter your message"
      @click:append="send"
      flat
    ></v-text-field>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: ""
    };
  },
  methods: {
    send(e) {
      e.preventDefault();
      if (this.message == "") {
        return;
      }
      this.$emit("send", this.message);
      this.message = "";
    }
  }
};
</script>