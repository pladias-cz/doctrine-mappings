<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Atlas;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Public\Users;

#[Entity()]
#[Table(name: 'atlas.comments')]
class Comments
{
    use TId;

    #[Column(name: 'creation_timestamp', type: Types::DATETIME_MUTABLE, nullable: false)]
    protected(set) \DateTime $creation_timestamp;
    #[Column(type: 'boolean')]
    protected(set) bool $deleted;
    #[Column(type: 'boolean')]
    protected(set) bool $imported;
    #[Column(type: 'boolean')]
    protected(set) bool $resolved;
    #[Column(name: 'resolved_timestamp', type: Types::DATETIME_MUTABLE, nullable: false)]
    protected(set) \DateTime $resolved_timestamp;
    #[Column(name: 'edit_timestamp', type: Types::DATETIME_MUTABLE, nullable: false)]
    protected(set) \DateTime $edit_timestamp;
    #[Column]
    protected(set) string $message;


    #[ManyToOne(targetEntity: Users::class)]
    #[JoinColumn(name: 'author_id', referencedColumnName: 'id')]
    protected(set) Users $author;

    #[ManyToOne(targetEntity: Users::class)]
    #[JoinColumn(name: 'solver_id', referencedColumnName: 'id')]
    protected(set) Users $solver;

    #[ManyToOne(targetEntity: Records::class)]
    #[JoinColumn(name: 'record_id', referencedColumnName: 'id')]
    protected(set) Records $record;

}
