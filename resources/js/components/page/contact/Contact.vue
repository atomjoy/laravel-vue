<script setup>
import { ref } from 'vue';
import company from '@/settings/company.json';
import scrollTo from '@/utils/scrollTo.js';
import ErrorMessage from './ErrorMessage.vue';
import Button from './Button.vue';

const form = ref(null);
const error = ref(false);
const message = ref(null);

async function onSubmit(e) {
	scrollTo();
	error.value = false;
	try {
		const data = new FormData(e.target);
		let res = await axios.post('/web/api/page/contact', data);
		message.value = res.data.message;
		e.target.reset();
	} catch (err) {
		message.value = err.response.data.message ?? '';
		error.value = true;
	}
}
</script>
<template>
	<div class="page_contact" id="contacts">
		<p class="page_contact_subtitle"><i class="fa-solid fa-circle-chevron-right"></i> {{ $t('Contact Us') }}</p>
		<h1>
			{{ $t('Join Us in Creating') }} <br />
			{{ $t('Something Great') }}
		</h1>

		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rerum dolores, excepturi pariatur, perferendis consequuntur architecto nemo labore quae minus ea eum velit fugit exercitationem assumenda impedit natus reiciendis quidem!</p>

		<ErrorMessage :error="error" :message="message" />

		<div class="page_contact_form">
			<form method="post" @submit.prevent="onSubmit" ref="form">
				<div class="input_group">
					<input type="text" class="input" name="firstname" :placeholder="$t('First Name')" />
					<input type="text" class="input" name="lastname" :placeholder="$t('Last Name')" />
				</div>

				<div class="input_group">
					<input type="text" class="input" name="email" :placeholder="$t('Email')" />
					<input type="text" class="input" name="mobile" :placeholder="$t('Phone Number')" />
				</div>

				<input type="text" class="input" name="subject" :placeholder="$t('Subject')" />

				<textarea name="message" class="input" :placeholder="$t('Message')"></textarea>

				<label class="contact_label">{{ $t('File (optional), allowed types:') }} pdf, doc, docx.</label>

				<input type="file" class="input" name="file" />

				<Button name="Send Message" />
			</form>
		</div>

		<div class="page_contact_right">
			<div class="page_contact_details">
				<h2>{{ $t('Address') }}</h2>
				<p>
					{{ company.country }} <br />
					{{ company.city }} <br />
					{{ company.street }}
				</p>

				<br />
				<h2>{{ $t('Contact') }}</h2>
				<p>{{ $t('Mobile') }}: {{ company.mobile }}</p>
				<p>{{ $t('Email') }}: {{ company.email }}</p>

				<br />
				<h2>{{ $t('Open Time') }}</h2>
				<p>{{ company.open_time }}</p>

				<br />
				<h2>{{ $t('Stay Connected') }}</h2>

				<div class="page_contact_socials">
					<div class="page_contact_social" v-for="i in company.socials">
						<a :href="i.url" :title="i.title">
							<i :class="['fa-brands', 'fa-' + i.icon]"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
@import url('@/assets/css/page/contact.css');
</style>
