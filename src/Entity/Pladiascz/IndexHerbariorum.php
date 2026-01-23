<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Pladiascz;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Atlas\Herbariums;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'pladiascz.index_herbariorum')]
class IndexHerbariorum
{
    use TId;

    #[ManyToOne(targetEntity: Herbariums::class)]
    #[JoinColumn(name: 'herbarium_id', referencedColumnName: 'id')]
    protected(set) ?Herbariums $pladiasHerbarium;

    #[Column(type: 'integer', nullable: true)]
    protected(set) ?int $surveyId;

    #[Column(type: 'integer', nullable: true)]
    protected(set) ?int $externalId;

    #[Column(name: 'institution_name', type: 'string', nullable: true)]
    protected(set) ?string $institutionName;

    #[Column(name: 'response_2025', type: 'string', nullable: false, options: ["default" => "full"])]
    protected(set) string $response_2025;

    #[Column(name: 'institution_founded', type: 'string', nullable: true)]
    protected(set) ?string $institutionFounded;

    #[Column(name: 'herbarium_founded', type: 'string', nullable: true)]
    protected(set) ?string $herbariumFounded;

    #[Column(type: 'string', nullable: true)]
    protected(set) ?string $acronym;

    #[Column(name: 'address_correspondence', type: 'text', nullable: true)]
    protected(set) ?string $addressCorrespondence;

    #[Column(name: 'address_visiting', type: 'text', nullable: true)]
    protected(set) ?string $addressVisiting;

    #[Column(type: 'text', nullable: true)]
    protected(set) ?string $phone;

    #[Column(type: 'text', nullable: true)]
    protected(set) ?string $email;

    #[Column(name: 'web_institution', type: 'string', nullable: true)]
    protected(set) ?string $webInstitution;

    #[Column(name: 'web_catalogue', type: 'string', nullable: true)]
    protected(set) ?string $webCatalogue;

    #[Column(name: 'gps_visiting', type: 'string', nullable: true)]
    protected(set) ?string $gpsVisiting;

    #[Column(name: 'curator_lead', type: 'string', nullable: true)]
    protected(set) ?string $curatorLead;

    #[Column(name: 'curator_others', type: 'text', nullable: true)]
    protected(set) ?string $curatorOthers;

    #[Column(type: 'text', nullable: true)]
    protected(set) ?string $collectors;

    #[Column(type: 'text', nullable: true)]
    protected(set) ?string $collections;

    #[Column(type: 'text', nullable: true)]
    protected(set) ?string $custods;

    #[Column(type: 'text', nullable: true)]
    protected(set) ?string $gbif;

    #[Column(type: 'text', nullable: true)]
    protected(set) ?string $note;
}
