<?php
/*
Plugin Name: SyntaxHighlighter Evolved: Twig Brush
Description: Adds support for the Twig Templating language to the SyntaxHighlighter Evolved plugin.
Author: William Sullivan
Version: 0.1
Author URI: https://enkrates.com/
*/
 
// SyntaxHighlighter Evolved doesn't do anything until early in the "init" hook, so best to wait until after that
add_action( 'init', 'syntaxhighlighter_twig_regscript' );
 
// Tell SyntaxHighlighter Evolved about this new language/brush
add_filter( 'syntaxhighlighter_brushes', 'syntaxhighlighter_twig_addlang' );
 
// Register the brush file with WordPress
function syntaxhighlighter_twig_regscript() {
    wp_register_script( 'syntaxhighlighter-brush-twig', plugins_url( 'shBrushTwig.js', __FILE__ ), array('syntaxhighlighter-core'), '0.1' );
}
 
// Filter SyntaxHighlighter Evolved's language array
function syntaxhighlighter_twig_addlang( $brushes ) {
    $brushes['twig'] = 'twig';
 
    return $brushes;
}
 
?>