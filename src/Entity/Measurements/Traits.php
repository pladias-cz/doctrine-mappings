<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Measurements;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TDescriptionCs;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Public\Users;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;

#[Entity()]
#[Table(name: 'measurements.traits')]
class Traits
{
    use TId;
    use TDescriptionCs;

    #[Column(type: 'string')]
    protected(set) string $attachment;
    #[Column(type: 'string')]
    protected(set) string $attachment_type;
    #[Column(type: 'boolean')]
    protected(set) bool $default_values;
    #[Column(type: 'boolean')]
    protected(set) bool $deleted;
    #[Column(name: 'source', type: 'string')]
    protected(set) string $sourceCs;
    #[Column(type: 'string')]
    protected(set) string $sourceEn;
    #[Column(name: 'creation_timestamp', type: Types::DATETIME_MUTABLE)]
    protected(set) \DateTime $creationTimestamp;
    #[ManyToOne(targetEntity: Users::class)]
    #[JoinColumn(name: 'owner', referencedColumnName: 'id')]
    protected(set) Users $owner;
    #[ManyToOne(targetEntity: TraitVisibilityStatus::class)]
    #[JoinColumn(name: 'visibility_status_id', referencedColumnName: 'id')]
    protected(set) TraitVisibilityStatus $visibility_status_id;
    #[ManyToOne(targetEntity: Features::class, inversedBy: 'traits')]
    #[JoinColumn(name: 'feature_id', referencedColumnName: 'id')]
    protected(set) Features $feature_id;

    public function getSource($locale = Locale::CS): string
    {
        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }

        return match ($locale) {
            Locale::CS->value => $this->sourceCs,
            Locale::EN->value => !empty($this->sourceEn) ? $this->sourceEn : $this->sourceCs,
            default => throw new WrongLocaleException(),
        };
    }

}
