<template>
  <v-list subheader>
    <v-subheader>Recent chat</v-subheader>
    <v-list-item-group color="info">
      <v-list-item
        v-for="contact in sortedContacts"
        :key="contact.id"
        @click="selectContact(contact)"
      >
        <v-list-item-avatar>
          <v-icon>mdi-account-circle-outline</v-icon>
        </v-list-item-avatar>
        <v-list-item-content>
          <v-list-item-title>{{contact.name}}</v-list-item-title>
          <v-list-item-subtitle>{{contact.email}}</v-list-item-subtitle>
        </v-list-item-content>
        <v-badge v-if="contact.unread" inline color="info" :content="contact.unread"></v-badge>
      </v-list-item>
    </v-list-item-group>
  </v-list>
</template>

<script>
export default {
  props: {
    contacts: Array,
    default: []
  },
  data() {
    return {
      selected: this.contacts.length ? this.contacts[0] : 0
    };
  },
  methods: {
    selectContact(contact) {
      this.selected = contact;
      this.$emit("selected", contact);
    }
  },
  computed: {
    sortedContacts() {
      return _.sortBy(this.contacts, [
        contact => {
          if (contact == this.selected) {
            return Infinity;
          }
          return contact.unread;
        }
      ]).reverse();
    }
  }
};
</script>