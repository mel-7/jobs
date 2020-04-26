<template>
  <v-list subheader>
    <v-subheader>Recent chat</v-subheader>
    <v-list-item
      v-for="(contact, index) in contacts"
      :key="contact.id"
      @click="selectContact(index, contact)"
      :class="{'selected': index == selected}"
    >
      <v-list-item-avatar>
        <v-icon>mdi-account-circle-outline</v-icon>
      </v-list-item-avatar>
      <v-list-item-content>
        <v-list-item-title>{{contact.name}}</v-list-item-title>
        <v-list-item-subtitle>{{contact.email}}</v-list-item-subtitle>
      </v-list-item-content>
      <v-list-item-icon>
        <v-icon color="deep-purple accent-4">mdi-chat</v-icon>
      </v-list-item-icon>
    </v-list-item>
  </v-list>
</template>

<script>
export default {
  props: {
    contacts: Array,
    default: []
  },
  data(){
      return {
          selected: 0
      }
  },
  methods: {
      selectContact(index, contact){
          this.selected = index;
          this.$emit('selected', contact);
      }
  },
  mounted() {
    // console.log(this.contacts);
  }
};
</script>