<script setup>
import { ref, onMounted, defineProps } from 'vue';
import { Loader } from '@googlemaps/js-api-loader';
import company from '@/settings/company.json';

let api_key = import.meta.env.VITE_GMAP_KEY ?? '';

const props = defineProps({
	zoom: { default: 15 },
	lat: { required: true, default: 49.29903 },
	lng: { required: true, default: 19.949047 },
	scrollwheel: { default: false },
	disableDefaultUI: { default: false },
	style: { default: 'width: 100%; height: 400px;' },
	marker: {
		default: {
			title: 'Welcome',
			image: 'https://img.icons8.com/fluency/2x/google-maps-new.png',
			width: 70,
			height: 70,
		},
	},
	content: {
		default: `
    <div class="iwx">
      <div class="iwx-logo"><img src="${company.map_logo}"></div>
      <div class="map_text map_company">${company.name}</div>
      <div class="map_text map_city">${company.city}</div>
      <div class="map_text map_street">${company.street}</div>
      <a class="iwx-btn" href="${company.website_url}" target="_blank" rel="nofollow">See more</a>
    </div>
    `,
	},
});

let map = null;
let icon = null;
let marker = null;
let infowindow = null;
let mk = null;

onMounted(() => {
	// Google map
	const loader = new Loader({
		apiKey: api_key,
		version: 'weekly',
		libraries: ['drawing', 'geometry'],
	});

	// Map loader
	loader.load().then(() => {
		map = new google.maps.Map(document.getElementById('gmap'), {
			center: { lat: props.lat, lng: props.lng },
			zoom: props.zoom,
			scrollwheel: props.scrollwheel,
			disableDefaultUI: props.disableDefaultUI,
		});

		// Info window
		infowindow = new google.maps.InfoWindow({
			content: props.content,
			ariaLabel: props.marker.title,
		});

		// Marker icon
		icon = {
			url: props.marker.image,
			scaledSize: new google.maps.Size(props.marker.width, props.marker.height),
		};

		// Marker
		marker = new google.maps.Marker({
			position: { lat: props.lat, lng: props.lng },
			title: props.marker.title,
			icon: icon,
			map: map,
		});

		// Marker event
		marker.addListener('click', () => {
			// Open infowindow
			infowindow.open({
				anchor: marker,
				map: map,
			});
		});
	});
});
</script>

<template>
	<div id="gmap" :style="props.style"></div>
</template>

<style>
.map_text {
	float: left;
	min-width: 100%;
	font-size: 16px;
	font-weight: 500;
	margin-inline: 5%;
}

.map_company {
	font-size: 25px;
	font-weight: 700;
}

/* Add to main.css file if does not work from component scoped */
.gm-style-iw-d div {
	padding: 5px;
}
.gm-style .gm-style-iw {
	color: #000 !important;
	background-color: #fff !important;
	box-shadow: 0 2px 7px 1px rgba(53, 53, 53, 0.3);
	border-radius: 0px;
	overflow: visible !important;
}
.gm-style-iw-d {
	background-color: transparent !important;
	overflow: visible !important;
}
.gm-style .gm-style-iw-tc {
	filter: drop-shadow(0 4px 2px rgba(53, 53, 53, 0.4)) !important;
}
.gm-style .gm-style-iw-tc::after {
	background: #fff !important;
}
.gm-ui-hover-effect > span {
	background-color: #000;
}
.gm-ui-hover-effect:hover > span {
	background-color: #f23 !important;
}

/* Disabe infoWindow max-height */
.gm-style-iw,
.gm-style-iw div,
.gm-style-iw div div,
.gm-style-iw .gm-style-iw-c {
	overflow: visible !important;
	height: auto !important;
	max-height: none !important;
	width: auto;
	max-width: none;
}

/* Info window remove padding */
.gm-style-iw,
.gm-style-iw > div > div {
	padding: 0px !important;
	padding-left: 0px !important;
	padding-top: 0px !important;
	padding-bottom: 0px !important;
	padding-right: 0px !important;
}

/* Info window style */
.iwx {
	position: relative;
	width: 360px !important;
}
.iwx-logo {
	position: absolute;
	top: -90px;
	left: 30px;
	width: 100px !important;
	height: 100px !important;
	border-radius: 50%;
	padding: 10px !important;
	background: #fff;
	z-index: 999;
	overflow: hidden;
}
.iwx-logo img {
	float: left;
	width: 100% !important;
	border-radius: 50%;
}
.iwx h2 {
	display: block;
	font-size: 21px;
	font-weight: 300;
	text-align: center;
	margin-top: 30px;
	margin-bottom: 10px;
}
.iwx a {
	float: left;
	width: 90%;
	margin: 20px 5%;
	padding: 13px 20px;
	color: #fff;
	background: var(--accent);
	border-radius: 10px;
	font-weight: 900;
	font-size: 17px;
	transition: all 0.6s;
}
.iwx a:hover {
	color: var(--accent);
	background: #000;
	border-radius: 50px;
}
</style>
