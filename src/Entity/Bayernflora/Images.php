<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Bayernflora;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'bayernflora.images')]
class Images
{
    use TId;

    #[Column(type: 'string')]
    protected(set) string $filename;
    #[Column(type: 'string')]
    protected(set) string $author;
    #[Column(type: 'string')]
    protected(set) string $locality;
    #[Column(type: 'string')]
    protected(set) string $remark;

    #[ManyToOne(targetEntity: FSGTaxons::class, inversedBy: 'images')]
    #[JoinColumn(name: 'taxon', referencedColumnName: 'id')]
    protected(set) FSGTaxons $taxon;
    #[Column(type: 'datetime')]
    protected(set) \DateTime $date;

    public function getTitle(): string
    {
        return $this->author . " – " . $this->locality . ".";
    }

}
