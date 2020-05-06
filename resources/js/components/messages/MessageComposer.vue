<template>
  <div style="position:relative;">
    <div
      @dragover.prevent="dragging = true"
      @drop.prevent="dropFunction"
      @dragleave.prevent="dragging = false"
      class="drop-wrapper"
    >
      <!-- <span
        :class="`overline drop-msg ${dragging == false ? 'hide' : ''}`"
      >Click to browse or drop your file(s) here</span>-->
      <div v-if="dragging == false" class="textfield pa-3 d-flex">
        <v-btn class="mr-3 open-uploader" text icon>
          <v-icon>mdi-paperclip</v-icon>
        </v-btn>
        <v-text-field
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
      <vue-dropzone
        v-show="dragging == true || sendWithFile == true "
        class="file-upload"
        ref="myVueDropzone"
        id="dropzone"
        :options="dropzoneOptions"
        v-on:vdropzone-sending="sendingEvent"
        v-on:vdropzone-drop="dropFunction"
        v-on:vdropzone-success-multiple="uploadSuccess"
        v-on:vdropzone-removed-file="removedFile"
        :include-styling="false"
      ></vue-dropzone>
    </div>
    <v-overlay absolute color="white" :value="loading">
      <v-progress-circular :width="2" size="25" color="primary" indeterminate></v-progress-circular>
    </v-overlay>
  </div>
</template>
<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
export default {
  props: {
    contactwith: {
      type: Number,
      default: null
    }
  },
  components: {
    vueDropzone: vue2Dropzone
  },
  data() {
    return {
      loading: false,
      dropzoneOptions: {
        url: "/u/my-messages/conversation/send",
        thumbnailWidth: 40,
        thumbnailHeight: 40,
        uploadMultiple: true,
        autoProcessQueue: false,
        maxFiles: 10,
        parallelUploads: 10,
        maxFilesize: 0.5,
        previewTemplate: this.dropzoneTemplate(),
        clickable: ".open-uploader",
        headers: {
          "x-csrf-token": document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content")
        }
      },
      sendWithFile: false,
      message: "",
      dropzone: null,
      dragging: false,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },
  watch: {
    contact(contact) {
      this.scrollToBottom();
    }
  },
  methods: {
    dropzoneTemplate() {
      return `<div class="dz-preview dz-file-preview d-flex pa-2 blue lighten-5">
                <img data-dz-thumbnail />
                <div class="dz-details d-flex align-center justify-start">
                  <div class="dz-size px-1 caption" data-dz-size></div>
                  <div class="px-1 caption">
                    <div class="dz-filename" data-dz-name></div>
                    <div class="error--text overline" data-dz-errormessage></div>
                  </div>
                  <div class="dz-progress d-flex align-center justify-center caption">
                    <span class="dz-upload" data-dz-uploadprogress></span>
                  </div>
                </div>
                <v-spacer></v-spacer>
                <button
                  data-dz-remove
                  type="button"
                  class="ml-auto v-btn v-btn--flat v-btn--icon v-btn--round theme--light v-size--x-small error--text"
                >
                  <span class="v-btn__content">
                    <i
                      aria-hidden="true"
                      class="v-icon notranslate mdi mdi-trash-can-outline theme--light"
                      style="font-size: 12px;"
                    ></i>
                  </span>
                </button>
              </div>`;
    },
    dropFunction(e) {
      e.preventDefault();
      this.sendWithFile = true;
      this.dragging = false;
    },
    sendingEvent(file, xhr, formData) {
      formData.append("text", this.message);
      formData.append("contact_id", this.contactwith);
      formData.append("attachment", 1);
    },
    removedFile(file, xhr, formData) {
      this.$refs.myVueDropzone.getQueuedFiles().length == 0
        ? (this.sendWithFile = false)
        : "";
    },
    uploadSuccess(files, response) {
      this.$emit("send", response);
      this.$refs.myVueDropzone.removeAllFiles();
      this.sendWithFile = false;
      this.loading = false;
    },
    send(e) {
      e.preventDefault();
      let messageData = null;

      this.loading = true;
      if (this.sendWithFile == true) {
        this.$refs.myVueDropzone.processQueue();
        this.message = "";
      } else {
        if (this.message == "") {
          return;
        }
        messageData = {
          text: this.message,
          attachment: 0
        };
        this.$emit("send", messageData);
        this.message = "";
      }
    }
  },
  mounted() {}
};
</script>
<style lang="scss">
.loading-sheet {
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  bottom: auto;
  right: auto;
}
.file-upload {
  height: 100px;
  max-height: 100px;
  overflow-y: auto;
  border-top: 1px solid #f1f1f1;
  width: 100%;
  background-color: #fdfdfd;
  display: flex;
  flex-wrap: wrap;
  padding: 4px;
  justify-content: flex-start;
  .dz-preview {
    width: calc(50% - 16px);
    border-radius: 4px;
    margin: 8px;
    max-height: 65px;
    min-width: 200px;
    .dz-details {
      .dz-filename {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
      }
      img {
        width: 30px;
        height: auto;
      }
    }
    &.dz-error.dz-complete {
      background-color: #ffebee !important;
    }
  }
}
.drop-wrapper {
  background-color: #fdfdfd;
  .drop-msg {
    position: absolute;
    top: auto;
    left: 0;
    right: 0;
    bottom: 20px;
    width: 100%;
    text-align: center;
  }
  .textfield {
    width: 100%;
    border-top: 1px solid #f1f1f1;
    background-color: #ffffff;
  }
}
</style>