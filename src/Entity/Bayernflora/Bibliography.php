<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Bayernflora;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'bayernflora.bibliography')]
class Bibliography
{
    use TId;

    #[Column]
    protected(set) string $abbreviation;

    #[Column]
    protected(set) string $citation;

    #[Column]
    protected(set) string $detail;

    public function getAbbreviation(): string
    {
        return $this->abbreviation;
    }

    public function getCitation(): string
    {
        return $this->citation;
    }

    public function getDetail(): string
    {
        return $this->detail;
    }

}
