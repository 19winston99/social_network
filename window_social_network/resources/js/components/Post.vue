<script>
export default {
  props: [
    "id",
    "user",
    "userName",
    "userImage",
    "userLastname",
    "title",
    "description",
    "image",
    "liked",
    "comments",
  ],
  data() {
    return {
      like: this.liked,
      disabled: false,
      commentContent: "",
    };
  },
  methods: {
    likePost() {
      this.disabled = true;
      axios
        .post("/api/likes", {
          user_id: this.user.id,
          post_id: this.id,
        })
        .then((response) => {
          this.like = true;
          this.disabled = false;
        });
    },
    disLike() {
      this.disabled = true;
      axios
        .post("/api/dislike", {
          user_id: this.user.id,
          post_id: this.id,
        })
        .then((response) => {
          this.like = false;
          this.disabled = false;
        });
    },
    addComment() {
      axios
        .post("/api/comments", {
          user_id: this.user.id,
          post_id: this.id,
          my_content: this.commentContent,
        })
        .then((response) => {
          this.comments.push({
            user_id: this.user.id,
            content: this.commentContent,
            post_id: this.id,
            user: this.user,
          });
          this.commentContent = "";
        });
    },
  },
  computed: {
    classObject() {
      return {
        liked: this.like,
      };
    },
  },
};
</script>

<template>
  <div class="card border-secondary card-container">
    <div class="d-flex gap-3 header-post align-items-center">
      <img
        :src="'images/users/' + userImage"
        class="img-fluid profile-image"
        alt="User Image"
      />
      <h5 class="mb-0">{{ userName }} {{ userLastname }}</h5>
    </div>
    <p class="mb-2 p-2">{{ title }}</p>
    <img
      :src="'images/posts/' + image"
      class="card-img-top"
      alt="Post Image"
      @dblclick="likePost"
    />
    <div class="card-body">
      <button
        v-if="!like"
        @click="likePost"
        class="button-like"
        :disabled="disabled"
      >
        <i class="bi bi-heart"></i>
      </button>
      <button v-else @click="disLike" class="button-like" :disabled="disabled">
        <i class="bi bi-heart-fill" :class="classObject"></i>
      </button>
      <p class="card-text">{{ description }}</p>
    </div>
    <div class="d-flex justify-content-center gap-2">
      <input
        type="text"
        class="form-control form-control-sm input-comment"
        v-model="commentContent"
      />
      <button @click="addComment" class="btn btn-sm btn-dark">
        <i class="bi bi-send-fill"></i>
      </button>
    </div>
    <hr />
    <div
      v-for="comment in comments"
      :key="comment.id"
      class="comment-container"
    >
      <div class="d-flex gap-1 align-items-center">
        <img
          :src="'images/users/' + comment.user.profile"
          class="comment-image-user"
        />
        <p class="m-0">{{ comment.user.name }} {{ comment.user.lastname }}</p>
      </div>
      <small>{{ comment.content }}</small>
      <hr />
    </div>
  </div>
</template>

<style>
@media screen and (max-width: 900px) {
    .card-container {
    width: auto !important;
  }
}

.card-container {
  width: 39em;
}

.profile-image {
  border-radius: 50%;
  width: 3em;
  height: 3em;
  object-fit: cover;
}

.header-post {
  padding: 1em;
  border-bottom: 1px solid grey;
}

.button-like {
  border: none;
  background-color: transparent;
}

.liked {
  color: darkred;
}

.input-comment {
  border: 1px solid grey;
  width: 15em;
}

.comment-container {
  margin-left: 1em;
}

.comment-container small {
  padding-left: 2.8em;
}

.comment-image-user {
  border-radius: 50%;
  width: 2em;
  height: 2em;
  object-fit: cover;
}
</style>