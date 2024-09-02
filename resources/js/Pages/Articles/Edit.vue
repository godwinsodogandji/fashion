<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import InputError from '@/Components/InputError.vue';

const props = defineProps(['article']);

// Initialisez le formulaire avec les données de l'article existant
const form = useForm({
  title: props.article.title,
  body: props.article.body,
  // Ajoutez ici d'autres champs si nécessaire
});

// Méthode de soumission du formulaire
const submit = () => {
  form.put(route('articles.update', props.article.id), {
    onSuccess: () => form.reset(),
  });
};
</script>

<template>
  <AuthenticatedLayout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
      <form @submit.prevent="submit">
        <input
          v-model="form.title"
          placeholder="Entrer un titre"
          class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />
        <InputError :message="form.errors.title" class="mt-2" />

        <textarea
          v-model="form.body"
          placeholder="Entrer un texte"
          class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />

        <InputError :message="form.errors.body" class="mt-2 mx-3" />

        <input
          type="file"
          placeholder="Choisir une image"
          class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />

        <InputError :message="form.errors.image" class="mt-2 mx-3" />

        <PrimaryButton class="mt-4">Sauvegarder</PrimaryButton>
      </form>

      <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        <!-- Contenu supplémentaire si nécessaire -->
      </div>
    </div>
  </AuthenticatedLayout>
</template>
