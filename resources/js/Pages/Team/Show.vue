<template>
    <div class="max-w-screen-md w-full mx-auto">
        <div class="form-group mb-4">
            <Link :href="route('team.index')" class="inline-block bg-sky-600 px-3 py-2 text-white">Назад</Link>
        </div>
    </div>
    <div v-if="team.id">
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-wrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Команда</th>
                        <th>Очки</th>
<!--                        <th>Игры</th>-->
<!--                        <th>Голы</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ team.id }}</td>
                        <td class="text-wrap">{{ team.title }}</td>
                        <td class="text-wrap">{{ team.points }}</td>
<!--                        <td class="text-wrap">{{ team.gamesTeamAll() + team.gamesOpponentAll() }}</td>-->
<!--                        <td class="text-wrap">{{ team.goalsAll() }}</td>-->
                    </tr>
                    </tbody>
                </table>

                <div v-if="team.image">
                    <div><img :src="team.image" :alt="team.name"></div>
                </div>

<!--                <table class="table table-hover text-wrap">-->
<!--                    <label class="ml-3 mt-5">Cостав</label>-->
<!--                    <thead class="mt-4">-->
<!--                    <tr>-->
<!--                        <th>ID</th>-->
<!--                        <th>Имя Игрока</th>-->
<!--                        <th>Голы</th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    <tbody>-->
<!--                    <tr v-for="player in team.players" :key="player.id">-->
<!--                        <td>{{ player.id }}</td>-->
<!--                        <td>{{ player.name }}</td>-->
<!--                        <td>{{ player.goalsAll() }}</td>-->
<!--                    </tr>-->
<!--                    </tbody>-->
<!--                </table>-->
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

    props:['team', "isAdmin"],
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
