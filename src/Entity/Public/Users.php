<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Public;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'public.users')]
class Users
{
    use TId;

    #[Column(type: 'boolean')]
    protected(set) bool $biblioadmin;

    #[Column(type: 'boolean')]
    protected(set) bool $deleted;

    #[Column]
    protected(set) string $description;

    #[Column]
    protected(set) string $email;

    #[Column(type: 'integer')]
    protected(set) int $last_taxon_id;

    #[Column(type: 'boolean')]
    protected(set) bool $mapadmin;

    #[Column]
    protected(set) string $name;

    #[Column]
    protected(set) string $password;

    #[Column]
    protected(set) string $surname;

    #[Column(type: 'boolean')]
    protected(set) bool $sysadmin;

    #[Column(type: 'boolean')]
    protected(set) bool $taxonadmin;

    #[Column(type: 'boolean')]
    protected(set) bool $traitadmin;


}
