<template>
    <div class="max-w-screen-md w-full mx-auto">
        <div v-if="isAdmin" class="form-group mb-4 flex items-center justify-between mb-6 pb-6 border-b border-gray-400">
            <h1 style="color: blue">Игроки</h1>
            <Link :href="route('players.create')" class="inline-block bg-sky-600 px-3 py-2 text-white">Добавить</Link>
        </div>
        <div class="mb-6 pb-6 border-b border-gray-400" v-for="player in players" :key="player.id">
            <Link :href="route('players.show', player.id)">
                <h1 style="word-break: break-word;" class="pb-4 text-xl link-text">{{ player.name }}</h1>
            </Link>
            <div v-if="isAdmin" class="form-group my-4 flex items-center">
                <Link :href="route('players.edit', player.id)" class="inline-block bg-green-600 px-3 py-2 text-white">
                    Редактировать
                </Link>
                <Link as="button" method="delete" :href="route('players.destroy', player.id)" class="inline-block bg-rose-600 px-3 py-2 text-white ml-2">
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

    props: ["players", "isAdmin"],
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
