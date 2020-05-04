<template>
  <div style="position:relative;">
    <div id="tpl" style="display:none;">
      <div class="dz-preview dz-file-preview d-flex pa-2">
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
      </div>
    </div>
    <div ref="fileupload" class="d-flex align-center justify-start file-upload flex-wrap"></div>
    <div
      @dragover.prevent="dragging = true"
      @drop.prevent="dropFunction"
      @dragleave.prevent="dragging = false"
      class="drop-wrapper"
    >
      <span
        :class="`overline drop-msg ${dragging == false ? 'hide' : ''}`"
      >Click to browse or drop your file(s) here</span>
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
import Dropzone from "dropzone";
export default {
  data() {
    return {
      sendFile: false,
      message: "",
      dropzone: null,
      dragging: false,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },
  methods: {
    dropFunction(e) {
      if (e.dataTransfer && e.dataTransfer.files.length) {
        this.dragging = false;
        this.sendFile = true;
        // console.log(e.dataTransfer.files.length);
        // you could pass along the entire event, but probably best to just pass what you need
        Dropzone.instances[0].drop({ dataTransfer: e.dataTransfer });
      }
    },
    send(e) {
      e.preventDefault();
      // console.log(this.csrf);
      let messageData = null;

      if (this.sendFile == true) {
        Dropzone.instances[0].processQueue();
      } else {
        if (this.message == "") {
          return;
        }
        messageData = {
          text: this.message,
          attachment: 0,
          files: "" // JSON.stringify(messageData)
          // files: '{"http://127.0.0.1:8000/u/my-messages"}' // JSON.stringify(messageData)
        }
        this.$emit("send", messageData);
        this.message = "";
      }
    }
  },
  mounted() {
    this.dropzone = new Dropzone(this.$refs.fileupload, {
      url: "/api/u/my-messages/conversation/file",
      previewTemplate: document.querySelector("#tpl").innerHTML,
      clickable: document.querySelector(".open-uploader"),
      autoProcessQueue: false,
      parallelUploads: 10,
      uploadMultiple: true,
      headers: {
        "x-csrf-token": this.csrf
      },
      params: { text: this.message, contact_id: 2 }
      // init: function() {
      //   this.on("sending", function(file, xhr, formData) {
      //     formData.append("text", this.message);
      //   });
      // }
    });
  }
};
</script>
<style lang="scss" scoped>
.hide {
  display: none;
}
.file-upload {
  max-height: 150px;
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