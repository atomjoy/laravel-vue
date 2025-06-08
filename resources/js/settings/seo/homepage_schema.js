export default [
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        name: "Example Corp",
        alternateName: ["Example Corp Shop", "example.com", "ECS"],
        url: "https://www.example.com/",
        potentialAction: {
            "@type": "SearchAction",
            target: "http://example.com/search?&q={query}",
            query: "required",
        },
        publisher: {
            "@type": "Organization",
            name: "Example Corp",
            legalName: "Example Corp Shop Limited",
            url: "https://www.example.com/",
            "@id": "https://www.example.com/",
            sameAs: [
                "https://www.x.com/example_corp",
                "https://www.facebook.com/example_corp",
                "https://instagram.gov/examplecorp",
            ],
        },
    },
];
