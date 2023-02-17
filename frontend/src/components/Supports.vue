<template>
  <div class="content">
    <div class="card" v-for="support in supports.data" :key="support.id">
      <div class="commentContent main">
        <span class="avatar">
          <img :src="UserImage" :alt="support.user.name" />
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
        <button class="btn primary">
          <span
            v-if="showSupport === support.id"
            @click.prevent="showSupport = '0'"
            >Ocultar respostas</span
          >
          <span v-else @click.prevent="showSupport = support.id"
            >Exibir respostas (total:
            {{ support.replies ? support.replies.length : 0 }})</span
          >
        </button>
      </div>
      <div class="answersContent" v-show="showSupport === support.id">
        <div
          :class="[
            'commentContent',
            { rightContent: support.user.id !== reply.user.id },
          ]"
          v-for="reply in support.replies"
          :key="reply.id"
        >
          <span class="avatar" v-if="support.user.id === reply.user.id">
            <img :src="UserImage" alt="" />
          </span>
          <div class="comment">
            <div class="balloon">
              <span class="fas fa-sort-down"></span>
              <span class="owner">
                {{ reply.user.name }} - {{ reply.created_at }}
              </span>
              <span class="text">
                {{ reply.description }}
              </span>
            </div>
          </div>
          <span class="avatar" v-if="support.user.id !== reply.user.id">
            <img :src="UserImageTwo" alt="" />
          </span>
        </div>
        <span class="answer">
          <button
            class="btn primary"
            @click.prevent="openModalReplySupport(support.id)"
          >
            Responder
          </button>
        </span>
      </div>
    </div>
    <support-modal
      @close-modal="modal.showModal = false"
      :show-modal="modal.showModal"
      :support-reply="modal.supportReply"
    />
  </div>
</template>

<script>
import { useSupportStore } from "@/stores/SupportStore";
import { computed, ref } from "vue";
import UserImage from "@/assets/images/avatars/user01.svg";
import UserImageTwo from "@/assets/images/avatars/user02.svg";
import SupportModal from "@/components/SupportModal.vue";

export default {
  name: "Supports",
  components: { SupportModal },
  setup() {
    const supportStore = useSupportStore();

    const showSupport = ref("0");

    const supports = computed(() => supportStore.supports);

    const modal = ref({
      showModal: false,
      supportReply: "",
      supportReplyTitle: "",
    });

    const openModalReplySupport = (supportId) => {
      modal.value.showModal = true;
      modal.value.supportReply = supportId;
    };

    return {
      supports,
      UserImage,
      UserImageTwo,
      showSupport,
      modal,
      openModalReplySupport,
    };
  },
};
</script>
