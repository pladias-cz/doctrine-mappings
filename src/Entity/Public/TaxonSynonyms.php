<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Public;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'public.taxons_synonyms')]
class TaxonSynonyms
{
    use TId;

    public const string SOURCE_KLIC = 'Klíč';

    #[ManyToOne(targetEntity: Taxons::class, inversedBy: 'synonyms')]
    #[JoinColumn(name: 'taxon_id', referencedColumnName: 'id')]
    protected(set) Taxons $taxon;

    #[Column(type: 'string')]
    protected(set) string $nameLat;

    #[Column(type: 'string')]
    protected(set) string $suffix;

    #[Column(type: 'string')]
    protected(set) string $nameHtml;

    #[Column(type: 'boolean')]
    protected(set) bool $autocomplete;

    #[ManyToOne(targetEntity: Publications::class)]
    #[JoinColumn(name: 'publication_id', referencedColumnName: 'id')]
    protected(set) Publications $publication;

    public function getSuffix(): ?string
    {
        if ($this->suffix === '') {
            return NULL;
        }
        return "[" . $this->suffix . "]";
    }

}
