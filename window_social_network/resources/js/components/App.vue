<script>
export default {
  data() {
    return {
      loaded: false,
      posts: [],
      userObject: JSON.parse(this.user),
      added: false
    };
  },
  props: ["user", "user_name"],
  methods: {
    getPosts() {
      axios.get("/api/posts?user_id=" + this.userObject.id).then((response) => {
        this.posts = response.data;
        this.posts.reverse();
        this.loaded = true;
      });
    },
    addNewPost(post) {
      this.posts.push(post);
      this.posts.reverse();
      this.added = true;
    },
  },
  mounted() {
    this.getPosts();
  },
};
</script>

<template>
  <div v-if="added" class="alert alert-success placeholder-posts m-auto mb-4 text-center" role="alert">
    Post creato con successo
  </div>
  <create-post
    @create-post="addNewPost"
    :user="userObject"
    class="m-auto"
  ></create-post>
  <div class="mt-4">
    <template v-if="loaded">
      <post
        class="m-auto mt-4 mb-4"
        v-for="post in posts"
        :id="post.id"
        :key="post.id"
        :title="post.title"
        :description="post.description"
        :image="post.image"
        :userName="post.user.name"
        :userLastname="post.user.lastname"
        :user="userObject"
        :userImage="post.user.profile"
        :liked="post.liked"
        :comments="post.comments"
      ></post>
    </template>
    <template v-else>
      <div class="card m-auto placeholder-posts" aria-hidden="true">
        <div class="spinner-grow spinner" role="status">
          <span class="visually-hidden"></span>
        </div>
        <div class="card-body">
          <h5 class="card-title placeholder-glow">
            <span class="placeholder col-6"></span>
          </h5>
          <p class="card-text placeholder-glow">
            <span class="placeholder col-7"></span>
            <span class="placeholder col-4"></span>
            <span class="placeholder col-4"></span>
            <span class="placeholder col-6"></span>
            <span class="placeholder col-8"></span>
          </p>
        </div>
      </div>
    </template>
  </div>
</template>

<style>
.spinner {
  margin: 0 auto;
  margin-top: 1em;
}

.placeholder-posts {
  width: 39em;
}
</style>
