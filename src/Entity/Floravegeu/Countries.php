<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Floravegeu;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'floravegeu.countries')]
class Countries
{
    use TId;

    #[Column]
    protected(set) string $code;

    #[Column]
    protected(set) string $name_en;

    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

}
