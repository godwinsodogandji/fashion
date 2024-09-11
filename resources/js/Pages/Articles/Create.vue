
<script setup>
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
let articleImage = {};

const form = useForm({
  title: "",
  body: "",
  image: null, // L'image sera gérée séparément
});

function dataForm() {
  // Crée un nouvel objet FormData
  const formData = new FormData();
  formData.append("title", form.title);
  formData.append("body", form.body);

  // Si une image est sélectionnée, l'ajouter à FormData
  if (form.image) {
    formData.append("image", form.image);
  }

  // Envoyer le formulaire via une requête POST avec FormData
  form.post(route("articles.store"), {
    data: formData,
    onSuccess: () => form.reset(),
    headers: {
      "Content-Type": "multipart/form-data",
    },
  });
}

function getImage(e) {
  let files = e.target.files;
  if (files.length > 0) {
    form.image = files[0]; // On ne prend que le premier fichier sélectionné
  }
}
</script>

<template>
  <AuthenticatedLayout>
    <div class="max-w-sm mx-auto">
      <form @submit.prevent="dataForm()">
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
            @change="getImage($event)"
            placeholder="Choisir une image"
            id="image"
            name="image"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3"
          />

          <InputError :message="form.errors.image" class="mt-2 mx-3" />
        </div>
        <PrimaryButton class="mt-4">Sauvegarder</PrimaryButton>
      </form>

      <div class="mt-6 bg-white shadow-sm rounded-lg divide-y"></div>
    </div>
  </AuthenticatedLayout>
</template>
