<?php

namespace Tighten\TLint;

use PhpParser\Lexer;
use PhpParser\Parser;

class BaseFormatter
{
    public const DESCRIPTION = 'No Description for Formatter.';

    protected $description;
    protected $filename;
    protected $code;
    protected $codeLines;

    public function __construct($code, $filename = null)
    {
        $this->description = static::DESCRIPTION;
        $this->filename = $filename;
        $this->code = $code;
        $this->codeLines = preg_split('/\r\n|\r|\n/', $code);
    }

    public static function appliesToPath(string $path, array $configPaths): bool
    {
        return true;
    }

    public function format(Parser $parser, Lexer $lexer)
    {
        return [];
    }

    public function getFormatDescription()
    {
        return $this->description;
    }

    public function setFormatDescription(string $description)
    {
        return $this->description = $description;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getCodeLines()
    {
        return $this->codeLines;
    }

    public function getCodeLine(int $line)
    {
        return $this->getCodeLines()[$line - 1];
    }

    public function replaceCodeLine(int $line, string $replacement): string
    {
        $this->codeLines[$line - 1] = $replacement;

        return implode(PHP_EOL, $this->codeLines);
    }
}
