<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Measurements;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TDescriptionCs;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Attributes\TName;

#[Entity()]
#[Table(name: 'measurements.enumerates_values')]
class EnumeratesValues
{
    use TId;
    use TDescriptionCs;
    use TName;

    #[Column]
    protected(set) string $foreign_id;
    #[Column(type: 'integer')]
    protected(set) int $succession;
    #[Column(type: 'boolean')]
    protected(set) bool $showInDetermination;

    #[ManyToOne(targetEntity: Enumerates::class, inversedBy: 'values')]
    #[JoinColumn(name: 'enumerate_id', referencedColumnName: 'id')]
    protected(set) Enumerates $enumerateId;

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'succession' => $this->succession,
            'showInDetermination' => $this->showInDetermination,
            'en' => [
                'name' => $this->nameEn,
                'description' => $this->descriptionEn,

            ],
            'cs' => [
                'description' => $this->descriptionCs,
                'name' => $this->nameCs
            ]
        ];
    }
}
