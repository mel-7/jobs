<template>
  <div style="height:400px; max-height: 400px" ref="feed" class="overflow-y-auto">
    <v-list dense flat v-if="contact">
      <v-list-item v-for="message in messages" :key="message.id" style="min-height:35px;">
        <v-avatar
          v-if="message.to != contact.id"
          size="30px"
          color="blue "
          class="align-self-start mt-2 mr-2"
        >
          <span class="white--text caption">{{contact.name.split(" ").map((n)=>n[0]).join("")}}</span>
        </v-avatar>
        <div
          style="max-width:80%;"
          :class="`py-1 d-column-flex ${message.to == contact.id ? 'ml-auto' : 'mr-auto'}`"
        >
          <v-card
            :class="`d-inline-flex ${message.to == contact.id ? 'float-right' : 'float-left' }`"
            v-if="message.text != ''"
            flat
          >
            <v-card-text
              :class="`pa-2 ${message.to == contact.id ? 'primary--text blue-grey lighten-5' : 'white--text blue'} `"
            >{{ message.text }}</v-card-text>
          </v-card>
          <div
            style="width:100%;"
            v-if="message.attachment == 1 && isValidJSON(message.files) == true"
            :class="`d-flex flex-wrap ${message.to == contact.id ? 'justify-end' : 'justify-start'} `"
          >
            <v-sheet
              :class="`pa-2 ${message.to == contact.id ? 'blue-grey lighten-5' : 'blue'}`"
              v-for="file in JSON.parse(message.files)"
              :key="file.filename"
            >
              <v-card
                v-if="isImage(file.extension) == true"
                flat
                color="transparent"
                :href="'/conversation/files/'+message.id+'/'+file.extension+'/'+file.filename+'.'+file.extension"
                target="_blank"
                height="100px"
                width="100px"
                class="d-flex flex-column align-center justify-center"
              >
                <v-img
                  :src="'/conversation/files/'+message.id+'/'+file.extension+'/'+file.filename+'.'+file.extension"
                  aspect-ratio="1"
                  :class="`${message.to == contact.id ? 'blue' : 'blue-grey lighten-5'}`"
                  width="100px"
                ></v-img>
              </v-card>
              <v-card
                v-else
                flat
                color="transparent"
                :href="'/conversation/files/'+message.id+'/'+file.extension+'/'+file.filename+'.'+file.extension"
                download
                height="100px"
                width="100px"
                class="d-flex flex-column align-center justify-center"
              >
                <v-icon
                  x-large
                  class="pr-1"
                  :color="`${message.to == contact.id ? 'blue' : 'blue-grey lighten-5'}`"
                >{{printIcon(file.extension)}}</v-icon>
                <div
                  :class="`caption ${message.to == contact.id ? 'primary--text' : 'white--text'}`"
                >{{file.filename.substring(0,8)+"..."+file.extension}}</div>
              </v-card>
            </v-sheet>
          </div>
        </div>
      </v-list-item>
    </v-list>
    <div
      v-else
      class="d-flex align-center justify-center"
      style="height: 400px"
    >Please select a contact</div>
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
  methods: {
    isImage(ext) {
      if (ext.includes("jpeg") || ext.includes("png") || ext.includes("jpg")) {
        return true;
      } else {
        return false;
      }
    },
    printIcon(i) {
      if (i.includes("pdf")) {
        return "mdi-file-pdf";
      } else if (i.includes("doc")) {
        return "mdi-file-word";
      } else if (i.includes("xl")) {
        return "mdi-file-excel";
      } else if (i.includes("pp")) {
        return "mdi-file-powerpoint";
      } else if (i.includes("tx")) {
        return "mdi-note-text";
      } else {
        return "mdi-file-outline";
      }
    },
    isValidJSON(s) {
      if (typeof s !== "string") {
        return false;
      }
      try {
        JSON.parse(s);
        return true;
      } catch (error) {
        return false;
      }
    },
    scrollToBottom() {
      setTimeout(() => {
        this.$refs.feed.scrollTop =
          this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
      }, 50);
    }
  },
  watch: {
    contact(contact) {
      this.scrollToBottom();
    },
    messages(messages) {
      this.scrollToBottom();
    }
  }
};
</script>
<style lang="scss" scoped>
.bb-0 {
  border-bottom-right-radius: 0 !important;
  border-bottom-left-radius: 0 !important;
}
</style>