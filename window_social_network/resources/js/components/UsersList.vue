<script>
export default {
  props: ["users"],
  emits: ["userSelected"],
  methods: {
    selectUser(user) {
      this.$emit("userSelected", user);
    },
  },
};
</script>

<template>
  <div class="users-container">
    <div
      v-for="user in users"
      :key="user.id"
      @click="selectUser(user)"
      class="user"
    >
      <div class="d-flex align-items-center justify-content-between flex-wrap">
        <img
          :src="'images/users/' + user.profile"
          class="img-fluid profile-image"
          alt="User Image"
        />
        <p class="mb-1">{{ user.name }} {{ user.lastname }}</p>
      </div>
    </div>
  </div>
</template>

<style>
@media screen and (max-width: 700px) {
  .users-container {
    display: flex;
    overflow-x: scroll;
    padding: 0.5em;
    margin-bottom: 1em;
    width: 20em !important;
  }
}

.users-container {
  display: flex;
  overflow-x: scroll;
  padding: 0.5em;
  margin-bottom: 1em;
  width: 41em;
}
.user {
  padding: 0.5em;
  border-radius: 10px;
  display: flex;
}
.user:hover {
  background-color: lightgrey;
  cursor: pointer;
}

.profile-image {
  border-radius: 50%;
  width: 3em;
  height: 3em;
  object-fit: cover;
}
</style>