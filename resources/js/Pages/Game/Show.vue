<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="w-50 mx-auto" >
                        <thead class="border-b">
                        <tr>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left">Дата</th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left"></th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left">Название игры</th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left"></th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left">Счёт</th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left">Победитель</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ game.formattedDate }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"> <Link :href="route('team.show', game.team.id)"><img v-if="game.team.image" :src="game.team.image" alt="Team Icon" style="width: 50px; height: auto;" class="mr-2"></Link></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ game.team.title }} - {{ game.opponent.title }}</td>
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

    <!-- Отображаем данные об игроках команды -->
    <div v-if="teamPlayers.length > 0">
        <h2 class="text-lg font-bold text-gray-900 mt-4">Голы команды {{ game.team.title }}</h2>
        <table class="w-3/4 max-w-screen-md mx-auto">
            <table class="w-3/4 max-w-screen-md mx-auto">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя игрока</th>
                    <th>Забитых голов</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="player in teamPlayers" :key="player.id">
                    <td>{{ player.id }}</td>
                    <td>{{ player.name }}</td>
                    <td>{{ player.goals.length }}</td>
                </tr>
                </tbody>
            </table>
        </table>
    </div>

    <!-- Отображаем данные об игроках оппонента -->
    <div v-if="opponentPlayers.length > 0">
        <h2 class="text-lg font-bold text-gray-900 mt-4">Голы команды {{ game.opponent.title }}</h2>
        <table class="w-3/4 max-w-screen-md mx-auto">
            <!-- Ваш код для отображения данных об игроках оппонента -->
        </table>
    </div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Link } from "@inertiajs/vue3";
import axios from "axios";

export default {
    name: "Show",

    props: ["game", "isAdmin", "teamPlayers", "opponentPlayers"],
    data() {
        return {
            errors: [],
        };
    },

    components: { Link },

    layout: MainLayout,
};
</script>

<style scoped>
/* Ваши стили оставьте здесь */
</style>
