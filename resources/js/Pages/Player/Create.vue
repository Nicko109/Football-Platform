<template>
    <div class="max-w-screen-md w-full mx-auto">
    <div class="form-group mb-4">
        <Link :href="route('players.index')" class="inline-block bg-sky-600 px-3 py-2 text-white">Назад</Link>
    </div>
    <div class="mb-4">
        <input v-model="name" class="border-gray-300 mt-1 p-2 w-full border rounded-md"  type="text" placeholder="Добавить игрока">
        <div v-if="errors.name" class="text-red-600 text-sm">{{ errors.name }}</div>
    </div>
    <div class="form-group mb-4">
        <a @click.prevent="store" href="#" class="inline-block bg-sky-600 px-3 py-2 text-white">Добавить</a>
    </div>
</div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {router} from "@inertiajs/vue3";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Create",

    layout: MainLayout,

    props: [
        'errors'
    ],

    components: {Link},

    data() {
        return {
            name: '',
        }
    },

    methods: {
        store() {
            router.post('/players', {name: this.name})
        }
    }

}
</script>

<style scoped>

</style>
