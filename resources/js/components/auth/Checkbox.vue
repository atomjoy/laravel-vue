<template>
	<div class="checkbox_wrapper">
		<div class="checkbox_wrapper_checkmark">
			<IconCheckmark v-if="checked" />
		</div>

		<input
			type="checkbox"
			class="checkbox_wrapper_field"
			:value="props.value"
			:name="props.name"
			:disabled="props.disabled"
			v-model="model"
		/>
	</div>
</template>

<script setup>
import { computed } from 'vue';
import IconCheckmark from '@/assets/icons/IconCheckmark.vue';

const props = defineProps({
	name: { type: String, default: '' },
	value: { type: String, required: true, default: 1 },
});

const model = defineModel();

const checked = computed(() => {
	if (model.value instanceof Array) {
		return model.value.includes(props.value);
	}
	return model.value;
});
</script>
