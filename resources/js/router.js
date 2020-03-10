import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import FaqAdd from "./components/FaqAdd.vue";
import CategoryList from "./components/CategoryList.vue";
import CategoryAdd from "./components/CategoryAdd.vue";
import CategoryEdit from "./components/CategoryEdit.vue";
import FaqList from "./components/FaqList.vue";
import FaqEdit from "./components/FaqEdit.vue"

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/faq/add",
            name: "faq.add",
            component: FaqAdd
        },
        {
            path: "/faq",
            name: "faqs",
            component: CategoryList,
            children: [
                {
                    path: "/faq/:id",
                    name: "faq",
                    component: FaqList
                },
            ]
        },
        {
            path: "/faq/category/add",
            name: "category.add",
            component: CategoryAdd
        },
        {
            path: "/faq/category/edit/:id",
            name: "category.edit",
            component: CategoryEdit
        },
        {
            path: "/faq/edit/:id",
            name: "faq.edit",
            component: FaqEdit
        }
    ]
});

export default router;
