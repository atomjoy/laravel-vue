<script setup>
import ChangeDescription from '@/components/utils/head/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/head/ChangeTitle.vue';
import Policy from '@/components/page/docs/PrivacyPolicy.vue';
import Layout from '@/layouts/page/DefaultLayout.vue';
</script>

<template>
	<Layout title="Privacy Policy" description="Our privacy policy.">
		<Policy />
	</Layout>

	<ChangeTitle :title="$t('Privacy Policy')" />
	<ChangeDescription :description="$t('Our privacy policy.')" />
</template>
