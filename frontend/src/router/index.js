import { createRouter, createWebHistory } from "vue-router";
import HomeView from "@/views/home/HomeView.vue";
import MySupports from "@/views/supports/MySupports.vue";
import ModulesAndLessons from "@/views/modules/ModulesAndLessons.vue";
import Auth from "@/views/auth/Auth.vue";
import ForgotPassword from "@/views/auth/ForgotPassword.vue";
import ResetPassword from "@/views/auth/ResetPassword.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/campus",
      component: () => import("@/layouts/DefaultTemplate.vue"),
      children: [
        {
          path: "modulos",
          name: "campus.modules",
          component: ModulesAndLessons,
        },
        {
          path: "minhas-duvidas",
          name: "campus.my.supports",
          component: MySupports,
        },
        {
          path: "",
          name: "campus.home",
          component: HomeView,
        },
      ],
    },
    {
      path: "/",
      name: "auth",
      component: Auth,
    },
    {
      path: "/recuperar-senha",
      name: "forgot.password",
      component: ForgotPassword,
    },
    {
      path: "/reset/:token",
      name: "reset.password",
      component: ResetPassword,
      props: true,
    },
  ],
});

export default router;
