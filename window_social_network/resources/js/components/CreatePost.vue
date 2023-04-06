<script>
export default {
  data() {
    return {
      title: "",
      description: "",
      image: "",
      errorTitle: "",
      errorDescription: "",
      errorImage: "",
      comments: [],
    };
  },
  methods: {
    createPost() {
      this.errorTitle = !this.title ? "Campo obbligatorio" : "";
      this.errorDescription = !this.description ? "Campo obbligatorio" : "";
      this.errorImage = !this.image ? "Campo obbligatorio" : "";
      if (!this.errorTitle && !this.errorDescription && !this.errorImage) {
        const formData = new FormData();
        formData.append("user_id", this.user.id);
        formData.append("title", this.title);
        formData.append("description", this.description);
        formData.append("image", this.image);
        axios.post("/api/posts", formData).then((response) => {
          if (response.data.success) {
            this.$emit("create-post", {
              title: this.title,
              description: this.description,
              image: response.data.image,
              id: response.data.id,
              user: this.user,
              comments: this.comments
            });
          }
          this.title = "";
          this.description = "";
          this.image = "";
        });
      }
    },
    onFileSelected(event) {
      this.image = event.target.files[0];
    },
  },
  computed: {
    classError() {
      return {
        error: this.errorTitle || this.errorDescription || this.errorImage,
      };
    },
  },
  emits: ["create-post"],
  props: ["user"],
};
</script>

<template>
  <form
    enctype="multipart/form-data"
    @submit.prevent="createPost"
    class="post-container"
  >
    <div class="mb-3">
      <h4 class="text-center">A cosa stai pensando?</h4>
      <label for="title" class="form-label">Titolo</label>
      <input
        type="text"
        class="form-control form-control-sm"
        id="title"
        v-model="title"
        required
      />
      <small :class="classError">{{ errorTitle }}</small>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Descrizione</label>
      <textarea
        class="form-control"
        id="description"
        v-model="description"
        rows="3"
        required
      ></textarea>
      <small :class="classError">{{ errorDescription }}</small>
    </div>
    <div class="mb-3">
      <label class="form-label" for="file">Foto</label>
      <input
        type="file"
        @change="onFileSelected"
        class="form-control form-control-sm"
        id="file"
        required
      />
      <small :class="classError">{{ errorImage }}</small>
    </div>
    <button type="submit" class="btn btn-secondary btn-sm">
      <i class="bi bi-send-fill"></i> Inserisci
    </button>
  </form>
</template>

<style>
@media screen and (max-width: 700px) {
    .post-container{
        /* background: #d9d7d7; */
        padding: 1em;
        width: auto !important;
        box-shadow: 0px 0px 2px black;
        background: url("../../../public/images/background/background2.jpg");
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
      }
      
} 

.post-container {
  /* background: #d9d7d7; */
  padding: 1em;
  width: 39em;
  box-shadow: 0px 0px 2px black;
  background: url("../../../public/images/background/background2.jpg");
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
}

.post-container label {
  margin-bottom: 0.3em;
}

.error {
  color: darkred;
}
</style>