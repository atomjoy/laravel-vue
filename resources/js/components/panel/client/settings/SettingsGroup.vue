<template>
	<div class="panel_settings_group">
		<div class="panel_settings_group_header">
			<div class="panel_settings_group_title">
				{{ $t(props.title) }}
			</div>

			<div class="panel_settings_group_desc">
				{{ $t(props.desc) }}
			</div>
		</div>

		<div class="panel_settings_group_form">
			<slot />
		</div>
	</div>
</template>

<script setup>
const props = defineProps({
	title: { default: 'Group title' },
	desc: { default: 'Group description goes here.' },
});
</script>
