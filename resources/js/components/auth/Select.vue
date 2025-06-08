<template>
	<div class="validator_wrapper">
		<div class="input_wrapper">
			<select :name="props.name" class="select_wrapper_field" v-model="model">
				<option value="null">
					{{ $t('Choose') }}
				</option>
				<option v-for="o in props.options" :value="fixValue(o.id)" :selected="fixValue(o.id) == model?.value">
					{{ o.name }}
				</option>
			</select>
		</div>
	</div>
</template>

<script setup>
const model = defineModel();

const props = defineProps({
	name: { type: String, default: 'category_id' },
	options: { type: Array, default: [] },
	fixed: { type: Number, default: 0 },
});

function fixValue(val) {
	if (props.fixed > 0) {
		return val.toFixed(props.fixed);
	}
	return val;
}
</script>
