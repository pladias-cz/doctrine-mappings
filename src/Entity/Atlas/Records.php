<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Atlas;

use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\AtlasNonVascular\RecordsExtension;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Geodata\Districts;
use Pladias\ORM\Entity\Geodata\Phytochorions;
use Pladias\ORM\Entity\Public\Taxons;

#[Entity()]
#[Table(name: 'atlas.records')]
class Records
{
    use TId;

    #[Column(type: 'integer')]
    protected(set) int $batch_id;
    #[Column(type: 'integer')]
    protected(set) int $altitude_approx;
    #[Column(type: 'integer')]
    protected(set) ?int $altitude_max;
    #[Column(type: 'integer')]
    protected(set) ?int $altitude_min;
    #[Column]
    protected(set) string $comment;
    #[Column]
    protected(set) ?string $datum;
    #[Column]
    protected(set) string $datum_precision;
    #[Column]
    protected(set) string $detrev;
    #[Column]
    protected(set) string $environment;
    #[Column]
    protected(set) string $gps_coords_source;
    #[Column]
    protected(set) string $locality;
    #[Column]
    protected(set) ?string $nearest_town_text;
    #[Column]
    protected(set) string $original_name;
    #[Column]
    protected(set) ?string $source;
    #[ManyToOne(targetEntity: Projects::class)]
    #[JoinColumn(name: 'project_id', referencedColumnName: 'id')]
    protected(set) Projects $project;
    #[ManyToOne(targetEntity: RecordValidationStatus::class)]
    #[JoinColumn(name: 'validation_status', referencedColumnName: 'id')]
    protected(set) RecordValidationStatus $validationStatus;
    #[ManyToOne(targetEntity: Districts::class)]
    #[JoinColumn(name: 'district_id', referencedColumnName: 'id')]
    protected(set) Districts $district;

    #[ManyToOne(targetEntity: Districts::class)]
    #[JoinColumn(name: 'nearest_town_id', referencedColumnName: 'id')]
    protected(set) Districts $nearestTown;
    #[ManyToOne(targetEntity: RecordOriginalityStatus::class)]
    #[JoinColumn(name: 'originality_id', referencedColumnName: 'id')]
    protected(set) RecordOriginalityStatus $originalityStatus;

    #[ManyToOne(targetEntity: Taxons::class)]
    #[JoinColumn(name: 'taxon_id', referencedColumnName: 'id')]
    protected(set) Taxons $taxon;

    #[ManyToOne(targetEntity: Phytochorions::class)]
    #[JoinColumn(name: 'phytochorion_id', referencedColumnName: 'rowid')]
    protected(set) ?Phytochorions $phytochorion;

    #[ManyToMany(targetEntity: Authors::class)]
    #[JoinTable(
        name: 'atlas.records_authors',
        joinColumns: [
            new JoinColumn(name: 'records_id', referencedColumnName: 'id')
        ],
        inverseJoinColumns: [
            new JoinColumn(name: 'authors_id', referencedColumnName: 'id')
        ]
    )]
    protected(set) Collection $authors;

    #[ManyToMany(targetEntity: Herbariums::class)]
    #[JoinTable(
        name: 'atlas.records_herbariums',
        joinColumns: [
            new JoinColumn(name: 'records_id', referencedColumnName: 'id')
        ],
        inverseJoinColumns: [
            new JoinColumn(name: 'herbariums_id', referencedColumnName: 'id')
        ]
    )]
    protected(set) Collection $herbariums;

    #[Column]
    protected(set) string $coords_wgs;
    #[Column(name: 'edit_timestamp', type: Types::DATETIME_MUTABLE, nullable: false)]
    protected(set) \DateTime $edit_timestamp;
    #[Column(type: 'integer')]
    protected(set) int $gps_coords_precision;
    #[Column(type: 'boolean')]
    protected(set) bool $herbariumQuality;
    #[Column(type: 'boolean')]
    protected(set) bool $includeInMap;
    #[Column(type: 'float')]
    protected(set) float $latitude;
    #[Column(type: 'float')]
    protected(set) float $longitude;
    #[OneToOne(targetEntity: RecordsExtension::class, mappedBy: 'recordId', fetch: 'LAZY')]
    protected(set) ?RecordsExtension $nonVascularExtension;


    public function isExpired(): bool
    {
        if (NULL === $this->datum) {
            return true;
        }

        if ($this->getDateUnix() === 0) {
            return true; //neuvedeno datum, mění na 1970
        }
        if ($this->getDateUnix() < 694220400) {
            return true;//date -d "1992-01-01" "+%s"
        }

        return false;
    }

    private function getDateUnix()
    {
        return strtotime($this->datum);

    }

    public function getDateFormated(): string
    {
        if (NULL == $this->datum) {
            return '';
        }
        switch ($this->datum_precision) {
            case "Y" :
                return date("Y", $this->getDateUnix());
            case "M":
                return date("Y-n", $this->getDateUnix());

            default:
                return date("Y-n-j", $this->getDateUnix());

        }
    }

    public function getNonVascularExtension(): RecordsExtension
    {
        return $this->nonVascularExtension;
    }

    public function getAltitudes()
    {
        if ($this->altitude_min == $this->altitude_max) {
            return $this->altitude_min;
        } else {
            return $this->altitude_min . "-" . $this->altitude_max;
        }
    }

}
