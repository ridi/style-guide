<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src');

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
    ])
    //->setIndent("\t")     // 레거시 코드일 경우에는 탭 사용
    ->setFinder($finder);
