<script setup>
import NavLink from "@/Components/NavLink.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { defineProps } from "vue";
defineProps(["articles"]);
</script>

<template>
  <AuthenticatedLayout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Bienvenu sur le composant article
    </h2>
    <NavLink
      :href="route('article.create')"
      class="bg-blue-500 text-white p-2 rounded-lg text-xl hover:bg-indigo-500"
    >
      Créer un article
    </NavLink>

    <h1>Affichage des articles</h1>

    <div>
      <div
        class="card-body"
        v-for="article in articles"
        :key="article.id"
        :article="article"
      >
        <h2>{{ article.title }}</h2>
        <small>{{ article.body }}</small>
        <NavLink
          :href="route('articles.edit', article.id)"
          class="bg-blue-500 text-white p-2 rounded-lg text-xl"
        >
          Editer l'article
        </NavLink>
        <NavLink as="button" :href="route('articles.destroy', article.id)" method="delete"

          class="bg-red-500 text-white p-2 rounded-lg text-xl hover:bg-red-600"
        >
          Supprimer
        </NavLink>
      </div>
    </div>
  </AuthenticatedLayout>
</template>




