<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Dalibcz;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Public\Taxons;

#[Entity()]
#[Table(name: 'dalibcz.images')]
class Images
{
    use Tid;

    #[ManyToOne(targetEntity: Taxons::class)]
    #[JoinColumn(name: 'taxon', referencedColumnName: 'id')]
    protected(set) Taxons $taxon;

    #[Column(name: 'size_raw', type: 'blob')]
    protected(set) mixed $sizeRaw;
    #[Column(type: 'string')]
    protected(set) string $description;
    #[Column(type: 'string')]
    protected(set) string $author;
    #[Column(name: 'extension', type: 'string')]
    protected(set) string $fileExtension;
    #[Column(name: 'mime', type: 'string')]
    protected(set) string $mimeType;

    public function setTaxon(Taxons $taxon): Images
    {
        $this->taxon = $taxon;
        return $this;
    }

    public function getSizeRaw()
    {
        return stream_get_contents($this->sizeRaw);
    }

    public function setSizeRaw($sizeRaw): Images
    {
        $this->sizeRaw = $sizeRaw;
        return $this;
    }

    public function setDescription(string $description): Images
    {
        $this->description = $description;
        return $this;
    }

    public function setAuthor(string $author): Images
    {
        $this->author = $author;
        return $this;
    }

    public function setFileExtension(string $fileExtension): Images
    {
        $this->fileExtension = $fileExtension;
        return $this;
    }

    public function setMimeType(string $mimeType): Images
    {
        $this->mimeType = $mimeType;
        return $this;
    }

}
