<template>
    <div>
      <h1>Admin Dashboard</h1>
      <form @submit.prevent="updatePage">
        <input v-model="page.title" placeholder="Title" />
        <textarea v-model="page.content" placeholder="Content"></textarea>
        <input type="file" @change="uploadImage" />
        <button type="submit">Update</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        page: {}
      };
    },
    methods: {
      uploadImage(event) {
        let formData = new FormData();
        formData.append("image", event.target.files[0]);
        axios.post("/api/upload-image", formData).then(response => {
          this.page.image = response.data.image_url;
        });
      },
      updatePage() {
        axios.put(`/api/page/${this.page.id}`, this.page).then(() => {
          alert("Page updated!");
        });
      }
    },
    mounted() {
      axios.get(`/api/page/${this.$route.params.id}`).then(response => {
        this.page = response.data;
      });
    }
  };
  </script>
  