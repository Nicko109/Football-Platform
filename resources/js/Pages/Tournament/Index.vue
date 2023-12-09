<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="w-50 mx-auto" >
                        <thead class="border-b">
                        <tr>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left">№</th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left"></th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left">Название команды</th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left">Игры</th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left">Победы</th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left">Ничьи</th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left">Поражения</th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left">Очки</th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left">Голы</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b" v-for="(team, index) in teams" :key="index">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"> <Link :href="route('team.show', team.id)" class="block"><img style="width: 50px; height: auto;" :src="team.image" :alt="team.id"> </Link></td>
                            <td class="text-sm text-gray-900 font-semibold px-6 py-4 whitespace-nowrap"><Link :href="route('team.show', team.id)" class="block">{{ team.title }}</Link></td>
                            <td class="text-sm text-gray-900 font-semibold px-6 py-4 whitespace-nowrap">{{ team.gamesTeamAll + team.gamesOpponentAll }}</td>
                            <td class="text-sm text-gray-900 font-semibold px-6 py-4 whitespace-nowrap">{{ team.wins }}</td>
                            <td class="text-sm text-gray-900 font-semibold px-6 py-4 whitespace-nowrap">{{ team.draws }}</td>
                            <td class="text-sm text-gray-900 font-semibold px-6 py-4 whitespace-nowrap">{{ team.losses }}</td>
                            <td class="text-sm text-gray-900 font-semibold px-6 py-4 whitespace-nowrap">{{ team.points }}</td>
                            <td class="text-sm text-gray-900 font-semibold px-6 py-4 whitespace-nowrap">{{ team.goalsAll }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


  <Pagination :links="paginationLinks.links"/>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Link } from "@inertiajs/vue3";
import Pagination from "@/Pages/Pagination/Pagination.vue";
import axios from "axios";

export default {
    name: "Index",

  props: {
    paginationLinks: Array,
    teams: Array,
    isAdmin: Boolean,
  },
    data() {
        return {
            errors: {},
        };
    },

  components: {Pagination, Link},

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
