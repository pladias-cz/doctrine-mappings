<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\PublicWeb;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'public_web.countries')]
class Countries
{
    use TId;

    #[Column(type: 'string')]
    protected(set) string $code;

    #[Column(type: 'string')]
    protected(set) string $name_en;

    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

}
