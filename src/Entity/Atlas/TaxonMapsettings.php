<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Atlas;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Public\Taxons;

#[Entity()]
#[Table(name: 'atlas.taxon_mapsettings')]
class TaxonMapsettings
{

    #[Column(name: 'taxon_id', type: Types::INTEGER, unique: true, nullable: false)]
    #[Id, GeneratedValue(strategy: 'IDENTITY')]
    protected(set) int $taxon_id;
    #[Column]
    protected(set) string $common_threshold;
    #[Column]
    protected(set) string $edit_count;
    #[Column(type: 'boolean')]
    protected(set) bool $is_mapped;
    #[Column(type: 'boolean')]
    protected(set) bool $locked;
    #[Column]
    protected(set) string $map_type;
    #[Column]
    protected(set) string $mapadmin_comment;
    #[Column]
    protected(set) string $preslia;
    #[Column]
    protected(set) string $revisors_comment;
    #[Column(name: 'preslia_report')]
    protected(set) string $PresliaReportLink;

    #[ManyToOne(targetEntity: TaxonMapsettingsPublication::class)]
    #[JoinColumn(name: 'publication_status', referencedColumnName: 'id')]
    protected(set) TaxonMapsettingsPublication $publication_status;

    #[ManyToOne(targetEntity: TaxonMapsettingsRevision::class)]
    #[JoinColumn(name: 'revision_status', referencedColumnName: 'id')]
    protected(set) TaxonMapsettingsRevision $revision_status;

    #[ManyToOne(targetEntity: Taxons::class)]
    #[JoinColumn(name: 'superior_taxon', referencedColumnName: 'id')]
    protected(set) Taxons $superior_taxon;

    #[Column(name: 'edit_timestamp', type: Types::DATETIME_MUTABLE, nullable: false)]
    protected(set) \DateTime $edit_timestamp;

    public function getisCommon()
    {
        if (0 == $this->common_threshold) {
            return false;
        }
        return true;
    }

}
