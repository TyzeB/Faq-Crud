<template>
  <div class="example">
    <ul class="links left">
      <li class="link">
        <router-link :to="{ name: 'faqs' }">List</router-link>
      </li>
      <li class="link" v-if="auth">
        <router-link :to="{ name: 'category.add' }">Add Category</router-link>
      </li>
      <li class="link" v-if="auth">
        <router-link :to="{ name: 'faq.add' }">Add FAQ</router-link>
      </li>
    </ul>

    <info-bar></info-bar>
    <div class="view">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
    this.$router.push({ name: "faqs" });
  },
  data() {
    return {
      auth: window.auth
    };
  }
};
</script>
