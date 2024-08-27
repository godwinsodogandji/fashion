
<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
const form = useForm({
  title: "",
  body: "",

});
</script>
 
<template>
  <AuthenticatedLayout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
      <form method="post"
        @submit.prevent="
          form.post(route('article.create'), { onSuccess: () => form.reset() })
        "
      >
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
        <input type="file"
          placeholder="Choisir une image"
          class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />

        <InputError :message="form.errors.image" class="mt-2 mx-3" />

        <PrimaryButton class="mt-4">Sauvegarder</PrimaryButton>

      </form>
    </div>
  </AuthenticatedLayout>
</template>
