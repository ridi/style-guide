<?php

//$finder = PhpCsFixer\Finder::create()
//    ->in(__DIR__ . '/src')
//;

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,

        // 1. ignored rules from @Symfony
        'blank_line_after_opening_tag' => false,
        'blank_line_before_return' => false,
        'cast_spaces' => false,
        'concat_space' => ['spacing' => 'one'],
        'phpdoc_align' => false,
        'phpdoc_annotation_without_dot' => false,
        'phpdoc_indent' => false,
        'phpdoc_separation' => false,
        'phpdoc_summary' => false,
        'single_quote' => false,
        'trailing_comma_in_multiline_array' => false,

        // 2. additional rules
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => true,
    ])
    //->setIndent("\t")     // 레거시 코드일 경우에는 탭 사용
    //->setFinder($finder)
;
