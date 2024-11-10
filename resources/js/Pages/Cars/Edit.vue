<template>
  <div>
    <Head :title="`${form.Name} ${form.registration_number}`" />
    <div class="flex justify-start mb-8 max-w-3xl">
      <h1 class="text-3xl font-bold">
        <Link class="text-indigo-400 hover:text-indigo-600" href="/cars">Cars</Link>
        <span class="text-indigo-400 font-medium">/</span>
        {{ form.brand }} {{ form.model }} {{ form.registration_number }} <img v-if="car.photo" class="block ml-4 w-auto h-20 rounded-none" :src="car.photo" />

      </h1>

    </div>
    <!-- <trashed-message v-if="user.deleted_at" class="mb-6" @restore="restore"> This user has been deleted. </trashed-message> -->
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
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
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <!-- <button v-if="!user.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete User</button> -->
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Car</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Layout from '@/Shared/Layout.vue'
import TextInput from '@/Shared/TextInput.vue'
import FileInput from '@/Shared/FileInput.vue'
import SelectInput from '@/Shared/SelectInput.vue'
import LoadingButton from '@/Shared/LoadingButton.vue'
import TrashedMessage from '@/Shared/TrashedMessage.vue'

export default {
  components: {
    FileInput,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    car: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        brand: this.car.brand,
        model: this.car.model,
        registration_number: this.car.registration_number,
        color: this.car.color,
        year: this.car.year,
        price_per_day: this.car.price_per_day,
        price_per_week: this.car.price_per_week,
        price_per_month: this.car.price_per_month,
        km_day: this.car.km_day,
        km_week: this.car.km_week,
        km_month: this.car.km_month,
        rent_out_price: this.car.rent_out_price,
        photo: null,
      }),
    }
  },
  methods: {
    update() {
      this.form.post(`/cars/${this.car.id}`, {
        onSuccess: () => this.form.reset('photo'),
      })
    },
    // destroy() {
    //   if (confirm('Are you sure you want to delete this user?')) {
    //     this.$inertia.delete(`/users/${this.user.id}`)
    //   }
    // },
    // restore() {
    //   if (confirm('Are you sure you want to restore this user?')) {
    //     this.$inertia.put(`/users/${this.user.id}/restore`)
    //   }
    // },
  },
}
</script>
