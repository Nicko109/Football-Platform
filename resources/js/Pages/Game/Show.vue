<template>
  <div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
        <div class="overflow-hidden">
          <table class="w-50 mx-auto">
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
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                <Link :href="route('team.show', game.team.id)"><img v-if="game.team.image" :src="game.team.image"
                                                                    alt="Team Icon" style="width: 50px; height: auto;"
                                                                    class="mr-2"></Link>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ game.team.title }} -
                {{ game.opponent.title }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                <Link :href="route('team.show', game.opponent.id)"><img v-if="game.opponent.image"
                                                                        :src="game.opponent.image" alt="Team Icon"
                                                                        style="width: 50px; height: auto;" class="ml-2">
                </Link>
              </td>
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
            <div class="flex flex-col">
              <h2 class="text-lg font-bold text-gray-900 mt-4">Голы команды {{ game.team.title }}</h2>
              <div v-for="player in teamPlayers" :key="player.id">
                <p>{{ player.name }} - {{ player.goalsInGame }}</p>
              </div>
            </div>
            <div>
              <h2 class="text-lg font-bold text-gray-900 mt-4">Голы команды {{ game.opponent.title }}</h2>
              <div v-for="player in opponentPlayers" :key="player.id">
                <p>{{ player.name }} - {{ player.goalsInGame }}</p>
              </div>
            </div>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Отображаем данные об игроках команды -->


  <!-- Отображаем данные об игроках оппонента -->

</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";
import axios from "axios";

export default {
  name: "Show",

  props: ["game", "isAdmin", "teamPlayers", "opponentPlayers"],
  data() {
    return {
      errors: [],
    };
  },

  components: {Link},

  layout: MainLayout,
};
</script>

<style scoped>
/* Ваши стили оставьте здесь */
</style>
