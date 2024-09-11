<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

const props = defineProps(["article"]);

// Initialisez le formulaire avec les données de l'article existant
const form = useForm({
  title: props.article.title,
  body: props.article.body,
  // Ajoutez ici d'autres champs si nécessaire
});

// Méthode de soumission du formulaire
const submit = () => {
  form.put(route("articles.update", props.article.id), {
    onSuccess: () => form.reset(),
  });
};
</script>

<template>
  <AuthenticatedLayout>
    <div>
      <form @submit.prevent="submit" class="max-w-sm mx-auto">
        <div class="mb-5">
          <input
            v-model="form.title"
            placeholder="Entrer un titre"
            class="mt-5 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
          />
          <InputError :message="form.errors.title" class="mt-2" />

          <textarea
            v-model="form.body"
            placeholder="Entrer un texte"
            class="mt-3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
          />

          <InputError :message="form.errors.body" class="mt-2 mx-3" />

          <input
            type="file"
            placeholder="Choisir une image"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3"
          />

          <InputError :message="form.errors.image" class="mt-2 mx-3" />

          <PrimaryButton class="mt-4">Sauvegarder</PrimaryButton>
        </div>
      </form>

      <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        <!-- Contenu supplémentaire si nécessaire -->
      </div>
    </div>
  </AuthenticatedLayout>
</template>
