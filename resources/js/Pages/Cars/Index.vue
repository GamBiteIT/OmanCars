<template>
  <div>
    <Head title="Cars" />
    <h1 class="mb-8 text-3xl font-bold">Cars</h1>
     <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
      </search-filter>
      <Link class="btn-indigo" href="/cars/create">
        <span>Create</span>
        <span class="hidden md:inline">&nbsp;Car</span>
      </Link>
    </div>
  <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Brand</th>
          <th class="pb-4 pt-6 px-6">Model</th>
          <th class="pb-4 pt-6 px-6">Registration Number</th>
          <th class="pb-4 pt-6 px-6">Year</th>
          <th class="pb-4 pt-6 px-6" colspan="2">Color</th>
        </tr>
        <tr v-for="car in cars" :key="car.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/cars/${car.id}/edit`">
              <img v-if="car.photo" class="block -my-2 mr-2 w-5 h-5 rounded-full" :src="car.photo" />
              {{ car.brand }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/cars/${car.id}/edit`">
              {{ car.model }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/cars/${car.id}/edit`" tabindex="-1">
              {{ car.registration_number }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/cars/${car.id}/edit`" tabindex="-1">
              {{ car.year}}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/cars/${car.id}/edit`" tabindex="-1">
              {{ car.color}}
            </Link>
          </td>
          <td class="w-px border-t">
            <Link class="flex items-center px-4" :href="`/cars/${car.id}/edit`" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </Link>
          </td>
        </tr>
        <tr v-if="cars.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No cars found.</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Icon from '@/Shared/Icon.vue'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout.vue'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import SearchFilter from '@/Shared/SearchFilter.vue'

export default {
  components: {
    Head,
    Icon,
    Link,
    SearchFilter,
  },
  layout: Layout,
  props: {
    filters: Object,
    cars: Array,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/cars', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
}
</script>
