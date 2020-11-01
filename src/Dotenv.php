<?php

namespace m4rku5\Dotenv;

use InvalidArgumentException;
use SplFileObject;
use SplObjectStorage;

class Dotenv
{
    /** @var SplFileObject */
    protected $file;

    /** @var SplObjectStorage */
    protected $content;

    /**
     * Assumes loaction in ./vendor/m4rku5/dotenv/src
     * @param  string  $path
     */
    public function __construct($path = __DIR__ . '/../../../../.env')
    {
        $this->content = new SplObjectStorage();
        $this->load($path)->parse();
    }

    /**
     * Load contents of an env file.
     *
     * @param  string  $path
     * @return self
     */
    private function load($path): self
    {
        if (!file_exists($path)) {
            throw new InvalidArgumentException(sprintf('%s does not exist', $path));
        }

        $this->file = new SplFileObject($path, 'r+');

        return $this;
    }

    private function parse(): self
    {
        foreach ($this->file as $line) {
            $this->content->attach(new DotenvLine($line));
        }
        return $this;
    }

    private function find(string $key): ?DotenvLine
    {
        /** @var DotenvLine $line */
        foreach ($this->content as $line) {
            if ($line->key() === $key) {
                return $line;
            }
        }
        return null;
    }

    /**
     * Add a key value pair to the env file.
     *
     * @param  string  $key
     * @param  string  $value
     * @return self
     */
    public function add(string $key, string $value): self
    {
        $this->content->attach(new DotenvLine($key . '=' . $value));
        return $this;
    }

    /**
     * Set a key value pair for the env file.
     *
     * @param  string  $key
     * @param  string  $value
     * @return self
     */
    public function set($key, $value): self
    {
        /** @var DotenvLine $line */
        if ($line = $this->find($key)) {
            $line->value($value);
        } else {
            $this->add($key, $value);
        }
        return $this;
    }

    /**
     * Unset a key value of the env file.
     *
     * @param  string  $key
     * @return self
     */
    public function unset($key): self
    {
        /** @var DotenvLine $line */
        if ($line = $this->find($key)) {
            $this->content->detach($line);
        }
        return $this;
    }

    /**
     * Enable a key within the env file.
     *
     * @param  string  $key
     * @return self
     */
    public function enable(string $key): self
    {
        /** @var DotenvLine $line */
        if ($line = $this->find($key)) {
            $line->comment(false);
        }
        return $this;
    }

    /**
     * Disable a key within the env file.
     *
     * @param  string  $key
     * @return self
     */
    public function disable(string $key): self
    {
        /** @var DotenvLine $line */
        if ($line = $this->find($key)) {
            $line->comment(true);
        }
        return $this;
    }

    /**
     * Get all of the env values or a single value by key.
     *
     * @param  string  $key
     * @return SplObjectStorage<DotenvLine>|DotenvLine
     */
    public function get($key = null)
    {
        if ($key === null) {
            return $this->content;
        }
        return $this->find($key);
    }

    /**
     * Save the current representation to disk. If no path is specifed and
     * a file was loaded, it will overwrite the file that was loaded.
     *
     * @param  string  $path
     * @return bool
     */
    public function save($path = '')
    {
        // TODO@MM: implement
        return $this;
    }

    /**
     * Check if a key is defined in the env.
     *
     * @param  string  $key
     * @return bool
     */
    public function has($key)
    {
        // TODO@MM: implement
        return $this;
    }
}
