<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/../modules')
    ->in(__DIR__ . '/../test')
    ->exclude([
        'modules/App/templates',
    ]);

return (new PhpCsFixer\Config('Config'))
    ->setFinder($finder)
    ->setUsingCache(false)
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12'                                       => true,
        'array_indentation'                           => true,
        'array_syntax'                                => ['syntax' => 'short'],
        'blank_line_after_opening_tag'                => true,
        'cast_spaces'                                 => ['space' => 'single'],
        'combine_consecutive_issets'                  => true,
        'combine_consecutive_unsets'                  => true,
        'concat_space'                                => ['spacing' => 'one'],
        'escape_implicit_backslashes'                 => true,
        'explicit_indirect_variable'                  => true,
        'explicit_string_variable'                    => true,
        'fully_qualified_strict_types'                => true,
        'heredoc_indentation'                         => true,
        'heredoc_to_nowdoc'                           => true,
        'include'                                     => true,
        'linebreak_after_opening_tag'                 => true,
        'list_syntax'                                 => ['syntax' => 'short'],
        'multiline_whitespace_before_semicolons'      => true,
        'native_function_casing'                      => true,
        'no_alternative_syntax'                       => true,
        'no_binary_string'                            => true,
        'no_blank_lines_after_class_opening'          => true,
        'no_blank_lines_after_phpdoc'                 => true,
        'no_empty_comment'                            => true,
        'no_empty_phpdoc'                             => true,
        'no_empty_statement'                          => true,
        'no_extra_blank_lines'                        => true,
        'no_leading_import_slash'                     => true,
        'no_leading_namespace_whitespace'             => true,
        'no_mixed_echo_print'                         => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_short_bool_cast'                          => true,
        'echo_tag_syntax'                             => ['format' => 'long', 'long_function' => 'echo'],
        'no_singleline_whitespace_before_semicolons'  => true,
        'no_spaces_around_offset'                     => true,
        'no_unneeded_braces'                          => true,
        'no_unneeded_control_parentheses'             => true,
        'no_unused_imports'                           => true,
        'no_whitespace_before_comma_in_array'         => true,
        'no_whitespace_in_blank_line'                 => true,
        'normalize_index_brace'                       => true,
        'object_operator_without_whitespace'          => true,
        'ordered_imports'                             => true,
        'return_type_declaration'                     => ['space_before' => 'none'],
        'semicolon_after_instruction'                 => true,
        'short_scalar_cast'                           => true,
        'space_after_semicolon'                       => true,
        'standardize_not_equals'                      => true,
        'ternary_operator_spaces'                     => true,
        'ternary_to_null_coalescing'                  => true,
        'trailing_comma_in_multiline'                 => true,
        'trim_array_spaces'                           => true,
        'type_declaration_spaces'                     => true,
        'unary_operator_spaces'                       => true,
        'visibility_required'                         => true,
        'whitespace_after_comma_in_array'             => true,
        'single_quote'                                => true,
        'strict_param'                                => true,
        'void_return'                                 => true,
        'ternary_to_elvis_operator'                   => false,
        'ordered_class_elements'                      => true,
        'ordered_interfaces'                          => true,
        'ordered_traits'                              => true,
        'operator_linebreak'                          => true,
        'binary_operator_spaces'                      => [
            'default'   => null,
            'operators' => [
                '=>' => 'align_single_space_minimal',
            ],
        ],
        'declare_strict_types'        => true,
        'single_import_per_statement' => true,
    ]);
