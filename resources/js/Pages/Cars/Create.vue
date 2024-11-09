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
          <text-input v-model="form.Name" :error="form.errors.Name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name" />
          <text-input v-model="form.registration_number" :error="form.errors.registration_number" class="pb-8 pr-6 w-full lg:w-1/2" label="Registration Number" />
          <text-input v-model="form.color" :error="form.errors.color" class="pb-8 pr-6 w-full lg:w-1/2" label="Color" />
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
        Name: '',
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
