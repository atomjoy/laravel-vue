<script setup>
let props = defineProps({
	show: { type: Boolean, default: true },
});
</script>

<template>
	<div class="social_wrapper" v-if="props.show">
		<div class="social_wrapper_divider">
			<div class="social_wrapper_text">
				{{ $t('login.Sign_In_With_Social') }}
			</div>
		</div>
		<div class="social_wrapper_list">
			<a href="/oauth/google/redirect" class="social_wrapper_button">
				<img src="/default/social/icon-google.png" alt="Google login" />
				Google
			</a>
			<a href="/oauth/github/redirect" class="social_wrapper_button">
				<img src="/default/social/icon-github.png" alt="Github login" />
				Github
			</a>
		</div>
	</div>
</template>
