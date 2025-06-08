<template>
	<div class="validator_wrapper">
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
					<IconLock />
				</slot>
			</div>

			<div class="input_wrapper_show" @click.stop="toggleType">
				<div class="input_wrapper_icon input_wrapper_icon_right" v-if="!show">
					<IconEye />
				</div>

				<div class="input_wrapper_icon input_wrapper_icon_right" v-if="show">
					<IconEyeAlt />
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import IconEye from '@/assets/icons/IconEyeClosed.vue';
import IconEyeAlt from '@/assets/icons/IconEyeOpen.vue';
import IconLock from '@/assets/icons/IconShield.vue';

const model = defineModel();

const props = defineProps({
	name: { type: String, default: 'password' },
	type: { type: String, default: 'password' },
	focus: { type: Boolean, default: false },
	placeholder: { type: String, default: '' },
});

let show = ref(false);

let input = ref(null);

onMounted(() => {
	if (props.focus) {
		input.value.focus();
	}
});

function toggleType() {
	show.value = !show.value;
	show.value ? (props.type = 'text') : (props.type = 'password');
}
</script>
