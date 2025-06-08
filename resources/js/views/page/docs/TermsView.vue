<script setup>
import ChangeDescription from '@/components/utils/head/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/head/ChangeTitle.vue';
import Terms from '@/components/page/docs/TermsConditions.vue';
import Layout from '@/layouts/page/DefaultLayout.vue';
</script>

<template>
	<Layout title="Terms & Conditions" description="Our terms & conditions.">
		<Terms />
	</Layout>

	<ChangeTitle :title="$t('Terms & Conditions')" />
	<ChangeDescription :description="$t('Our terms & conditions.')" />
</template>
