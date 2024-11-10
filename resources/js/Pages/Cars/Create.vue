<template>
  <div>
    <Head title="Create Cars" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/cars">Cars</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.brand" :error="form.errors.brand" class="pb-8 pr-6 w-full lg:w-1/2" label="Brand" />
          <text-input v-model="form.model" :error="form.errors.model" class="pb-8 pr-6 w-full lg:w-1/2" label="Model" />
          <text-input v-model="form.registration_number" :error="form.errors.registration_number" class="pb-8 pr-6 w-full lg:w-1/2" label="Registration Number" />
          <text-input v-model="form.color" :error="form.errors.color" class="pb-8 pr-6 w-full lg:w-1/2" label="Color" />
          <text-input v-model="form.year" :error="form.errors.year" class="pb-8 pr-6 w-full lg:w-1/2" label="Year" />
          <text-input v-model="form.price_per_day" :error="form.errors.price_per_day" class="pb-8 pr-6 w-full lg:w-1/2" label="Price Per Day" />
          <text-input v-model="form.price_per_week" :error="form.errors.price_per_week" class="pb-8 pr-6 w-full lg:w-1/2" label="Price Per Week" />
          <text-input v-model="form.price_per_month" :error="form.errors.price_per_month" class="pb-8 pr-6 w-full lg:w-1/2" label="Price Per Month" />
          <text-input v-model="form.km_day" :error="form.errors.km_day" class="pb-8 pr-6 w-full lg:w-1/2" label="KM Per Day" />
          <text-input v-model="form.km_week" :error="form.errors.km_week" class="pb-8 pr-6 w-full lg:w-1/2" label="KM Per Week" />
          <text-input v-model="form.km_month" :error="form.errors.km_month" class="pb-8 pr-6 w-full lg:w-1/2" label="KM Per Month" />
          <text-input v-model="form.rent_out_price" :error="form.errors.rent_out_price" class="pb-8 pr-6 w-full lg:w-1/2" label="Rent Out Price" />
          <file-input v-model="form.photo" :error="form.errors.photo" class="pb-8 pr-6 w-full lg:w-1/2" type="file" accept="image/*" label="Photo" />
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Car</loading-button>
        </div>

      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Layout from '@/Shared/Layout.vue'
import FileInput from '@/Shared/FileInput.vue'
import TextInput from '@/Shared/TextInput.vue'
import SelectInput from '@/Shared/SelectInput.vue'
import LoadingButton from '@/Shared/LoadingButton.vue'

export default {
  components: {
    FileInput,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        brand: '',
        model: '',
        price_per_day: '',
        year: '',
        price_per_week: '',
        price_per_month: '',
        km_day: '',
        km_week: '',
        km_month: '',
        rent_out_price: '',
        color: '',
        registration_number: '',
        photo: null,
      }),
    }
  },
  methods: {
    store() {
      this.form.post('/cars')
    },
  },
}
</script>
