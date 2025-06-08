<template>
	<div class="validator_wrapper">
		<div class="textarea_wrapper">
			<textarea ref="input" class="textarea_wrapper_field" :class="props.class" :name="props.name" :placeholder="props.placeholder" v-model="model" />
		</div>
	</div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
const model = defineModel();
const props = defineProps({
	name: { type: String, default: 'bio' },
	focus: { type: Boolean, default: false },
	placeholder: { type: String, default: '' },
	class: { type: String, default: '' },
});
let input = ref(null);

onMounted(() => {
	if (props.focus) {
		input.value.focus();
	}
});
</script>
