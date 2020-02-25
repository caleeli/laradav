<?php

namespace Laradav\Foundation;

trait HasBasePathTrait
{
    protected $basePath = '';

    protected function HasBasePathTrait($basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * Get the value of basePath
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * Set the value of basePath
     *
     * @return  self
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;

        return $this;
    }
}
