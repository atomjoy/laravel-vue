export default [
	{
		'@context': 'https://schema.org/',
		'@type': 'JobPosting',
		url: 'https://example.com/careers/job-slug-here',
		mainEntityOfPage: {
			'@type': 'WebPage',
			'@id': 'https://example.com/careers/job-slug-here',
		},
		title: 'Software Engineer',
		description: '<p>Example aspires to be an organization that reflects the globally diverse audience that our products and technology serve. We believe that in addition to hiring the best talent, a diversity of perspectives, ideas and cultures leads to the creation of better products and services.</p>',
		responsibilities: 'Design and write specifications for tools for in-house customers Build tools according to specifications',
		skills: 'Web application development using PHP Web application development using Python or familiarity with dynamic programming languages',
		qualifications: 'Ability to work in a team environment with members of varying skill levels. Highly motivated. Learns quickly.',
		// Work remote
		jobLocationType: 'TELECOMMUTE',
		employmentType: 'FULL_TIME',
		workHours: '40 hours per week',
		// Work On place
		// employmentType: 'CONTRACTOR',
		jobLocation: {
			'@type': 'Place',
			address: {
				'@type': 'PostalAddress',
				streetAddress: '1600 Amphitheatre Pkwy',
				addressLocality: 'Mountain View',
				addressRegion: 'CA',
				postalCode: '94043',
				addressCountry: 'US',
			},
		},
		baseSalary: '100000',
		salaryCurrency: 'USD',
		baseSalary: {
			'@type': 'MonetaryAmount',
			currency: 'USD',
			value: {
				'@type': 'QuantitativeValue',
				value: 40.0,
				unitText: 'HOUR',
			},
		},
		hiringOrganization: {
			'@type': 'Organization',
			name: 'Example',
			sameAs: 'https://www.example.com',
			logo: 'https://www.example.com/images/logo.png',
		},
		publisher: {
			'@type': 'Organization',
			name: 'Example',
			logo: {
				'@type': 'ImageObject',
				url: 'https://example.com/media/social/social_og.png',
			},
		},
		identifier: {
			'@type': 'PropertyValue',
			name: 'Example',
			value: '1234567',
		},
		datePosted: '2024-01-18',
		validThrough: '2024-03-18T00:00',
		industry: 'Computer Software',
		occupationalCategory: '15-1132.00 Software Developers, Application',
		jobBenefits: 'Medical, Life, Dental',
		applicantLocationRequirements: {
			'@type': 'Country',
			sameAs: 'https://www.wikidata.org/wiki/Q30',
			name: 'USA',
		},
		educationRequirements: {
			'@type': 'EducationalOccupationalCredential',
			credentialCategory: 'Bachelor of Science',
			about: 'Computer Science',
		},
		educationRequirements: "Bachelor's Degree in Computer Science, Information Systems or related fields of study.",
		experienceRequirements: {
			'@type': 'OccupationalExperienceRequirements',
			monthsOfExperience: '12',
		},
		experienceRequirements: 'Minumum 3 years experience as a software engineer',
		experienceInPlaceOfEducation: true,
	},
];
