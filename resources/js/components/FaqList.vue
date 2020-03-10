<template>
  <div class="faqs-list">
    <ul class="faqs">
      <li v-for="faq in this.faqs.data" :key="faq.id" class="faq">
        <button class="collapsible" v-on:click="setVisible">
          {{ faq.question }}
          <div class="settings-container">
            <router-link
              class="faq-edit"
              v-if="auth"
              :to="{ name: 'faq.edit', params: {id: faq.id} }"
            >
              <font-awesome-icon icon="edit" />
            </router-link>
            <button v-if="auth" class="faq-delete" v-on:click="removeItem(faq.id)">
              <font-awesome-icon icon="trash" />
            </button>
          </div>
        </button>
        <div class="content">
          <p v-html="faq.answer"></p>
        </div>
      </li>
    </ul>
    <pagination :data="faqs" @pagination-change-page="getResults"></pagination>
  </div>
</template>

<script>
export default {
  mounted() {
    this.getResults();
  },
  data() {
    return {
      faqs: {},
      errors: [],
      auth: window.auth
    };
  },
  methods: {
    removeItem(id) {
      let self = this;
      this.$http
        .post("/api/faq/delete/" + id)
        .then(response => {
          window.location.reload();
        })
        .catch(error => {
          self.errors.push(error.data);
        });
    },
    setVisible(e) {
      let element = e.target;
      let content = element.parentNode.getElementsByClassName("content")[0];
      if (content.style.display === "block") {
        content.style.display = "none";
      } else {
        content.style.display = "block";
      }
    },
    getResults(page = 1) {
      let self = this;
      let route = this.$route;
      this.$http
        .get("/api/faq/all/" + route.params.id + "?page=" + page)
        .then(response => {
          self.faqs = response.data.faqs;
        })
        .catch(error => {
          self.errors.push(error);
        });
    }
  }
};
</script>