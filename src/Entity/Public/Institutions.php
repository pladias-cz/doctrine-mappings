<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Public;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'public.institutions')]
class Institutions
{
    use TId;

    #[ManyToMany(targetEntity: Users::class)]
    #[JoinTable(
        name: 'atlas.institutions_users',
        joinColumns: [
            new JoinColumn(name: 'institution_id', referencedColumnName: 'id')
        ],
        inverseJoinColumns: [
            new JoinColumn(name: 'user_id', referencedColumnName: 'id')
        ]
    )]
    protected(set) Collection $users;

    #[Column]
    protected(set) string $name;

    #[Column]
    protected(set) string $name_eng;

    #[Column]
    protected(set) string $name_short;


}
