<template>
	<div class="rememeber_wrapper">
		<div class="rememeber_wrapper_left">
			<Checkbox :name="props.name" :value="props.value" v-model="model" />

			<div class="rememeber_wrapper_label">
				{{ $t(props.label) }}
			</div>
		</div>

		<div class="rememeber_wrapper_right" v-if="props.link_url">
			<RouterLink class="rememeber_wrapper_link" :to="props.link_url">
				{{ $t(props.link) }}
			</RouterLink>
		</div>
	</div>
</template>

<script setup>
import { RouterLink } from 'vue-router';
import Checkbox from './Checkbox.vue';

const props = defineProps({
	value: { type: String, required: true },
	name: { type: String, default: 'remember_me' },
	label: { type: String, default: 'Remember me' },
	link: { type: String, default: 'Forgot password?' },
	link_url: { type: String, default: '/password' },
});

const model = defineModel();
</script>
