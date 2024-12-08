<template>
  <div :class="$attrs.class">
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <input
      :id="id"
      ref="input"
      type="checkbox"
      :checked="modelValue"
      @change="$emit('update:modelValue', $event.target.checked ? 1 : 0)"
      class="form-input"
      :class="inputClass"
    />
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>

<script>
import { v4 as uuid } from "uuid";

export default {
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      default() {
        return `boolean-input-${uuid()}`;
      },
    },
    error: String,
    label: String,
    modelValue: {
      type: Number,
      default: 0, // Default value is 0
    },
  },
  emits: ["update:modelValue"],
  computed: {
    inputClass() {
      return this.modelValue === 1 ? "bg-green-500" : "bg-red-500";
    },
  },
};
</script>

<style>
.bg-red-500 {
  background-color: red;
}
.bg-green-500 {
  background-color: green;
}
.form-input {
  width: 20px;
  height: 20px;
  border: 1px solid #ccc;
  border-radius: 3px;
  cursor: pointer;
}
.form-error {
  color: red;
  font-size: 0.875rem;
}
</style>
