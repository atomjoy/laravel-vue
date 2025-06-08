<script setup>
import { RouterLink } from 'vue-router';

let props = defineProps({
	show: { type: Boolean, default: true },
	url: { type: String, default: '/register' },
});
</script>

<template>
	<div class="signup_wrapper" v-if="props.show">
		<p class="signup_wrapper_text">
			{{ $t('login.Dont_have_an_account') }}
			<RouterLink :to="props.url" class="signup_wrapper_link">
				{{ $t('login.Sign_Up') }}
			</RouterLink>
		</p>
	</div>
</template>
