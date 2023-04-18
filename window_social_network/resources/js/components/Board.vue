<script>
export default {
  props: ["auth"],
  data() {
    return {
      users: [],
      usersContainer: [],
      userSelected: null,
      userObject: JSON.parse(this.auth),
    };
  },
  methods: {
    getUsers() {
      axios.get("api/users").then((response) => {
        this.users = response.data;
        this.searchUsers("");
      });
    },
    setUserChat(user) {
      this.userSelected = user;
    },
    searchUsers(text) {
      this.usersContainer = this.users.filter((user) =>
        user.name.toLowerCase().startsWith(text.toLowerCase())
      );
    },
  },
  mounted() {
    this.getUsers();
  },
};
</script>

<template>
  <div class="main-container">
    <users-list
      :users="usersContainer"
      @userSelected="setUserChat"
    ></users-list>
    <searchbar class="w-50 mb-3" @search-users="searchUsers"></searchbar>
    <chat
      v-if="userSelected"
      :userSelected="userSelected"
      :userAuth="userObject"
    ></chat>
  </div>
</template>

<style>
.main-container {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
</style>