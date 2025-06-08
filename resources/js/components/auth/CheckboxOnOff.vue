<template>
	<div class="checkbox_wrapper">
		<div class="checkbox_wrapper_checkmark">
			<IconCheckmark v-if="checked" />
		</div>

		<input type="hidden" :name="props.name" v-model="model" />
	</div>
</template>

<script setup>
import { computed } from 'vue';
import IconCheckmark from '@/assets/icons/IconCheckmark.vue';

const props = defineProps({
	name: { type: String, default: '' },
});

const model = defineModel();

const checked = computed(() => {
	return model.value == 1;
});
</script>
