<template>
	<div class="panel_settings_group_subtitle">
		{{ $t(props.title) }}
	</div>
</template>

<script setup>
const props = defineProps({
	title: { default: 'Group title' },
});
</script>
