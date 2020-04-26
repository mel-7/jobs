<template>
  <div  style="max-height: 400px" ref="feed" class="overflow-y-auto">
    <v-list dense flat v-if="contact">
      <v-list-item
        v-for="message in messages"
        :class="`message ${message.to == contact.id ? 'text-right' : 'text-left'}`"
        :key="message.id"
        style="min-height:35px;max-height:35px;"
      >
        <v-list-item-content class="py-0">
          <v-list-item-subtitle>
            <v-chip :color="`${message.to == contact.id ? 'info' : 'success'} `">{{message.text}}</v-chip>
          </v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
    </v-list>
    <div v-else class="d-flex align-center justify-center" style="height: 400px">
      Please select a contact
    </div>
  </div>
</template>

<script>
export default {
  props: {
    contact: {
      type: Object
    },
    messages: {
      type: Array,
      default: []
    }
  },
  data() {
    return {};
  },
  methods:{
    scrollToBottom(){
      setTimeout(() => {
        this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
      }, 50);
    }
  },
  watch: {
    contact(contact) {
      this.scrollToBottom();
    },
    messages(messages){
      this.scrollToBottom();
    }
  }
};
</script>

<style>
</style>