<?php
// Opciones relacionadas con PSR2 según mlocati
//
?>

<?php
// 'blank_line_after_namespace  => true,  // PSR2
// 'single_blank_line_before_namespace' => true,   // PSR2


namespace Sample\Sample;




$a;
?>

<?php
// 'braces' => ['allow_single_line_closure' => true,],   // PSR2

$positive = function ($item) { return $item >= 0; };
$negative = function ($item) {
                return $item < 0; };
?>

<?php
$foo = 'bar'          .           3 .'baz'.'qux';
?>


<?php
// 'elseif' => true,  // NO ESTABA EN EL EJEMPLO   // PSR2
if ($a) {
} else if ($b) {
}
?>

<?
// full_opening_tag   // PSR2
?>

<?php
// function_declaration // PSR2
class Foo
{
    public static function  bar   ( $baz , $foo )
    {
        return false;
    }
}

function  foo  ($bar, $baz)
{
    return false;
}
?>

<?php
// indentation_type   // PSR2
if (true) {
	echo 'Hello!';
}
?>


<?php
// lowercase_constants   // PSR2
$a = FALSE;
$b = True;
$c = nuLL;
?>

<?php
// lowercase_keywords   // PSR2
FOREACH($a AS $B) {
        TRY {
            NEW $C($a, ISSET($B));
            WHILE($B) {
                INCLUDE "test.php";
            }
        } CATCH(\Exception $e) {
            EXIT(1);
        }
    }
?>

<?php
// 'align_multiline_comment' => [ 'comment_type' => 'all_multiline'],
/**
            * This is a DOC Comment
with a line not prefixed with asterisk

   */

    /*
            * This is a doc-like multiline comment
*/

    /*
            * This is a doc-like multiline comment
with a line not prefixed with asterisk

   */
?>

<?php
// 'cast_spaces' => true,
$bar = (             string      )          $a;
$foo = (int)$b;
?>

<?php
// 'declare_equal_normalize' => ['space' => 'single'],
declare(ticks            =            1);
?>

<?php
//  'explicit_indirect_variable' => true,
echo $$foo;
echo $$foo['bar'];
echo $foo->$bar['baz'];
echo $foo->$callback($baz);
?>


// 'linebreak_after_opening_tag' => true,
// Me parece que no hace caso
<?php print $a
?>

<?php
// 'list_syntax' => ['syntax' => 'short'],
list($sample) = $array;
?>

<?php
// 'trailing_comma_in_multiline_array' => true,
array(    1,    2);
?>

// 'class_definition' => array('singleLine' => true),   // PSR2
// encoding // PSR2 // Como es para que sea UTF-8 no sé qué ejemplo poner
// line_ending   // PSR2


// method_argument_space   // PSR2
// no_break_comment   // PSR2
// no_closing_tag   // PSR2
'no_spaces_after_function_name' => true,  // NO ESTABA EN EL EJEMPLO   // PSR2
'no_spaces_inside_parenthesis' => true,  // NO ESTABA EN EL EJEMPLO   // PSR2
// no_trailing_whitespace   // PSR2
// no_trailing_whitespace_in_comment   // PSR2
// single_blank_line_at_eof   // PSR2
'single_blank_line_before_namespace' => true,   // PSR2
// 'single_class_element_per_statement' => true,   // PSR2
// single_import_per_statement   // PSR2
// single_line_after_imports   // PSR2
// switch_case_semicolon_to_colon   // PSR2
// switch_case_space   // PSR2
// visibility_required   // PSR2
