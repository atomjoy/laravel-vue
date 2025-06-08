<template>
	<div class="validator_wrapper">
		<div class="input_wrapper">
			<a :href="'/web/api/admin/contacts/export/file?path=' + model" v-if="model" target="_blank">
				{{ model }}
			</a>
			<div v-else>{{ $t('No file') }}</div>
		</div>
	</div>
</template>

<script setup>
const model = defineModel();
</script>
