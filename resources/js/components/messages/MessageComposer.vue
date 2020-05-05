<template>
  <div style="position:relative;">
    <div
      @dragover.prevent="dragging = true"
      @drop.prevent="dropFunction"
      @dragleave.prevent="dragging = false"
      class="drop-wrapper"
    >
      <vue-dropzone
        v-show="dragging == true || sendWithFile == true "
        class="file-upload"
        ref="myVueDropzone"
        id="dropzone"
        :options="dropzoneOptions"
        v-on:vdropzone-sending="sendingEvent"
        v-on:vdropzone-drop="dropFunction"
        v-on:vdropzone-complete-multiple="uploadComplete"
        v-on:vdropzone-success-multiple="uploadSuccess"
        :include-styling="false"
      ></vue-dropzone>

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
    </div>
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
      dropzoneOptions: {
        url: "/u/my-messages/conversation/send",
        thumbnailWidth: 40,
        thumbnailHeight: 40,
        uploadMultiple: true,
        autoProcessQueue: false,
        maxFiles: 10,
        parallelUploads: 10,
        maxFilesize: 1,
        previewTemplate: this.dropzoneTemplate(),
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
  methods: {
    dropzoneTemplate() {
      return `<div class="dz-preview dz-file-preview d-flex pa-2">
                <div class="dz-details d-flex align-center">
                  <img data-dz-thumbnail />
                  <div class="dz-size px-2 caption" data-dz-size></div>
                  <div class="dz-filename px-2 caption">
                    <span data-dz-name></span>
                  </div>
                </div>
                <div class="dz-progress d-flex align-center justify-center caption">
                  <span class="dz-upload" data-dz-uploadprogress></span>
                </div>
                <div class="dz-error-message px-2 d-flex align-center justify-center caption">
                  <span data-dz-errormessage></span>
                </div>
                <v-spacer></v-spacer>
                <div class="dz-success-mark px-2 d-flex align-center justify-center">
                  <span>✔</span>
                </div>
                <div class="dz-error-mark px-2 d-flex align-center justify-center">
                  <span>✘</span>
                </div>
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
    uploadComplete(response) {
      let messageData = {
        text: this.message,
        attachment: 1
      };
    },
    uploadSuccess(files, response) {
      this.$emit("send", response);
    },
    send(e) {
      e.preventDefault();
      let messageData = null;

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
<style lang="scss" scoped>
// .hide {
//   display: none;
// }
.file-upload {
  position: absolute;
  bottom: 0;
  top: auto;
  right: 0;
  left: 0;
  height: 100px;
  max-height: 100px;
  overflow-y: auto;
  border-top: 1px solid #f1f1f1;
  width: 100%;
  background-color: #fdfdfd;
  .dz-preview {
    width: 100%;
    background-color: #f1f1f1;
    .dz-details {
      img {
        width: 30px;
        height: auto;
      }
    }
  }
}
.drop-wrapper {
  background-color: #fdfdfd;
  height: 65px;
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