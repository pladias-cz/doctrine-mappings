<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Floravegeu;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TCreatedAt;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Public\Syntaxons;

#[Entity()]
#[Table(name: 'floravegeu.syntaxons_remarks_versions')]
class SyntaxonsRemarksVersions
{
    use TId;
    use TCreatedAt;

    #[Column]
    protected(set) string $prefix;

    #[Column]
    protected(set) string $content;

    #[ManyToOne(targetEntity: Syntaxons::class, inversedBy: 'remarks')]
    #[JoinColumn(name: 'syntaxon_id', referencedColumnName: 'id')]
    protected(set) Syntaxons $syntaxon;
    #[Column]
    protected(set) string $versionDescription;


}
