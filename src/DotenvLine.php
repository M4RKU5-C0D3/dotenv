<?php

namespace m4rku5\Dotenv;

use RuntimeException;

class DotenvLine
{
    /** @var string */
    protected $line = '';
    /** @var bool */
    protected $comment;
    /** @var string */
    protected $key;
    /** @var string */
    protected $value;

    /**
     * @param  string  $line
     */
    public function __construct($line)
    {
        $this->line = $line;
        $this->parse();
    }

    private function parse(): self
    {
        if (preg_match('/^(#?)\s*([^=]*)\s*=?\s*(.*)\s*$/', $this->line, $matches) === false) {
            throw new RuntimeException('could not parse line: ' . $this);
        }
        list($line, $comment, $key, $value) = $matches;
        $this->comment = !empty($comment);
        $this->key = $value ? $key : '';
        $this->value = $value ?: $key;
        return $this;
    }

    public function key(string $key = null)
    {
        if ($key === null) {
            return $this->key;
        } else {
            $this->line = str_replace($this->key, $key, $this->line);
            $this->parse();
            return $this;
        }
    }

    public function value(string $value = null)
    {
        if ($value === null) {
            return $this->value;
        } else {
            $this->line = str_replace($this->value, $value, $this->line);
            $this->parse();
            return $this;
        }
    }

    public function comment(bool $value = null)
    {
        if ($value === null) {
            return $this->comment;
        } else {
            if ($this->comment() === $value) {
                return $this; // nothing to do
            }
            // toggle state
            if ($this->comment()) {
                $this->line = preg_replace('/#+/', '', $this->line, 1);
            } else {
                $this->line = '#' . $this->line;
            }
            $this->parse();
        }
        return $this;
    }

    public function __toString()
    {
        return $this->line;
    }
}
