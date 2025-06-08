<script setup>
let props = defineProps({
	image: { type: String, default: '' },
});
</script>

<template>
	<div class="page_banner fixed_bg" v-bind:style="{ backgroundImage: 'url(' + props.image + ')' }">
		<slot />
	</div>
</template>

<style scoped>
.fixed_bg {
	float: left;
	width: 100%;
	height: 250px;
	background: #232320;
	background-size: cover;
	background-position: center;
	background-attachment: fixed;
}
</style>
