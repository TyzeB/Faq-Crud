<template>
  <div class="form-container">
    <ul v-if="this.errors.length > 0" class="msg msg-warn">
      <li v-for="error in this.errors">{{ error }}</li>
    </ul>

    <div v-if="this.success != ''" class="msg msg-success">{{ this.success }}</div>

    <form class="form" v-on:submit.prevent="submit">
      <h2>Edit</h2>
      <div class="group-input">
        <label for="question">Question</label>
        <input type="text" name="question" v-model="question" />
      </div>
      <div class="group-input">
        <label for="category_id">Category</label>
        <select name id="category_id" v-model="category_id">
          <option
            v-for="category in this.categories"
            v-bind:value="category.id"
          >{{ category.category }}</option>
        </select>
      </div>
      <div class="group-input">
        <label for="answer">Anwser</label>
        <textarea name="answer" v-model="answer"></textarea>
      </div>
      <input type="submit" name="register" value="Edit" />
    </form>
  </div>
</template>

<script>
export default {
  mounted() {
    let self = this;
    let route = this.$route;
    this.$http
      .get("/api/category")
      .then(response => {
        self.categories = response.data.categories;
      })
      .catch(error => {
        self.errors.push(error.data);
      });
    this.$http
      .get("/api/faq/" + route.params.id)
      .then(response => {
        self.category_id = response.data.faq.category_id;
        self.answer = response.data.faq.answer;
        self.question = response.data.faq.question;
      })
      .catch(error => {
        self.errors.push(error);
      });
  },
  data() {
    let self = this;
    return {
      errors: [],
      categories: [],
      success: "",
      question: "",
      answer: "",
      category_id: "",
      input: {
        category_id: self.category_id,
        answer: self.answer,
        question: self.question
      }
    };
  },
  methods: {
    submit(event) {
      let self = this;
      let route = this.$route;
      self.errors = [];

      if (self.question == "") {
        self.errors.push("Question is required.");
      }

      if (self.category_id == "") {
        self.errors.push("Category is required.");
      }

      if (self.answer == "") {
        self.errors.push("Answer is required.");
      }

      if (self.errors.length > 0) {
        return false;
      }

      const formData = new FormData();
      formData.append("question", self.question);
      formData.append("category_id", self.category_id);
      formData.append("answer", self.answer);

      this.$http
        .post("/api/faq/edit/" + route.params.id, formData)
        .then(result => {
          self.$router.push({
            name: "faq",
            params: { id: route.params.id }
          });
        })
        .catch(error => {
          self.errors.push(error.message);
        });
    }
  }
};
</script>