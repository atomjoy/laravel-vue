<x-proton::email title="{{ __('email.password.subject') }}" locale="{{ app()->getlocale() }}">
	<x-slot:style>
		<style>
			.proton-table tr td {
				padding: 0px 40px;
			}

			.apilogin-logo {
				margin: 0px auto;
				margin-bottom: 20px;
				max-height: 100px;
				max-width: 50%;
			}
		</style>
	</x-slot:style>

	<x-proton::row>
		<x-proton::margin />

		<center>
			<img src="{{ config('default.password_image_url', 'https://raw.githubusercontent.com/atomjoy/proton/main/public/proton-default.png') }}"
				 alt="Image">
		</center>

		<h2>@lang('email.password.welcome') {{ $user?->name ?? '' }}!</h2>
		<p>@lang('email.password.message')</p>
	</x-proton::row>

	<x-proton::row>
		<x-proton::code>
			{{ $password ?? 'INVALID PASSWORD'}}
		</x-proton::code>
	</x-proton::row>

	<x-proton::row>
		<h3>@lang('email.regards')</h3>
		<strong>{{ $user?->name ?? '' }}</strong>
		<p>@lang('email.regards_text')</p>
	</x-proton::row>

	<x-proton::row>
		<x-proton::divider />

		<center>
			<span class="proton-rights"> © @lang('email.rights') </span>
		</center>

		<br />

		<x-proton::flex>
			<x-proton::social name="twitter" />
			<x-proton::social name="facebook" />
			<x-proton::social name="instagram" />
			<x-proton::social name="tiktok" />
		</x-proton::flex>

		<x-proton::margin />
	</x-proton::row>
</x-proton::email>