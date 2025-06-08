<script setup>
import { RouterLink } from 'vue-router';

let props = defineProps({
	show: { type: Boolean, default: true },
	url: { type: String, default: '/login' },
});
</script>

<template>
	<div class="signup_wrapper" v-if="props.show">
		<p class="signup_wrapper_text">
			{{ $t('register.Have_an_account') }}
			<RouterLink :to="props.url" class="signup_wrapper_link">
				{{ $t('login.Sign_In') }}
			</RouterLink>
		</p>
	</div>
</template>
