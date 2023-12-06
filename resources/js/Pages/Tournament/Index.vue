<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">№</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Название команды</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Игры</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Победы</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Ничьи</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Поражения</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Очки</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Голы</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b" v-for="(team, index) in teams" :key="index">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ index + 1 }}</td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ team.title }}</td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ team.gamesTeamAll + team.gamesOpponentAll }}</td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ team.wins }}</td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ team.draws }}</td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ team.losses }}</td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ team.points }}</td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ team.goalsAll }}</td>
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
