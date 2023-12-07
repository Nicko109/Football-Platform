<template>
    <div class="flex flex-wrap">
        <div
            class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 mb-6 pb-6 sm:px-3 md:px-4 lg:px-6 mx-auto"
            v-for="team in teams"
            :key="team.id"
        >
            <Link :href="route('team.show', team.id)" class="block">
                <div class="pb-4">
                    <img class="w-full h-50 object-cover" :src="team.image" :alt="team.id">
                    <h1 class="pb-4 text-xl link-text text-center">{{ team.title }}</h1>
                </div>

            </Link>
        </div>
    </div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Link } from "@inertiajs/vue3";
import axios from "axios";

export default {
    name: "Index",

    props: ["teams", "isAdmin"],
    data() {
        return {
            errors: {},
        };
    },

    components: { Link },

    layout: MainLayout,
};
</script>
<style scoped>
/* Ваши стили для таблицы оставьте здесь */

/* Добавьте стиль для фоновой картинки */
body {
    background-image: url('http://127.0.0.1:8000/storage/team/Q3ud1SWWZEWlDNU2mSFQT5dJbmqnMHdYyPy57fTm.png');
    background-size: cover; /* Заполнение фона по размеру окна */
    background-position: center center; /* Позиционирование фона по центру */
    background-attachment: fixed; /* Фиксация фона при прокрутке */
    /* Добавьте другие стили, если необходимо */
}
</style>
