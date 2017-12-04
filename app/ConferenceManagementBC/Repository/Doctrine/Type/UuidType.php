<?php

declare(strict_types=1);

namespace App\ConferenceManagementBC\Repository\Doctrine\Type;

use Doctrine\DBAL\Types\Type;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class UuidType extends Type
{
    const TYPE_NAME = 'uuid';
    
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getClobTypeDeclarationSQL($fieldDeclaration);
    }
    
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (is_null($value)) {
            return '';
        }
    
        if (! $value instanceof UuidInterface) {
            throw ConversionException($value, $this->getName());
        }
    
        return $value->toString();
    }
    
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }
    
        try {
            return Uuid::fromString($value);
        } catch (\Exception $e) {
            throw ConversionException($value, $this->getName());
        }
    }
    
    public function getName()
    {
        return static::TYPE_NAME;
    }
}