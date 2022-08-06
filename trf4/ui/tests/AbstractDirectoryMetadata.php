<?php


namespace Tests;

/**
 * O programa irá tentar encontrar uma classe com o nome "Metadata", filha desta, para poder saber como renderizar a view.
 * Class AbstractDirectoryMetadata
 * @package Tests
 */
abstract class AbstractDirectoryMetadata
{
    public $viewType;
    public $title;

    public const TYPE_CARD = 'card';
    public const TYPE_SHARED_CARD = 'sharedcard';
    public const TYPE_FORM_CARD = 'formcard';

    use ReadDescriptionComment;

    abstract public function buildTitle(string $directoryName): ?string;

    public function hasTitle(): bool
    {
        return $this->title !== null;
    }
}