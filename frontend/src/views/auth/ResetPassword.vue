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
                @click.prevent="resetPassword"
              >
                <span v-if="loading">Alterando...</span>
                <span v-else>Atualizar Senha</span>
              </button>
            </form>
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
import { ref } from "vue";
import router from "@/router";
import AuthService from "@/services/AuthService";
import { notify } from "@kyvg/vue3-notification";

export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "ResetPassword",
  props: {
    token: {
      require: true,
    },
  },
  setup(props) {
    const email = ref("");
    const password = ref("");
    const loading = ref(false);

    const resetPassword = () => {
      loading.value = true;

      AuthService.resetPassword(email.value, password.value, props.token)
        .then(() => {
          notify({
            title: "Senha alterada com sucesso!",
            text: "Você pode acessar novamente com sua nova senha.",
            type: "success",
          });
          router.push({ name: "auth" });
        })
        .catch((error) => {
          let msgError = "Falha ao alterar a senha.";
          let data = error.data;

          if (data.email) {
            msgError = data.email;
          }

          if (data.token) {
            msgError = data.token;
          }

          if (data.password) {
            msgError = data.password;
          }

          notify({
            title: "Ooops!!",
            text: msgError,
            type: "error",
          });
        })
        .finally(() => (loading.value = false));
    };

    return {
      resetPassword,
      email,
      password,
      loading,
    };
  },
};
</script>

<style scoped></style>
