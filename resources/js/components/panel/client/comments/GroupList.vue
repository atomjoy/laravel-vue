<script setup>
const props = defineProps({
	title: { default: 'Comments' },
	desc: { default: 'Comments list.' },
});
</script>

<template>
	<div class="panel_group_list">
		<div class="panel_group_header">
			<div class="panel_group_title">
				{{ $t(props.title) }}
			</div>

			<div class="panel_group_desc">
				{{ $t(props.desc) }}
			</div>
		</div>

		<div class="panel_group_list">
			<slot />
		</div>
	</div>
</template>
