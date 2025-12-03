<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Pladiascz;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;

#[Entity()]
#[Table(name: 'pladiascz.downloads_files')]
class DownloadsFiles
{
    use TId;

    #[Column]
    protected(set) string $fileCs;
    #[Column]
    protected(set) string $fileEn;
    #[Column]
    protected(set) string $buttonCs;
    #[Column]
    protected(set) string $buttonEn;
    #[Column(type: 'integer')]
    protected(set) int $succession;
    #[ManyToOne(targetEntity: Downloads::class, inversedBy: 'records')]
    #[JoinColumn(name: 'downloads_id', referencedColumnName: 'id')]
    protected(set) Downloads $downloadsId;

    public function getIcon($locale = Locale::CS)
    {
        $extension = pathinfo($this->getFilename($locale), PATHINFO_EXTENSION);
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


    public function getFilename($locale = Locale::CS): string
    {
        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }

        return match ($locale) {
            Locale::CS->value => $this->fileCs,
            Locale::EN->value => !empty($this->fileEn) ? $this->fileEn : $this->fileCs,
            default => throw new WrongLocaleException(),
        };
    }

    public function getText($locale = Locale::CS): string
    {
        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }

        return match ($locale) {
            Locale::CS->value => $this->buttonCs,
            Locale::EN->value => !empty($this->buttonEn) ? $this->buttonEn : $this->buttonCs,
            default => throw new WrongLocaleException(),
        };
    }

}
