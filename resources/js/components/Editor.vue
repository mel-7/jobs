<template>
  <div id="codex-editor"></div>
</template>

<script>
import EditorJS from "@editorjs/editorjs";
import Header from "@editorjs/header";
import Paragraph from "@editorjs/paragraph";
import List from "@editorjs/list";
export default {
  data() {
    return {
      value: null,
    };
  },
  created() {
    this.$root.$refs.editor = this;
  },
  methods: {
    saveEditor: function() {
      editor.save().then(savedData => {
        // console.log(savedData);
        console.log(JSON.stringify(savedData));
      });
    },
    myEditor: function() {
      window.editor = new EditorJS({
        holder: "codex-editor",
        autofocus: true,
        /**
         * This Tool will be used as default
         */
        initialBlock: "paragraph",
        tools: {
          header: {
            class: Header,
            shortcut: "CMD+SHIFT+H"
          },
          list: {
            class: List
          },
          paragraph: {
            class: Paragraph,
            config: {
              placeholder: "content"
            }
          }
        },
        onReady: function() {
          console.log("ready");
        },
        onChange: function() {
          console.log("change");
        }
      });
    }
  },
  mounted: function() {
    this.myEditor();
  }
};
</script>