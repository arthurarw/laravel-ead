<template>
  <section id="loginPage">
    <div class="loginContent">
      <div class="loginCard">
        <div class="decor">
          <div class="content">
            <span class="logo">
              <img src="#" alt="" />
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
              <img src="#" alt="" />
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
                  placeholder="E-mail"
                  v-model="email"
                  required
                />
              </div>
              <div class="groupForm">
                <i class="far fa-key"></i>
                <input
                  type="password"
                  name="password"
                  placeholder="Senha"
                  v-model="password"
                  required
                />
                <i class="far fa-eye buttom"></i>
              </div>
              <button
                :class="['btn', 'primary', loading ? 'loading' : '']"
                type="submit"
                @click.prevent="auth"
              >
                <span v-if="loading">Enviando...</span>
                <span v-else>Login</span>
              </button>
            </form>
            <span>
              <p class="fontSmall">
                Esqueceu sua senha?
                <router-link
                  :to="{ name: 'forgot.password' }"
                  class="link primary"
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
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Auth",

  setup() {
    const userStore = useUserStore();
    const email = ref("");
    const password = ref("");
    const loading = ref(false);

    const auth = () => {
      loading.value = true;

      userStore
        .auth({
          email: email.value,
          password: password.value,
          device_name: "Chrome-PC-Arthur",
        })
        .then(() => router.push({ name: "campus.home" }))
        .catch((error) => console.log(error))
        .finally(() => (loading.value = false));
    };

    return {
      auth,
      email,
      password,
      loading,
    };
  },
};
</script>

<style scoped></style>
