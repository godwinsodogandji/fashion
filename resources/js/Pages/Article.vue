<script setup>
import NavLink from "@/Components/NavLink.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { defineProps } from "vue";
defineProps(["articles"]);
</script>

<template>
  <AuthenticatedLayout>
    <NavLink
      :href="route('article.create')"
      class="text-black p-2 rounded-lg text-xl hover:bg-bl-500 mx-3 mb-3"
    >
      Créer un article
    </NavLink>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
      <div
        class="grid gap-4 mt-3 mx-3"
        v-for="article in articles"
        :key="article.id"
        :article="article"
      >
         <!-- Lier le chemin de l'image à l'attribut src -->
         <img
          :src="`/storage/${article.image }`"
          alt="Image de couverture"

          class="max-w-sm rounded border bg-white p-1 dark:border-neutral-700 dark:bg-neutral-800"
        />
        <h1

        >
          {{ article.title }}
        </h1>
        <p >{{ article.body }}</p>
        <NavLink
          :href="route('articles.edit', article.id)"
          class="bg-blue-400 text-white p-2 rounded-lg text-xl mt-3 "
        >
          Editer l'article
        </NavLink>
        <NavLink
          as="button"
          :href="route('articles.destroy', article.id)"
          method="delete"
          class="bg-red-500 text-white p-2 rounded-lg text-xl hover:bg-red-600 mt-2"
        >
          Supprimer
        </NavLink>
      </div>
    </div>
  </AuthenticatedLayout>
</template>




