<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Floravegeu;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'floravegeu.downloads')]
class Downloads
{
    use TId;

    public const string SECTION_VEGETATION = "vegetation";
    public const string  SECTION_SPECIES = "species";

    // TODO this may be incompatible floraveg/pladias
    #[Column]
    protected(set) string $name;
    #[Column]
    protected(set) string $section;

    #[Column(type: 'integer')]
    protected(set) int $succession;

    #[Column]
    protected(set) string $text;

    #[Column]
    protected(set) string $version;

    #[OneToMany(targetEntity: DownloadsFiles::class, mappedBy: 'downloadsId')]
    #[OrderBy(['succession' => 'ASC'])]
    protected(set) Collection $files;

}
