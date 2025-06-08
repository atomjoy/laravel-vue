<template>
	<div class="yesno_wrapper">
		<div class="yesno_wrapper_yes" v-if="checked" @click="toggle">
			{{ $t('Yes') }}
		</div>
		<div class="yesno_wrapper_no" v-if="!checked" @click="toggle">
			{{ $t('No') }}
		</div>

		<input type="hidden" :name="props.name" v-model="model" />
	</div>
</template>

<script setup>
import { computed } from 'vue';
import IconArrowDown from '@/assets/icons/IconArrowDown.vue';

const props = defineProps({
	name: { type: String, default: '' },
});

const model = defineModel();

const checked = computed(() => {
	return model.value == 1;
});

function toggle() {
	model.value == 1 ? (model.value = 0) : (model.value = 1);
}
</script>
