<script setup>
import dayjs from 'dayjs';
import Dropdown from '@/Components/Dropdown.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import relativeTime from 'dayjs/plugin/relativeTime';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
dayjs.extend(relativeTime);
const props = defineProps(['chirp']);

const form = useForm({
    title:props.article.title,
    message: props.article.body,
});


</script>

<template>
    <div class="p-6 flex space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
        <div class="flex-1">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-gray-800">{{ article.user.name }}</span>
                    <small class="ml-2 text-sm text-gray-600">{{ new Date(article.created_at).toLocaleString() }}</small>
                    <small class="ml-2 text-sm text-gray-600">{{ dayjs(article.created_at).fromNow() }}</small>
                    <small v-if="article.created_at !== article.updated_at" class="text-sm text-gray-600"> &middot; edited</small>
                </div>
            </div>
            <p class="mt-4 text-lg text-gray-900">{{ article.body }}</p>

            <form v-if="editing" @submit.prevent="form.put(route('chirps.update', chirp.id), { onSuccess: () => editing = false })">
                <textarea v-model="form.body" class="mt-4 w-full text-gray-900 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                <InputError :message="form.errors.message" class="mt-2" />
                <div class="space-x-2">
                    <PrimaryButton class="mt-4">Save</PrimaryButton>

                </div>
            </form>
            <p v-else class="mt-4 text-lg text-gray-900">{{ article.body }}</p>
        </div>
    </div>
</template>
