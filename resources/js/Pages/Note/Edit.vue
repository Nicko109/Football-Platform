<template>
    <div class="max-w-screen-md w-full mx-auto">
        <div class="form-group mb-4">
            <Link :href="route('notes.index')" class="inline-block bg-sky-600 px-3 py-2 text-white">Назад</Link>
        </div>
        <div class="mb-4">
            <textarea rows="8" cols="80" v-model="title" class="border-gray-300 mt-1 p-2 w-full border rounded-md"  type="text"></textarea>
            <div v-if="errors.title" class="text-red-600 text-sm">{{ errors.title }}</div>
        </div>
        <div class="form-group mb-4">
            <a @click.prevent="update" href="#" class="inline-block bg-green-600 px-3 py-2 text-white">Редактировать</a>
        </div>
    </div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {router} from "@inertiajs/vue3";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Edit",

    layout: MainLayout,

    components: {Link},

    props: ['note', 'errors'],

    data() {
        return {
            title: this.note.title,
        }
    },

    methods: {
        update() {
            router.patch(`/notes/${this.note.id}`, {title: this.title})
        }
    }

}
</script>

<style scoped>

</style>
