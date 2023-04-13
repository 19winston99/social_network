<script>
export default {
  data() {
    return {
      text: "",
    };
  },
  methods: {
    searchUsers() {
      this.$emit("search-users", this.text);
    },
  },
  emits: ['search-users']
};
</script>

<template>
  <div class="form-group">
    <input type="text" v-model="text" class="form-control" @input="searchUsers" placeholder="Search users" />
  </div>
</template>
