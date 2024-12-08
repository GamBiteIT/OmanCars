<template>
  <div>
    <Head title="Create Facture Item" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/daily-factures">Factures</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-4xl mx-auto bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <!-- Items -->
        <div class="px-8 py-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold">Items</h2>
            <button
              type="button"
              @click="addItem"
              class="text-sm text-indigo-500 hover:text-indigo-700"
            >
              + Add Item
            </button>
          </div>

          <div v-for="(item, index) in form.items" :key="index" class="mb-6 border rounded-lg p-4 shadow-sm">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-4">
              <!-- Reservation Selection -->
              <text-input
                v-model="item.reservation_id"
                :error="form.errors[`items.${index}.reservation_id`]"
                label="Reservation ID"
                class="w-full"
              >
              </text-input>

              <!-- Car Selection -->
              <SelectInput
                v-model="item.cars_id"
                :error="form.errors[`items.${index}.cars_id`]"
                label="Car"
                class="w-full"
              >
                <option value="" disabled>Select a Car</option>
                <option v-for="car in cars" :key="car.id" :value="car.id">
                  {{ car.brand }} {{ car.model }} {{ car.registration_number }}
                </option>
              </SelectInput>

              <!-- Price Input -->
              <NumberInput
                v-model="item.price"
                :error="form.errors[`items.${index}.price`]"
                label="Price"
                class="w-full"
              />


              <!-- Transaction Type (Classic Checkbox) -->
              <div class="w-full flex flex-col">
                <label class="form-label" :for="'is_price_' + index">Transaction Type:</label>
                <div class="flex items-center">
                  <input
                    type="checkbox"
                    :id="'is_price_' + index"
                    v-model="item.is_price"
                    class="form-checkbox"
                  />
                  <span class="ml-2 text-sm text-gray-700">
                    {{ item.is_price ? 'Income' : 'Outcome' }}
                  </span>
                </div>

              </div>

              <!-- Description Textarea -->
              <TextareaInput
                v-model="item.description"
                :error="form.errors[`items.${index}.description`]"
                label="Description"
                class="w-full"
              />

            </div>

            <div class="flex justify-end">
              <button
                type="button"
                @click="removeItem(index)"
                class="text-sm text-red-500 hover:text-red-700"
              >
                Remove Item
              </button>
            </div>
          </div>
        </div>

        <div v-if="form.errors.items" class="text-red-500 text-sm px-8">
          {{ form.errors.items }}
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">
            Create Facture
          </loading-button>
        </div>
      </form>
    </div>
  </div>
</template>


<script>
import { Head, Link } from '@inertiajs/vue3';
import Layout from '@/Shared/Layout.vue';
import SelectInput from '@/Shared/SelectInput.vue';
import LoadingButton from '@/Shared/LoadingButton.vue';
import NumberInput from '@/Shared/NumberInput.vue';
import TextareaInput from '@/Shared/TextareaInput.vue';
import TextInput from '@/Shared/TextInput.vue';

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    SelectInput,
    NumberInput,
    TextareaInput,
    TextInput,

  },
  layout: Layout,
  props: {
    cars: Array, // List of cars
    facture: Object, // Facture details
  },
  data() {
    return {
      form: this.$inertia.form({
        facture_id: this.facture.id,
        date: this.facture.date_facture,
        items: [
          {
            cars_id: '',
            reservation_id: '',
            is_price: false, // Default to false (Outcome)
            price: 0,
            description: '',
          },
        ],
      }),
    };
  },
  methods: {
    addItem() {
      this.form.items.push({
        cars_id: '',
        reservation_id: '',
        is_price: false, // Default to false (Outcome)
        price: 0,
        description: '',
      });
    },
    removeItem(index) {
      this.form.items.splice(index, 1);
    },
    store() {
      this.form.post('/daily-facture-items');
    },
  },
};
</script>
