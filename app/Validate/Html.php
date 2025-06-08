<?php

namespace App\Validate;

use Throwable;
use DOMDocument;

class Html
{
	/**
	 * Replace unwanted tags
	 *
	 * @param String $html
	 * @return void
	 */
	static function htmlEntities($html)
	{
		try {
			$dom = new DOMDocument;
			$dom->loadHTML($html, LIBXML_NOERROR);
			$html = preg_replace_callback('#<code(.*?)>(.*?)</code>#is', function ($matches) {
				return '<code class="highlight_code">' . htmlentities($matches[2], ENT_QUOTES, 'UTF-8') . '</code>';
			}, $html);
			$html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
			// $html = preg_replace('# on(\S*?)=(.*?)>#is', ">", $html);
			$html = preg_replace('# on(\S*?)=#is', "xx$1=", $html);
			$html = strip_tags($html, Html::allowedTags());
		} catch (Throwable $e) {
			return 'Error: ' . $e->getMessage();
		}

		return $html;
	}

	/**
	 * Allowed tags in article
	 *
	 * @return array
	 */
	static function allowedTags()
	{
		return [
			'style',
			'code',
			'pre',
			'iframe',
			'picture',
			'video',
			'audio',
			'source',
			'img',
			'h1',
			'h2',
			'h3',
			'h4',
			'h5',
			'h6',
			'p',
			'a',
			'span',
			'strong',
			'small',
			'li',
			'ul',
			'ol',
			'div',
			'label',
			'abbr',
			'sub',
			'sup',
			'q',
			'blockquote',
			'table',
			'caption',
			'tr',
			'th',
			'td',
			'thead',
			'tbody',
			'tfoot',
			'col',
			'colgroup'
		];
	}
}
