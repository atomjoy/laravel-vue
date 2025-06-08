<script setup>
const props = defineProps({
	title: { default: 'Contacts' },
	desc: { default: 'Contacts list.' },
});
</script>

<template>
	<div class="panel_group">
		<div class="panel_group_header">
			<div class="panel_group_title">
				{{ $t(props.title) }}
			</div>

			<div class="panel_group_desc">
				{{ $t(props.desc) }}
			</div>
		</div>

		<div class="panel_group_form">
			<slot />
		</div>
	</div>
</template>
