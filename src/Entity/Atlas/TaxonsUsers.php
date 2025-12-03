<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Atlas;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Public\Taxons;
use Pladias\ORM\Entity\Public\Users;

#[Entity()]
#[Table(name: 'atlas.taxons_users')]
class TaxonsUsers
{

    #[Id]
    #[ManyToOne(targetEntity: Users::class)]
    #[JoinColumn(name: 'users_id', referencedColumnName: 'id')]
    protected(set) Users $users_id;

    #[Id]
    #[ManyToOne(targetEntity: Taxons::class, inversedBy: 'revisors')]
    #[JoinColumn(name: 'taxons_id', referencedColumnName: 'id')]
    protected(set) Taxons $taxons_id;

    #[Column(type: 'integer')]
    protected(set) int $succession;

}
