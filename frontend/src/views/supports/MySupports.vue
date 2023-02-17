<template>
  <div>
    <div class="pageTitle">
      <span class="title">Minhas Dúvidas</span>
      <span class="dots">
        <span></span>
        <span></span>
        <span></span>
      </span>
    </div>

    <div class="content">
      <div class="container">
        <div class="left">
          <div class="card">
            <div class="title bg-laravel">
              <span class="text">Filtros</span>
            </div>
            <div class="modules">
              <ul class="classes">
                <li
                  :class="{ active: status === '' }"
                  @click="getMySupportsWithStatus('')"
                >
                  Todos
                </li>
                <li
                  :class="{ active: status === 'O' }"
                  @click="getMySupportsWithStatus('O')"
                >
                  Aguardando Minha Resposta
                </li>
                <li
                  :class="{ active: status === 'P' }"
                  @click="getMySupportsWithStatus('P')"
                >
                  Aguardando Professor
                </li>
                <li
                  :class="{ active: status === 'C' }"
                  @click="getMySupportsWithStatus('C')"
                >
                  Finalizados
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="right">
          <div class="content">
            <div class="comments">
              <supports />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Supports from "@/components/Supports.vue";
import { onMounted, ref } from "vue";
import { useSupportStore } from "@/stores/SupportStore";
import { notify } from "@kyvg/vue3-notification";

export default {
  name: "MySupports",
  components: { Supports },

  setup() {
    const supportStore = useSupportStore();
    const status = ref("");

    let params = {
      status: status.value,
    };

    onMounted(() => {
      supportStore
        .getMySupports(params)
        .then(() => {
          notify({
            title: "Dúvidas carregadas com sucesso!",
            text: "",
            type: "success",
          });
        })
        .finally(() => {
          notify({
            title: "Ooops! Você não tem nenhuma dúvida cadastrada.",
            text: "",
            type: "warning",
          });
        });
    });

    const getMySupportsWithStatus = (newStatus) => {
      status.value = newStatus;

      params = {
        status: status.value,
      };

      supportStore.getMySupports(params);
    };

    return {
      getMySupportsWithStatus,
      status,
    };
  },
};
</script>
