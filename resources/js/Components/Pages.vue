<template>
  <div>
    <h1>{{ page.title }}</h1>
    <img :src="page.image" alt="Page Image">
    <p>{{ page.content }}</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      page: {}
    };
  },
  mounted() {
    axios.get(`/api/page/${this.$route.params.id}`).then(response => {
      this.page = response.data;
    });
  }
};
</script>
