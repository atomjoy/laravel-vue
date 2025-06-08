<template>
	<div class="policy_wrapper">
		<div class="policy_wrapper_left">
			<Checkbox :name="props.name" :value="props.value" v-model="model" />

			<div class="policy_wrapper_label">
				{{ $t(props.label) }}

				<RouterLink :to="props.link_url" class="policy_wrapper_link">
					{{ $t(props.link) }}
				</RouterLink>
			</div>
		</div>
	</div>
</template>

<script setup>
import { RouterLink } from 'vue-router';
import Checkbox from './Checkbox.vue';

const props = defineProps({
	label: {
		type: String,
		required: true,
		default: 'Confirm services',
	},
	value: {
		type: String,
		required: true,
		default: 1,
	},
	name: {
		type: String,
		default: 'confirm_services',
	},
	link: {
		type: String,
		default: 'Terms of Service, Privacy Policy',
	},
	link_url: {
		type: String,
		default: '/docs/policy',
	},
});

const model = defineModel();
</script>

<!--
    let confirm_services = ref(true)
    <CheckboxPolicy
		value="1"
		v-model="confirm_services"
		name="confirm_services"
		link_url="/docs/services"
		:link="$t('register.Policy')"
		:label="$t('register.Confirm_services')"
	/>
-->
