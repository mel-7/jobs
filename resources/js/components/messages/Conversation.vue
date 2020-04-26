<template>
  <div>
    <h3
      class="pa-3"
      style="border-bottom:1px solid #f1f1f1;"
    >{{ contact ? contact.name : 'Select a Contact' }}</h3>
    <MessageFeed :contact="contact" :messages="messages" />
    <MessageComposer v-if="contact" @send="sendMessage" />
    <div v-else class="pa-3" style="border-top:1px solid #f1f1f1;">
      <v-text-field
        disabled
        outlined
        single-line
        hide-details
        dense
        append-icon="mdi-send"
        placeholder="Enter your message"
        flat
      ></v-text-field>
    </div>
  </div>
</template>

<script>
import MessageFeed from "./MessageFeed";
import MessageComposer from "./MessageComposer";
export default {
  props: {
    contact: {
      type: Object,
      default: null
    },
    messages: {
      type: Array,
      default: []
    }
  },
  components: {
    MessageFeed,
    MessageComposer
  },
  methods: {
    sendMessage(message) {
      if (!this.contact) {
        return;
      }
      axios
        .post("/u/my-messages/conversation/send", {
          contact_id: this.contact.id,
          text: message
        })
        .then(response => {
          this.$emit("new", response.data);
        });
    }
  }
};
</script>