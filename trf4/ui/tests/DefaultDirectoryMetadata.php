<?php


namespace Tests;

class DefaultDirectoryMetadata extends AbstractDirectoryMetadata
{
    public $viewType = self::TYPE_CARD;

    public function buildTitle(string $directoryName): ?string
    {
        return ($this->title ?: $directoryName) . '/';
    }
}