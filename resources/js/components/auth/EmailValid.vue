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
				@keyup="validatePass"
				@focus="onFocus"
				@blur="onBlur"
			/>

			<div class="input_wrapper_icon input_wrapper_icon_left">
				<slot>
					<IconEmail />
				</slot>
			</div>
		</div>

		<div class="tooltip_wrapper" v-if="open">
			<div class="tooltip_wrapper_error" v-if="!check1">
				<IconClose v-if="!check1" /><IconCheck
					v-if="check1"
					class="tooltip_wrapper_green"
				/>{{ $t('Invalid email address') }}
			</div>
		</div>
	</div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import IconClose from '@/assets/icons/IconClose.vue';
import IconCheck from '@/assets/icons/IconCheck.vue';
import IconEmail from '@/assets/icons/IconEmail.vue';

const emits = defineEmits(['valid', 'invalid']);

const props = defineProps({
	name: { type: String, default: 'email' },
	type: { type: String, default: 'text' },
	focus: { type: Boolean, default: false },
	placeholder: { type: String, default: '' },
});

const model = defineModel();

let input = ref(null);
let open = ref(false);
let check1 = ref(false);

onMounted(() => {
	if (props.focus) {
		input.value.focus();
	}
});

function validateEmail(email) {
	// const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	const emailRegex =
		/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
	return emailRegex.test(email);
}

function validatePass(event) {
	let str = event?.target?.value ?? '';

	if (validateEmail(str)) {
		check1.value = true;
	} else {
		check1.value = false;
	}

	if (check1.value) {
		emits('valid', str);
		event?.target?.classList.remove('form_input_error');
		open.value = false;
	} else {
		emits('invalid', str);
		event?.target?.classList.add('form_input_error');
		open.value = true;
	}
}

function onFocus(event) {
	open.value = true;
	validatePass(event);
}

function onBlur(event) {
	open.value = false;
}
</script>
