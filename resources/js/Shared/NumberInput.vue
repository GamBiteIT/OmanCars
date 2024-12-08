<template>
  <div :class="$attrs.class">
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <input
      :id="id"
      ref="input"
      v-model="value"
      v-bind="{ ...$attrs, class: null }"
      class="form-input"
      :class="{ error: error }"
      type="number"
      step="any"
    />
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>

<script>
import { v4 as uuid } from 'uuid'

export default {
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      default() {
        return `number-input-${uuid()}`
      },
    },
    error: String,
    label: String,
    modelValue: [String, Number],
  },
  emits: ['update:modelValue'],
  data() {
    return {
      value: this.modelValue,
    }
  },
  watch: {
    value(value) {
      this.$emit('update:modelValue', value)
    },
  },
  methods: {
    focus() {
      this.$refs.input.focus()
    },
    select() {
      this.$refs.input.select()
    },
  },
}
</script>

<style>
.form-input {
  width: 200%;
  padding: 4rem;
  font-size: 1rem;
  border: 2px solid #ccc;
  border-radius: 6px;
  box-sizing: border-box;
}
.form-label {
  font-weight: bold;
  margin-bottom: 0.5rem;
  display: block;
}
.form-error {
  color: red;
  font-size: 0.875rem;
  margin-top: 0.25rem;
}
.error {
  border-color: red;
}
</style>
