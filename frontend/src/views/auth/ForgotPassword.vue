<template>
  <section id="loginPage" style="background-image: url('images/bgLogin.jpg')">
    <div class="loginContent">
      <div class="loginCard">
        <div
          class="decor"
          style="background-image: url('./assets/images/building.jpg')"
        >
          <div class="content">
            <span class="logo">
              <img src="images/logo.svg" alt="" />
            </span>
            <span class="dots">
              <span></span>
              <span></span>
              <span></span>
            </span>
            <span class="description">
              <p>
                Os melhores e mais completos cursos de Laravel do Brasil, cursos
                com projetos reais. Do zero ao profissional.
              </p>
            </span>
            <span class="copyright fontSmall">
              Todos os Direitos reservados - <b>Especializati</b>
            </span>
          </div>
        </div>
        <div class="login">
          <div class="content">
            <span class="logo">
              <img src="images/logoDark.svg" alt="" />
            </span>
            <span>
              <p>Seja muito bem vindo!</p>
            </span>
            <span class="dots">
              <span></span>
              <span></span>
              <span></span>
            </span>
            <span class="description">
              Acesse nossa plataforma e desfrute de cursos completos para sua
              especialização.
            </span>
            <form action="#" method="POST">
              <div class="groupForm">
                <i class="far fa-envelope"></i>
                <input
                  type="email"
                  name="email"
                  placeholder="Email"
                  v-model="email"
                  required
                />
              </div>
              <button
                :class="['btn', 'primary', loading ? 'loading' : '']"
                type="submit"
                @click.prevent="forgotPassword"
              >
                <span v-if="loading">Enviando...</span>
                <span v-else>Recuperar Senha</span>
              </button>
            </form>
            <span>
              <p class="fontSmall">
                Acessar?
                <router-link :to="{ name: 'auth' }" class="link primary"
                  >Clique aqui</router-link
                >
              </p>
            </span>
          </div>
          <span class="copyright fontSmall">
            Todos os Direitos reservados - <b>Especializati</b>
          </span>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { useUserStore } from "@/stores/UserStore";
import { ref } from "vue";
import router from "@/router";

export default {
  name: "ForgotPassword",
  setup() {
    const userStore = useUserStore();

    const email = ref("");
    const loading = ref(false);

    const forgotPassword = () => {
      loading.value = true;

      userStore
        .forgotPassword(email.value)
        .then(() => router.push({ name: "campus.home" }))
        .catch((error) => alert(error.data.email))
        .finally(() => (loading.value = false));
    };

    return {
      forgotPassword,
      email,
      loading,
    };
  },
};
</script>

<style scoped></style>
