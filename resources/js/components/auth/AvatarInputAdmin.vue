<script setup>
import { ref } from 'vue';
import axios from 'axios';
import Label from './Label.vue';
import IconTrash from '@/assets/icons/IconTrash.vue';

const props = defineProps({
	avatar: { default: '' },
	label: { default: 'Select image' },
	remove_avatar_url: { default: '/web/api/admin/remove/avatar' },
	remove_success: { default: 'Avatar removed.' },
	remove_error: { default: 'Avatar not removed.' },
});

let avatar_path = ref(null);

if (props.avatar) {
	avatar_path.value = '/img/avatar?path=' + props.avatar;
} else {
	avatar_path.value = '/default/avatar.webp';
}

function getImagePath(e) {
	const path = URL.createObjectURL(e.target.files[0]);
	if (path) {
		avatar_path.value = path;
	}

	const el = document.querySelector('.user_avatar');
	if (el) {
		el.src = path;
	}
}

async function removeAvatar() {
	try {
		await axios.post(props.remove_avatar_url, []);
		avatar_path.value = '/default/avatar.webp';
		alert(props.remove_success);
	} catch (err) {
		alert(props.remove_error);
	}
}

function openFile() {
	let el = document.querySelector('#avatar_input');
	el.click();
}
</script>

<template>
	<div class="avatar_upload_wrapper">
		<div class="avatar_input">
			<div @click="removeAvatar" class="avatar_delete" :title="$t('Remove avatar')">
				<IconTrash />
			</div>

			<img :src="avatar_path" class="avatar_image" onerror="this.onerror = false; this.src='/default/avatar.webp'" />

			<Label :text="$t(props.label)" />

			<div id="avatar_choose_file" @click="openFile">
				<span class="avatar_choose_info">{{ $t('Select image with .webp, .png or .jpg extension (min. 256x256 px).') }}</span>
				<span id="avatar_upload_button"><i class="fa-solid fa-upload"></i> {{ $t('Choose Image') }}</span>
			</div>
			<input id="avatar_input" @change="getImagePath" type="file" name="avatar" hidden="true" />
		</div>
	</div>
</template>

<!--
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
// Required image response route
Route::get('/img/avatar', function () {
	try {
		$path = request('path');
		if (Storage::exists($path)) {
			return Storage::response($path);
		}
	} catch (\Exception $e) {
		return response()->file(public_path('/default/avatar.webp'));
	}
});
-->
