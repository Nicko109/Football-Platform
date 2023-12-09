<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="w-50 mx-auto" >
                        <thead class="border-b">
                        <tr>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left">№</th>
                          <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left text-center">Дата</th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left"></th>
                          <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left text-center">Название игры</th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left"></th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left">Счёт</th>
                          <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left text-center">Победитель</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b" v-for="(game, index) in games" :key="index">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ game.formattedDate }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"> <Link :href="route('team.show', game.team.id)"><img v-if="game.team.image" :src="game.team.image" alt="Team Icon" style="width: 50px; height: auto;" class="mr-2"></Link></td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center"> <Link :href="route('game.show', game.id)">{{ game.team.title }} - {{ game.opponent.title }}</Link></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><Link :href="route('team.show', game.opponent.id)"><img v-if="game.opponent.image" :src="game.opponent.image" alt="Team Icon" style="width: 50px; height: auto;" class="ml-2"></Link></td>
                            <td class="text-sm text-gray-900 font-semibold px-6 py-4 whitespace-nowrap text-center">
                                <template v-if="game.is_active">
                                    {{ game.teamGoalsCount }} - {{ game.opponentGoalsCount }}
                                </template>
                                <template v-else>
                                    -:-
                                </template>
                            </td>
                            <td class="text-sm text-gray-900 font-semibold px-6 py-4 whitespace-nowrap text-center">
                                <template v-if="game.is_active">
                                    {{ game.winner }}
                                </template>
                                <template v-else>
                                    -:-
                                </template>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Link } from "@inertiajs/vue3";
import axios from "axios";

export default {
    name: "Index",

    props: ["isAdmin", 'games'],
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
