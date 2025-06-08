<template>
	<div class="validator_wrapper">
		<div class="input_wrapper">
			<select multiple :name="props.name" class="select_wrapper_field" v-model="model">
				<!-- <option value="null">
					{{ $t('Choose') }}
					<option v-for="o in props.options" :value="o.id" :selected="o.id == model?.value">
				</option> -->
				<option v-for="o in props.options" :value="o.id" :key="o.id">
					{{ o.name }}
				</option>
			</select>
		</div>
	</div>
</template>

<script setup>
const model = defineModel();

const props = defineProps({
	name: { type: String, default: 'category_id[]' },
	options: { type: Array, default: [] },
});
</script>
