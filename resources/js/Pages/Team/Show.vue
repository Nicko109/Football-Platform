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

                            <td class="flex items-center">

                                <Link :href="route('team.show', team.id)"> <img v-if="team.image" :src="team.image" alt="Team Icon" style="width: 50px; height: auto;" class="mr-2"> </Link>
                                <Link :href="route('team.show', team.id)"><span class="text-sm text-gray-900 font-semibold">{{ team.title }}</span></Link>

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

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";
import axios from "axios";

export default {
    name: "Show",

    props:['team', "isAdmin", 'players'],
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
