<template>
    <div class="flex justify-between p-8 max-w-screen-md w-full mx-auto">
        <div class="form-group mb-4">
            <Link :href="route('players.index')" class="inline-block bg-sky-600 px-3 py-2 text-white">Игроки</Link>
        </div>
        <div class="form-group mb-4">
            <Link :href="route('tournament.index')" class="inline-block bg-green-600 px-3 py-2 text-white">Турнир</Link>
        </div>
        <div v-if="isAdmin" class="form-group mb-4">
            <a :href="route('admin.main.index')" class="inline-block bg-orange-600 px-3 py-2 text-white">Админ</a>
        </div>
        <div class="form-group mb-4">
            <Link as="button" method="post" :href="route('logout')" class="inline-block bg-rose-600 px-3 py-2 text-white">Выйти</Link>
        </div>
    </div>
    <hr class="mb-4">
    <slot />

</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    name: "MainLayout",


    props: ["isAdmin"],
    components: { Link },

}
</script>

<style scoped>

</style>
