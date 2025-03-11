<?php declare(strict_types = 1);

namespace Pladias\ORM\Entity\Attributes;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;

trait TCreatedAt
{

    #[Column(type: Types::DATETIME_IMMUTABLE, nullable: false)]
    protected DateTimeImmutable $createdAt;

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(): mixed
    {
        $this->createdAt = new DateTimeImmutable();

        return $this;
    }

}
