<template>
  <div class="category-list">
    <ul class="errors">
      <li class="error" v-for="error in errors">{{ error }}</li>
    </ul>
    <div class="split">
      <ul class="categories">
        <li
          class="category"
          v-for="category in categories"
          :key="category.id"
          :class="activated == category.id ? 'v-active' : ''"
        >
          <router-link class="category-name" :to="{ name: 'faq', params: {id: category.id } }">
            <span
              v-on:click="setActivated(category.id)"
              :class="activated == category.id ? 'l-active' : ''"
            >{{ category.category }}</span>
          </router-link>
          <div class="settings-container">
            <router-link
              class="category-edit"
              v-if="auth"
              :to="{ name: 'category.edit', params: {id: category.id} }"
            >
              <font-awesome-icon icon="edit" />
            </router-link>
            <button
              class="category-delete"
              v-if="auth"
              v-on:click="removeItem(category.id)"
            >
              <font-awesome-icon icon="trash" />
            </button>
          </div>
        </li>
      </ul>
      <div class="faqs-per-category">
        <router-view :key="$route.fullPath"></router-view>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    let self = this;
    this.$http
      .get("/api/category")
      .then(response => {
        self.categories = response.data.categories;
      })
      .catch(error => {
        self.errors.push(error.data);
      });
  },
  data() {
    return {
      categories: [],
      errors: [],
      auth: window.auth,
      activated: null
    };
  },
  methods: {
    removeItem(id) {
      let self = this;
      this.$http
        .post("/api/category/delete/" + id)
        .then(response => {
          window.location.reload();
        })
        .catch(error => {
          self.errors.push(error.data);
        });
    },
    setActivated(id) {
      console.log(id);
      this.activated = id;
    }
  }
};
</script>