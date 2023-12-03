<template>
    <div class="max-w-screen-md w-full mx-auto">
        <div class="form-group mb-4">
            <Link :href="route('notes.index')" class="inline-block bg-sky-600 px-3 py-2 text-white">Назад</Link>
        </div>
        <h1 style="word-break: break-word;" class="pb-4 text-xl">{{note.title}}</h1>
        <div class="flex justify-between items-center mt-2">
            <p class="text-right text-sm text-slate-500">{{note.date}}</p>
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

</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";
import axios from "axios";

export default {
    name: "Show",

    props:['note', "isAdmin"],
    data() {
        return {
            errors: [],
        };
    },

    components: {Link},


    layout: MainLayout
}
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
