<template>
	<div class="validator_wrapper">
		<div class="input_wrapper">
			<input ref="input" class="input_wrapper_field" :type="props.type" :name="props.name" :placeholder="props.placeholder" :disabled="props.disabled" v-model="model" />
			<div class="input_wrapper_icon input_wrapper_icon_left">
				<slot>
					<IconEdit />
				</slot>
			</div>
		</div>
	</div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import IconEdit from '@/assets/icons/IconEdit.vue';

const model = defineModel();

const props = defineProps({
	name: { type: String, default: 'email' },
	type: { type: String, default: 'text' },
	focus: { type: Boolean, default: false },
	placeholder: { type: String, default: '' },
	disabled: { type: [String, Boolean], default: false },
});

let input = ref(null);

onMounted(() => {
	if (props.focus) {
		input.value.focus();
	}
});
</script>
