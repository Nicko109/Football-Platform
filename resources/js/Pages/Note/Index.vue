<template>
    <div class="max-w-screen-md w-full mx-auto">
        <div v-if="isAdmin" class="form-group mb-4 flex items-center justify-between mb-6 pb-6 border-b border-gray-400">
            <h1 style="color: blue">Заметки</h1>
            <Link :href="route('notes.create')" class="inline-block bg-sky-600 px-3 py-2 text-white">Добавить</Link>
        </div>
        <div class="mb-6 pb-6 border-b border-gray-400" v-for="note in notes" :key="note.id">
            <Link :href="route('notes.show', note.id)">
                <h1 style="word-break: break-word;" class="pb-4 text-xl link-text">{{ note.title }}</h1>
            </Link>
            <p class="pb-4">{{ note.content }}</p>
            <div class="flex justify-between items-center mt-2">
                <p class="text-right text-sm text-slate-500">{{ note.date }}</p>
            </div>

            <div v-if="isAdmin" class="form-group my-4 flex items-center">
                <Link :href="route('notes.edit', note.id)" class="inline-block bg-green-600 px-3 py-2 text-white">
                    Редактировать
                </Link>
                <Link as="button" method="delete" :href="route('notes.destroy', note.id)" class="inline-block bg-rose-600 px-3 py-2 text-white ml-2">
                    Удалить
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";
import axios from "axios";

export default {
    name: "Index",

    props: ["notes", "isAdmin"],
    data() {
        return {
            errors: {},
        };
    },

    components: {Link},


    layout: MainLayout,
};
</script>

<style scoped>
.link-text {
    font-size: medium;
    transition: color 0.3s;
    cursor: pointer;
}

.link-text:hover {
    color: blue;
}
</style>
