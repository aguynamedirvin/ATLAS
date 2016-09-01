<?php
/**
 * field-bidi
 * Kirby field method for bi-directional content
 * @param  field  Rendered html output, e.g. from html(), kirbytext(), or markdown() methods
 * @return field  The field object with modified value property
 * 
 * Example usage: <?php echo $text->kirbytext()->bidi() ?>
 *
 * @author Sam Nabi http://github.com/samnabi
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
field::$methods['bidi'] = function($field) {

	// Define block-level elements that will be affected
	// Includes elements from https://developer.mozilla.org/en/docs/Web/HTML/Block-level_elements#Elements
	// (Excluded: hr, li, dd, dt, canvas, video, pre, tfoot)
	// We're hardcoding the replacement values so we can use a fast function like strtr() instead of preg_replace().
	$elements = [
		'<article' => '<article dir="auto"',
		'<aside' => '<aside dir="auto"',
		'<blockquote' => '<blockquote dir="auto"',
		'<div' => '<div dir="auto"',
		'<dl' => '<dl dir="auto"',
		'<fieldset' => '<fieldset dir="auto"',
		'<figcaption' => '<figcaption dir="auto"',
		'<figure' => '<figure dir="auto"',
		'<footer' => '<footer dir="auto"',
		'<form' => '<form dir="auto"',
		'<h1' => '<h1 dir="auto"',
		'<h2' => '<h2 dir="auto"',
		'<h3' => '<h3 dir="auto"',
		'<h4' => '<h4 dir="auto"',
		'<h5' => '<h5 dir="auto"',
		'<h6' => '<h6 dir="auto"',
		'<header' => '<header dir="auto"',
		'<hgroup' => '<hgroup dir="auto"',
		'<main' => '<main dir="auto"',
		'<nav' => '<nav dir="auto"',
		'<noscript' => '<noscript dir="auto"',
		'<ol' => '<ol dir="auto"',
		'<output' => '<output dir="auto"',
		'<p' => '<p dir="auto"',
		'<section' => '<section dir="auto"',
		'<table' => '<table dir="auto"',
		'<ul' => '<ul dir="auto"',
	];

	// Replace the values
	$field->value = strtr($field->value, $elements);

    return $field;
};