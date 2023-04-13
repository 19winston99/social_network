<script>
export default {
  props: ["userSelected", "userAuth"],
  data() {
    return {
      messages: [],
      messageContent: "",
      image: null,
    };
  },
  methods: {
    getMessages() {
      axios
        .get(
          "api/messages/?personalId=" +
            this.userAuth.id +
            "&id=" +
            this.userSelected.id
        )
        .then((response) => {
          this.messages = response.data;
        });
      setInterval(() => {
        this.getMessages();
      }, 3 * 60 * 1000);
    },
    sendMessage() {
      if (this.messageContent || this.image) {
        const formData = new FormData();
        formData.append("sender_user_id", this.userAuth.id);
        formData.append("recipient_user_id", this.userSelected.id);
        if (this.messageContent) {
          formData.append("body", this.messageContent);
        }
        if (this.image) {
          formData.append("image", this.image);
        }
        axios.post("api/messages/", formData).then((response) => {
          if (response.data.success) {
            this.messages.push({
              sender_user_id: this.userAuth.id,
              recipient_user_id: this.userSelected.id,
              body: this.messageContent ? this.messageContent : null,
              image: response.data.image,
              id: response.data.id,
            });
            this.messageContent = "";
            this.image = null;
            this.$refs.inputFile.value = null;
          }
        });
      }
    },
    deleteMessage(messageId) {
      axios.delete("/api/messages/" + messageId).then((response) => {
        if (response.data.success) {
          this.filterMessage(messageId);
        }
      });
    },
    filterMessage(messageId) {
      this.messages = this.messages.filter((el) => el.id !== messageId);
    },
    onFileSelected(event) {
      this.image = event.target.files[0];
    },
  },
  watch: {
    userSelected: {
      handler(newUser, oldUser) {
        if (newUser != oldUser) {
          this.messageContent = "";
          this.getMessages();
        }
      },
    },
  },
  mounted() {
    this.getMessages();
  },
};
</script>

<template>
  <div class="d-block chat-container">
    <div class="d-flex gap-1 align-items-center mb-2">
      <img
        :src="'images/users/' + userSelected.profile"
        class="img-fluid profile-image"
        alt="User Image"
      />
      <p class="m-0">{{ userSelected.name }}</p>
    </div>
    <div class="messages-container">
      <div
        v-for="message in messages"
        :key="message.id"
        :class="{
          messages_sent_corporate:
            message.sender_user_id == userAuth.id &&
            message.image != null &&
            message.body != null,
          messages_sent: message.sender_user_id == userAuth.id,
          messages_receive: message.sender_user_id != userAuth.id,
        }"
        class="me-3 ms-2"
      >
        <img
          v-if="message.image != null"
          :src="'images/messages/' + message.image"
          class="card-img-top chat-image mt-2 mb-2"
          :class="{
            image_receive: message.sender_user_id != userAuth.id,
          }"
        />
        <p v-if="message.body != null" class="text mt-1 mb-1">
          {{ message.body }}
        </p>
        <button
          v-if="message.sender_user_id == userAuth.id"
          @click="deleteMessage(message.id)"
          class="btn btn-sm"
        >
          <i class="bi bi-x-circle-fill delete"></i>
        </button>
      </div>
    </div>
    <div class="d-flex justify-content-center mt-2">
      <input
        type="text"
        v-model="messageContent"
        class="form-control input"
        placeholder="Type your message here"
      />
      <input
        type="file"
        @change="onFileSelected"
        class="form-control form-control-sm file"
        ref="inputFile"
      />
      <button class="btn btn-sm" @click="$refs.inputFile.click()">
        <i class="bi bi-paperclip"></i>
      </button>
      <button @click="sendMessage" class="btn bnt-sm">
        <i class="bi bi-send-fill"></i>
      </button>
    </div>
  </div>
</template>

<style>
.text {
  text-align: start;
  color: white;
  margin: 0;
}

.file {
  display: none;
}

.chat-container {
  width: 40em;
}

.messages-container {
  padding: 1em;
  height: 26em;
  overflow-y: scroll;
  background: url("../../../public/images/background/background.jpg");
  background-position: center;
  background-size: cover;
}

.chat-image {
  width: 10em;
  border-radius: 10px;
}

.messages_sent_corporate {
  display: flex;
  justify-content: end;
  align-items: end;
  flex-direction: column;
}

.messages_sent :not(.chat-image, button, i) {
  display: inline-block;
  background-color: darkgreen;
  min-width: 6em;
  word-wrap: break-word;
  max-width: 20em;
  overflow-y: hidden;
  height: auto;
  border-radius: 10px;
  padding: 0.5em;
}
.messages_receive :not(.chat-image, button, i) {
  display: inline-block;
  background-color: #36b236;
  min-width: 6em;
  word-wrap: break-word;
  max-width: 20em;
  overflow-y: hidden;
  height: auto;
  border-radius: 10px;
  padding: 0.5em;
}
.messages-container :not(.messages_receive, .text) {
  text-align: right;
}

.input {
  background-color: #d1d1d1;
}

.image_receive {
  display: block;
}

.profile-image {
  border-radius: 50%;
  width: 3em;
  height: 3em;
  object-fit: cover;
}

.delete {
  color: white;
}
</style>