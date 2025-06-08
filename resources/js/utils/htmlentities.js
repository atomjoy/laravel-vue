const code = `
<span style="color: red;">Hello</span>
<?php
    echo "hello from js";

    function hello() {
        echo "Boo";
    }
?>
`;

//Simple
function htmlEntities(str) {
	return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

// Htmlentities
const encodedStr = code.replace(/[\u00A0-\u9999<>\&]/gim, (i) => '&#' + i.charCodeAt(0) + ';');

// Show php code in <code id="#output"></code>
document.querySelector('#output').innerHTML(encodedStr);

// Show php code entities in <code id="#output"></code>
document.querySelector('#output').innerHTML(encodedStr.replace(/&/gim, '&amp;'));

// More
function decodeHTMLEntities(text) {
	var textArea = document.createElement('textarea');
	textArea.innerHTML = text;
	return textArea.value;
}

function encodeHTMLEntities(text) {
	var textArea = document.createElement('textarea');
	textArea.innerText = text;
	return textArea.innerHTML;
}

// Convert a string to HTML entities
String.prototype.toHtmlEntities = function () {
	return this.replace(/./gm, function (s) {
		// return "&#" + s.charCodeAt(0) + ";";
		return s.match(/[a-z0-9\s]+/i) ? s : '&#' + s.charCodeAt(0) + ';';
	});
};

// Create string from HTML entities
String.fromHtmlEntities = function (string) {
	return (string + '').replace(/&#\d+;/gm, function (s) {
		return String.fromCharCode(s.match(/\d+/gm)[0]);
	});
};

// Html with code
let htmlDb = '<h1 style="color: red">Hello</h1><pre><code>' + code + '</code></pre><p>Works .....</p><pre><code>' + code + '</code></pre><p>Works .....</p>';

// Replace all
let htmlCode = htmlDb.replaceAll(/<code>([\s\S]*?)<\/code>/g, function (match, $1, offset, string, groups) {
	return match.replace($1, htmlEntities($1));
});

// Find matches
const regexp = new RegExp(/<code>([\s\S]*?)<\/code>/g);

const arr = [...htmlDb.matchAll(regexp)];
