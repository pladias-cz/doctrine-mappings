<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Pladiascz;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Attributes\TName;
use Pladias\ORM\Entity\Attributes\TText;

#[Entity()]
#[Table(name: 'pladiascz.downloads')]
class Downloads
{
    use TId;
    use TName;
    use TText;

    public const string SECTION_BIBLIOGRAPHY = "bibliografie";
    public const string  SECTION_COMMON = "common";
    public const string  SECTION_VEGETATION = "vegetace";
    public const string  SECTION_FEATURES = "traits";
    public const string  SECTION_PHYTOGEOGRAPHY = "fytogeografie";

    #[Column]
    protected(set) string $section;

    #[Column(type: 'integer')]
    protected(set) int $succession;

    #[Column(type: 'integer')]
    protected(set) int $version;

    #[OneToMany(targetEntity: DownloadsFiles::class, mappedBy: 'downloadsId')]
    #[OrderBy(['succession' => 'ASC'])]
    protected(set) Collection $files;


}
