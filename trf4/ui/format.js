const jsBeautify = require('js-beautify')['js_beautify'];
const fs = require('fs');
const glob = require('glob');

const options = {
    indent_size: 4,
    indent_char: ' ',
    indent_with_tabs: false,
    eol: '\n',
    end_with_newline: true,
    indent_level: 0,
    preserve_newlines: false,
    max_preserve_newlines: 0,
    space_in_paren: false,
    space_in_empty_paren: false,
    jslint_happy: false,
    space_after_anon_function: false,
    brace_style: 'collapse',
    break_chained_methods: false,
    keep_array_indentation: false,
    unescape_strings: false,
    wrap_line_length: 0,
    e4x: false,
    comma_first: false,
    operator_position: 'before-newline'
};

const data = fs.readFileSync('test.js', 'utf8');
const nextData = jsBeautify(data, options);
fs.writeFileSync('test.js', nextData, 'utf8');