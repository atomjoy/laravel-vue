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
				<IconKey2 />
			</slot>
		</div>
	</div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import IconKey2 from '@/assets/icons/IconKey2.vue';

const model = defineModel();

const props = defineProps({
	name: { type: String, default: 'code' },
	type: { type: String, default: 'text' },
	focus: { type: Boolean, default: false },
	placeholder: { type: String, default: '' },
	icon: { type: String, default: 'key-1-svgrepo-com' },
});

let input = ref(null);

onMounted(() => {
	if (props.focus) {
		input.value.focus();
	}
});
</script>
