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
                <input type="email" name="email" placeholder="Email" required />
              </div>
              <div class="groupForm">
                <i class="far fa-key"></i>
                <input
                  type="password"
                  name="password"
                  placeholder="Senha"
                  required
                />
                <i class="far fa-eye buttom"></i>
              </div>
              <button class="btn primary" type="submit" @click.prevent="auth">
                Login
              </button>
            </form>
            <span>
              <p class="fontSmall">
                Esqueceu sua senha?
                <router-link
                  :to="{ name: 'forget.password' }"
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
import router from "@/router";
import { useUserStore } from "@/stores/UserStore";

export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Auth",

  setup() {
    const userStore = useUserStore();

    const login = () => router.push({ name: "campus.home" });

    const auth = () => {
      userStore.auth({
        email: "arthur@mail.com",
        password: "321321",
        device_name: "Chrome-PC-Arthur",
      });
    };

    return {
      login,
      auth,
    };
  },
};
</script>

<style scoped></style>
