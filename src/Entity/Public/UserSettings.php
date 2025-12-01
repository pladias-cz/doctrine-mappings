<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Public;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'public.user_settings')]
class UserSettings
{
    use TId;

    #[ManyToOne(targetEntity: Users::class)]
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    protected(set) Users $user;

    #[Column(type: 'string')]
    protected(set) string $value;

    #[Column(type: 'string')]
    protected(set) string $key;


}
