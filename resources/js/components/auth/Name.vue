<template>
	<div class="input_wrapper">
		<input
			ref="input"
			class="input_wrapper_field"
			:type="props.type"
			:name="props.name"
			:placeholder="props.placeholder"
			v-model="model"
		/>

		<div class="input_wrapper_icon input_wrapper_icon_left">
			<slot>
				<IconUser />
			</slot>
		</div>
	</div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import IconUser from '@/assets/icons/IconUser.vue';

const props = defineProps({
	name: { type: String, default: 'name' },
	type: { type: String, default: 'text' },
	focus: { type: Boolean, default: false },
	placeholder: { type: String, default: '' },
});

const model = defineModel();

let input = ref(null);

onMounted(() => {
	if (props.focus) {
		input.value.focus();
	}
});
</script>
