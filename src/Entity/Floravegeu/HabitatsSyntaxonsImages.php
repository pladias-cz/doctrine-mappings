<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Floravegeu;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'floravegeu.habitats_syntaxons_images')]
class HabitatsSyntaxonsImages
{
    use TId;

    #[ManyToOne(targetEntity: SyntaxonsImages::class)]
    #[JoinColumn(name: 'image', referencedColumnName: 'id')]
    protected(set) SyntaxonsImages $image;

    #[ManyToOne(targetEntity: Habitats::class)]
    #[JoinColumn(name: 'habitat', referencedColumnName: 'id')]
    protected(set) Habitats $habitat;

    #[Column(type: 'boolean')]
    protected(set) bool $included;

}
