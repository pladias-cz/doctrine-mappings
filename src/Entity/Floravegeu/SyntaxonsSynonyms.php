<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Floravegeu;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Public\Syntaxons;

#[Entity()]
#[Table(name: 'floravegeu.syntaxons_synonyms')]
class SyntaxonsSynonyms
{
    use TId;

    #[Column]
    protected(set) string $originalName;

    #[ManyToOne(targetEntity: Syntaxons::class, inversedBy: 'synonyms')]
    #[JoinColumn(name: 'syntaxon', referencedColumnName: 'id')]
    protected(set) Syntaxons $syntaxon;

    #[OneToMany(targetEntity: SyntaxonsSynonymsVersions::class, mappedBy: 'synonymum')]
    #[OrderBy(['createdAt' => 'DESC'])]
    protected(set) Collection $versions;

    public function getLastVersion()
    {
        return $this->versions[0];
    }

}
