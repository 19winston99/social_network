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
  <div class="warning">
    <i class="bi bi-exclamation-octagon-fill"></i>
    <h5 class="text-center">
      La chat per device con schermo inferiore ai
      700px è ancora in fase di elaborazione... stay tuned!
    </h5>
  </div>
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
@media screen and (max-width: 700px) {
  .main-container {
    display: none;
  }
  .warning {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }
}

@media screen and (min-width: 700px) {
  .warning {
    display: none;
  }
}
</style>