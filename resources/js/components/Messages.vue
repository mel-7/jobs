<template>
  <v-card>
    <v-container class="py-0">
      <v-row>
        <div class="col-12 col-md-4 pa-0" style="border-right:1px solid #f1f1f1;">
          <ContactList :contacts="contacts" @selected="startConversationWith" />
        </div>
        <div class="col-12 col-md-8 pa-0">
          <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage" />
        </div>
      </v-row>
    </v-container>
  </v-card>
</template>

<script>
import ContactList from "./messages/ContactList";
import Conversation from "./messages/Conversation";
export default {
  props: {
    userData: Object,
    default: null
  },
  components: {
    Conversation,
    ContactList
  },
  data() {
    return {
      selectedContact: null,
      messages: [],
      contacts: []
    };
  },
  methods: {
    startConversationWith(contact) {
      this.updateUnreadCount(contact, true);
      if (contact) {
        axios
          .get("/u/my-messages/conversation/" + contact.id)
          .then(response => {
            this.messages = response.data;
            this.selectedContact = contact;
          });
      }
    },
    saveNewMessage(message) {
      console.log(message)
      this.messages.push(message);
    },
    handleIncoming(message) {
      if (this.selectedContact && message.from == this.selectedContact.id) {
        this.saveNewMessage(message);
        return;
      }
      this.updateUnreadCount(message.from_contact, false);
    },
    updateUnreadCount(contact, reset) {
      this.contacts = this.contacts.map(single => {
        if (single.id !== contact.id) {
          return single;
        }
        if (reset) {
          single.unread = 0;
        } else {
          single.unread += 1;
        }
        return single;
      });
    }
  },
  mounted() {
    Echo.private(`messages.${this.userData.id}`).listen("NewMessage", e => {
      this.handleIncoming(e.message);
    });
    axios.get("/u/my-messages/contacts").then(response => {
      this.contacts = response.data;
    });
  }
};
</script>