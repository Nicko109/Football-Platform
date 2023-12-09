<template>
  <div class="flex justify-center items-center mb-6">
    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
      <Link v-for="(link, k) in links" :key="k"
            :href="link.url"
            v-html="link.label"
            :class="{'text-blue-500 font-bold' : link.active}"
            :disabled="link.url === null"
            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 text-decoration-none">
      </Link>
    </nav>
  </div>
</template>
<script>

import {Link} from "@inertiajs/vue3";


export default {
  components: {
    Link
  },
  props: {
    links: Array,
  }
}
</script>