<template>
    <div class="max-w-screen-md w-full mx-auto">
        <div class="form-group mb-4">
            <Link :href="route('players.index')" class="inline-block bg-sky-600 px-3 py-2 text-white">Назад</Link>
        </div>
        <div class="flex items-center">
            <div class="w-2/3">
                <h1 style="word-break: break-word;" class="pb-4 text-xl">{{ player.name }}</h1>
                <div class="card">
                    <div class="card-body table-responsive p-0">
                                <p><b>Голы:</b> {{ player.goalsAll }}</p>
                        <div v-if="player.meta">
                            <div v-for="(value, key) in player.meta" :key="key">
                                <p><b>{{ key }}:</b> {{ value }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ml-4">
                <div v-if="player.image">
                    <img :src="player.image" :alt="player.name">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Link } from "@inertiajs/vue3";

export default {
    name: "Show",

    props: ['player', 'isAdmin'],
    components: { Link },
    layout: MainLayout
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
