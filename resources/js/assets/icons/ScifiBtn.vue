<template>
	<button class="splide__arrow splide__arrow--prev" aria-controls="splide01-track" aria-label="Go to last slide">
		<span class="bg">
			<svg width="60" height="60" viewBox="0 0 60 60">
				<polygon points="60,0 60,50 50,60 0,60 0,0" fill="transparent" stroke="white" stroke-width="2"></polygon>
			</svg>
		</span>
		<span class="icon"></span>
	</button>
</template>

<style>
.splide__arrow .bg {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
}
.splide__arrow .bg svg polygon {
	fill: transparent;
	stroke: #ffffff;
	transition: 0.3s;
}
.splide__arrow .icon {
	width: 8px;
	height: 8px;
	border-bottom: 2px solid #f1f1f1;
	border-right: 2px solid #f1f1f1;
	transform: rotate(45deg);
	display: inline-block;
}
</style>
