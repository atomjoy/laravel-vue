<template>
	<div class="validator_wrapper">
		<div class="input_wrapper">
			<select :name="props.name" :disabled="props.disabled" class="select_wrapper_field" v-model="model">
				<option value="null">
					{{ $t('Choose') }}
				</option>
				<option v-for="o in props.options" :value="o" :key="o" :selected="o == model?.value">
					{{ o }}
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
	disabled: { type: [String, Boolean], default: false },
});

function fixValue(val) {
	if (props.fixed > 0) {
		return val.toFixed(props.fixed);
	}
	return val;
}
</script>
