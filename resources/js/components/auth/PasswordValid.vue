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
		<div class="tooltip_wrapper" v-if="open">
			<div class="tooltip_wrapper_error" v-if="!check1">
				<IconClose v-if="!check1" /><IconCheck
					v-if="check1"
					class="tooltip_wrapper_green"
				/>{{ $t('Min number of characters') }}:
				{{ props.minChars }}
			</div>
			<div class="tooltip_wrapper_error" v-if="!check2">
				<IconClose v-if="!check2" /><IconCheck
					v-if="check2"
					class="tooltip_wrapper_green"
				/>{{ $t('Contains a capital letter') }}
			</div>
			<div class="tooltip_wrapper_error" v-if="!check3">
				<IconClose v-if="!check3" /><IconCheck
					v-if="check3"
					class="tooltip_wrapper_green"
				/>{{ $t('Contains a small letter') }}
			</div>
			<div class="tooltip_wrapper_error" v-if="!check4">
				<IconClose v-if="!check4" /><IconCheck
					v-if="check4"
					class="tooltip_wrapper_green"
				/>{{ $t('Contains a number') }}
			</div>
			<div class="tooltip_wrapper_error" v-if="!check5">
				<IconClose v-if="!check5" /><IconCheck
					v-if="check5"
					class="tooltip_wrapper_green"
				/>{{ $t('Contains a special character') }}
			</div>
		</div>
	</div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import IconClose from '@/assets/icons/IconClose.vue';
import IconCheck from '@/assets/icons/IconCheck.vue';
import IconEye from '@/assets/icons/IconEyeClosed.vue';
import IconEyeAlt from '@/assets/icons/IconEyeOpen.vue';
import IconLock from '@/assets/icons/IconShield.vue';

const emits = defineEmits(['valid', 'invalid']);

const props = defineProps({
	name: { type: String, default: 'password' },
	type: { type: String, default: 'password' },
	focus: { type: Boolean, default: false },
	placeholder: { type: String, default: '' },
	minChars: { type: Number, default: 11 },
});
const model = defineModel();

let show = ref(false);
let input = ref(null);
let open = ref(false);

let check1 = ref(false);
let check2 = ref(false);
let check3 = ref(false);
let check4 = ref(false);
let check5 = ref(false);

onMounted(() => {
	if (props.focus) {
		input.value.focus();
	}
});

function toggleType() {
	show.value = !show.value;
	show.value ? (props.type = 'text') : (props.type = 'password');
}

function validatePass(event) {
	let str = event?.target?.value ?? '';

	if (str.replace(' ', '').length >= props.minChars) {
		check1.value = true;
	} else {
		check1.value = false;
	}

	if (Boolean(str.match(/[A-Z]/))) {
		check2.value = true;
	} else {
		check2.value = false;
	}

	if (Boolean(str.match(/[a-z]/))) {
		check3.value = true;
	} else {
		check3.value = false;
	}

	if (Boolean(str.match(/[0-9]/))) {
		check4.value = true;
	} else {
		check4.value = false;
	}

	if (Boolean(str.match(/[^A-Za-z0-9 ]/))) {
		check5.value = true;
	} else {
		check5.value = false;
	}

	if (check1.value && check2.value && check3.value && check4.value && check5.value) {
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
