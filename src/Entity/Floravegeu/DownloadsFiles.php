<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Floravegeu;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'floravegeu.downloads_files')]
class DownloadsFiles
{
    use TId;

    #[Column(name:'file')]
    protected(set) string $filename;

    #[Column]
    protected(set) string $button;

    #[Column(type: 'integer')]
    protected(set) int $succession;

    #[ManyToOne(targetEntity: Downloads::class, inversedBy: 'files')]
    #[JoinColumn(name: 'downloads_id', referencedColumnName: 'id')]
    protected(set) Downloads $downloadsId;

    public function getIcon(): string
    {
        $extension = pathinfo($this->filename, PATHINFO_EXTENSION);
        switch ($extension) {
            case 'zip':
                return 'icon-archive';
            case 'xls':
            case 'xlsx':
                return 'icon-table';
            case 'pdf':
                return 'icon-pdf';
            case 'shp':
                return 'icon-generic';
            case 'doc':
            case 'docx':
                return 'icon-text';
            default:
                return 'icon-generic';
                break;
        }
    }

}
