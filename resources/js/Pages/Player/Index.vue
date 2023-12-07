<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="w-3/4 max-w-screen-md mx-auto">
                        <thead class="border-b">
                        <tr>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left">№</th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left">Игрок</th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left">Команда</th>
                            <th scope="col" class="text-lg font-bold text-gray-900 px-6 py-4 text-left">Голы</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b" v-for="(player, index) in players" :key="index">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ index + 1 }}</td>

                            <td class="text-sm text-gray-900 font-semibold px-6 py-4 whitespace-nowrap"> <Link :href="route('players.show', player.id)">{{ player.name }} </Link></td>

                            <td v-for="(team) in player.teams" class="flex items-center">
                                <img v-if="team.image" :src="team.image" alt="Team Icon" style="width: 50px; height: auto;" class="mr-2">
                                <span class="text-sm text-gray-900 font-semibold">{{ team.title }}</span>
                            </td>
                            <td class="text-sm text-gray-900 font-semibold px-6 py-4 whitespace-nowrap">{{ player.goalsAll }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
</template>





<!--    <div class="max-w-screen-md w-full mx-auto">-->
<!--        <div class="mb-6 pb-6 border-b border-gray-400" v-for="player in players" :key="player.id">-->
<!--            <Link :href="route('players.show', player.id)">-->
<!--                <h1 style="word-break: break-word;" class="pb-4 text-xl link-text">{{ player.name }}</h1>-->
<!--            </Link>-->
<!--        </div>-->
<!--    </div>-->


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
.max-width-table {
    max-width: 800px; /* Измените значение в соответствии с вашими предпочтениями */
    margin: auto; /* Центрирование таблицы */
}
</style>
