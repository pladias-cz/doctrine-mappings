<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Attributes;

use Doctrine\ORM\Mapping\Column;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;

trait TMptt
{

    #[Column(type: 'integer')]
    protected(set) int $depth;

    #[Column(type: 'integer')]
    protected(set) int $lft;

    #[Column(type: 'integer')]
    protected(set) int $rgt;

}
