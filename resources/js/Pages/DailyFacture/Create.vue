<template>
  <div>
    <Head title="Create Facture" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/daily-factures">Facture</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <date-input v-model="form.date_facture" :error="form.errors.date_facture" class="pb-8 pr-6 w-full lg:w-1/2" label="Date Facture" />
          <file-input v-model="form.image" :error="form.errors.image" class="pb-8 pr-6 w-full lg:w-1/2" type="file" accept="image/*" label="Photo" />
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Next</loading-button>
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
import DateInput from '@/Shared/DateInput.vue'

export default {
  components: {
    FileInput,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    DateInput,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        date_facture: '',
        image: null,
      }),
    }
  },
  methods: {
    store() {
      this.form.post('/daily-facture')
    },
  },
}
</script>












<!-- <script setup >
 import { ref } from 'vue';
const orderNumber = ref('OR-106930');

</script>

<template>
  <div class="p-6 max-w-4xl mx-auto">
    <div class="flex items-center mb-8">
      <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center text-white">01</div>
      <h2 class="ml-4 text-2xl font-semibold text-orange-500">Facture Details</h2>
    </div>

    <div class="space-y-6">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
        <input type="date" v-model="orderNumber" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" >
      </div>

<input type="file">
    </div>

    <div class="mt-8 flex justify-end">
      <button class="px-6 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">Next</button>
    </div>
  </div>



</template> -->



<!-- <script setup lang="ts">
import { ref } from 'vue';

const orderNumber = ref('OR-106930');

interface OrderItem {
  product: string;
  quantity: number;
  unitPrice: number;
}

const items = ref<OrderItem[]>([]);

const addItem = () => {
  items.value.push({
    product: '',
    quantity: 1,
    unitPrice: 0
  });
};

const removeItem = (index: number) => {
  items.value.splice(index, 1);
};
</script>

<template>
  <div class="p-6 max-w-4xl mx-auto">
    <div class="flex items-center mb-8">
      <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center text-white">02</div>
      <h2 class="ml-4 text-2xl font-semibold text-orange-500">Facture Items</h2>
    </div>

    <div v-for="(item, index) in items" :key="index" class="mb-6 p-6 bg-white rounded-lg shadow-sm">
      <div class="flex items-center justify-between mb-4">
        <div class="flex items-center">
          <button class="text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
            </svg>
          </button>
        </div>
        <button @click="removeItem(index)" class="text-red-500 hover:text-red-600">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </button>
      </div>

      <div class="grid grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Product<span class="text-red-500">*</span></label>
          <select v-model="item.product" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            <option value="">Select an option</option>
            <option value="hardware">Optimized exuding hardware</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Quantity<span class="text-red-500">*</span></label>
          <input type="number" v-model="item.quantity" min="1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Unit Price</label>
          <input type="number" v-model="item.unitPrice" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" readonly>
        </div>
      </div>
    </div>

    <button @click="addItem" class="mb-8 px-4 py-2 bg-white text-gray-700 rounded-md border border-gray-300 hover:bg-gray-50">
      Add to items
    </button>

    <div class="flex justify-between">
      <button class="px-6 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">Back</button>
      <button class="px-6 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">Create</button>
    </div>
  </div>



  <div class="p-6 max-w-4xl mx-auto">
    <div class="flex items-center mb-8">
      <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center text-white">01</div>
      <h2 class="ml-4 text-2xl font-semibold text-orange-500">Facture Details</h2>
    </div>

    <div class="space-y-6">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
        <input type="date" v-model="orderNumber" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" >
      </div>

<input type="file">
    </div>

    <div class="mt-8 flex justify-end">
      <button class="px-6 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">Next</button>
    </div>
  </div>


</template> -->
