<?php


namespace Tests;

/**
 * O programa irá tentar encontrar uma classe com o nome "Metadata", filha desta, para poder saber como renderizar a view.
 * Class AbstractDirectoryMetadata
 * @package Tests
 */
abstract class FormCardDirectoryMetadata extends AbstractDirectoryMetadata
{
    public $viewType = self::TYPE_FORM_CARD;

    public function buildTitle(string $directoryName): ?string
    {
        return $this->title ?: $directoryName;
    }
}