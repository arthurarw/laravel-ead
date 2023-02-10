<template>
  <div class="content">
    <div class="card" v-for="support in supports.data" :key="support.id">
      <div class="commentContent main">
        <span class="avatar">
          <img src="images/avatars/user01.svg" :alt="support.user.name" />
        </span>
        <div class="comment">
          <div class="balloon">
            <span class="fas fa-sort-down"></span>
            <span class="owner">
              {{ support.user.name }} - {{ support.updated_at }}
            </span>
            <span class="text">
              {{ support.description }}
            </span>
          </div>
        </div>
        <button class="btn primary">Ocultar respostas</button>
      </div>
      <div
        class="answersContent"
        v-for="reply in support.replies"
        :key="reply.id"
      >
        <div class="commentContent rightContent">
          <div class="comment">
            <div class="balloon">
              <span class="fas fa-sort-down"></span>
              <span class="owner"
                >{{ reply.user.name }} - {{ reply.created_at }}</span
              >
              <span class="text">
                {{ reply.description }}
              </span>
            </div>
          </div>
          <span class="avatar">
            <img src="images/avatars/user03.svg" alt="" />
          </span>
        </div>
        <div class="commentContent">
          <span class="avatar">
            <img src="images/avatars/user01.svg" alt="" />
          </span>
          <div class="comment">
            <div class="balloon">
              <span class="fas fa-sort-down"></span>
              <span class="owner">Fernando - 07/10/2021</span>
              <span class="text">
                In eleifend urna sapien, faucibus pharetra justo luctus quis.
                Vivamus eleifend fringilla massa
              </span>
            </div>
          </div>
        </div>
        <span class="answer">
          <button class="btn primary">Responder</button>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import { useSupportStore } from "@/stores/SupportStore";
import { computed } from "vue";

export default {
  name: "Supports",
  setup() {
    const supportStore = useSupportStore();

    const supports = computed(() => supportStore.supports);

    return {
      supports,
    };
  },
};
</script>
