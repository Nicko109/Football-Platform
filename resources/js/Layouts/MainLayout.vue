<template>
  <nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="relative flex h-16 items-center justify-between">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button-->\

          <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <!--
              Icon when menu is closed.

              Menu open: "hidden", Menu closed: "block"
            -->
            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!--
              Icon when menu is open.

              Menu open: "block", Menu closed: "hidden"
            -->
            <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex flex-shrink-0 items-center">
            <img class="h-10 w-auto" src="http://127.0.0.1:8000/storage/team/c03ko3ewAPzL6LnN2wqu01SkVyVqGgsELBOEpKkp.png" alt="Your Company">
          </div>
          <div class="hidden sm:ml-6 sm:block">
            <div class="flex space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <Link :href="route('players.index')" class="inline-block px-3 py-2 text-white ">Игроки</Link>
              <Link :href="route('tournament.index')" class="inline-block  px-3 py-2 text-white">Турнир</Link>
              <Link :href="route('team.index')" class="inline-block  px-3 py-2 text-white">Команды</Link>
              <Link :href="route('game.index')" class="inline-block  px-3 py-2 text-white">Игры</Link>
              <a :href="route('admin.main.index')" class="inline-block  px-3 py-2 text-white" v-if="isAdmin">Админ</a>

            </div>
          </div>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
          <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
            <Link as="button" method="post" :href="route('logout')" class="inline-block  px-3 py-2 text-white">Выйти</Link>
          </button>
        </div>
      </div>
    </div>
  </nav>

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
