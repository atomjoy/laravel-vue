<script setup>
const props = defineProps({
	show: false,
});
</script>
<template>
	<tr class="panel_list_empty" v-if="show">
		{{
			$t('There are no records.')
		}}
	</tr>
</template>
