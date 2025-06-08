<template>
	<img class="user_avatar" :src="avatar_path" onerror="this.onerror = false; this.src='/default/avatar.webp'" />
</template>

<script setup>
import { ref } from 'vue';
const avatar_path = ref(null);
const props = defineProps({
	image: { default: '' },
});

if (props.image) {
	avatar_path.value = '/img/avatar?path=' + props.image;
} else {
	avatar_path.value = '/default/avatar.webp';
}
</script>

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
