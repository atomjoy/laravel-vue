export default [
	{
		'@context': 'https://schema.org',
		'@type': 'WebPage',
		name: 'Example Corp',
		url: 'https://example.com',
	},
	{
		'@context': 'https://schema.org',
		'@type': 'Article',
		mainEntityOfPage: {
			'@type': 'WebPage',
			'@id': 'https://example.com/knowledge/deployment/',
		},
		headline: 'What is Deployment?',
		description: 'Software and web development with <p>tags probably</p> ...',
		image: 'https://example.com/media/knowledge/deployment.png',
		author: {
			'@type': 'Person',
			name: 'Jane Doe',
			url: 'https://example.com/author/janedoe69',
		},
		publisher: {
			'@type': 'Organization',
			name: 'Example',
			logo: {
				'@type': 'ImageObject',
				url: 'https://example.com/media/social/social_og.png',
			},
		},
		datePublished: '2023-01-01',
		dateModified: '2025-01-21',
	},
];
