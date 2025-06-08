<script setup>
import IconStar from '@/assets/icons/IconStar.vue';
import { onMounted } from 'vue';

onMounted(() => {
	new Splide('.splide1', {
		type: 'loop',
	}).mount();
});
</script>
<template>
	<div class="scrollbar">
		<div
			class="splide splide1"
			data-splide='{
					"type": "loop",
					"easing": "linear",
					"autoplay": true,
					"autoWidth": true,
					"pauseOnHover": false,
					"arrows": false,
					"interval": 0,
					"speed": 50000,
					"pagination": false,
					"padding": 0,
					"direction": "rtl"
				}'
		>
			<div class="splide__track">
				<ul class="splide__list">
					<li class="splide__slide">Web Design</li>
					<li class="splide__slide"><IconStar /></li>
					<li class="splide__slide">UX/UI Design</li>
					<li class="splide__slide"><IconStar /></li>
					<li class="splide__slide">Web Development</li>
					<li class="splide__slide"><IconStar /></li>
					<li class="splide__slide">Digital Marketing</li>
					<li class="splide__slide"><IconStar /></li>
					<li class="splide__slide">Seo</li>
					<li class="splide__slide"><IconStar /></li>
					<li class="splide__slide">Graphics Design</li>
					<li class="splide__slide"><IconStar /></li>
					<li class="splide__slide">3D Modeling</li>
					<li class="splide__slide"><IconStar /></li>
				</ul>
			</div>
		</div>
	</div>
</template>

<style>
.scrollbar {
	float: left;
	width: 100%;
	margin-bottom: 50px;
	color: #fff !important;
	background: #000 !important;
}
.scrollbar .splide__slide {
	padding-inline: 10px;
	padding-block: 10px;
	font-size: 25px;
}
.scrollbar .splide__slide svg {
	height: 25px;
	width: 25px;
}
.scrollbar .splide__slide svg * {
	stroke: #fff;
}
</style>
