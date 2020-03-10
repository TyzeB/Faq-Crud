<template>
  <div class="form-container">
    <ul v-if="this.errors.length > 0" class="msg msg-warn">
      <li v-for="error in this.errors">{{ error }}</li>
    </ul>

    <div v-if="this.success != ''" class="msg msg-success">{{ this.success }}</div>

    <form class="form" v-on:submit.prevent="submit">
      <h2>Edit</h2>
      <div class="group-input">
        <label for="question">Category</label>
        <input type="text" name="category" v-model="category" />
      </div>
      <input type="submit" name="submit" value="Edit" />
    </form>
  </div>
</template>

<script>
export default {
  mounted() {
    let self = this;
    this.$http
      .get("/api/faq/category/" + self.$route.params.id)
      .then(result => {
        self.category = result.data.category.category;
      });
  },
  data() {
    let self = this;
    return {
      errors: [],
      success: "",
      category: "",
      input: {
        category: self.category
      }
    };
  },
  methods: {
    submit(event) {
      let self = this;
      self.errors = [];

      if (self.category == "") {
        self.errors.push("Category is required.");
      }

      if (self.errors.length > 0) {
        return false;
      }

      const formData = new FormData();
      formData.append("category", self.category);

      this.$http
        .post("/api/category/edit/" + self.$route.params.id, formData)
        .then(result => {
          self.$router.push({ name: "faqs" });
        })
        .catch(error => {
          self.errors.push(error.data);
        });
    }
  }
};
</script>