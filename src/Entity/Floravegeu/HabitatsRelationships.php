<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Floravegeu;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'floravegeu.habitats_syntaxons_relationships')]
class HabitatsRelationships
{
    use TId;

    #[Column]
    protected(set) string $code;

    #[Column]
    protected(set) string $description;

    public function getCodeInverted(): string
    {
        $code = $this->code;
        switch ($code) {
            case ">":
                return "<";
                break;
            case "<":
                return ">";
                break;
            default:
                return $this->code;
        }

    }

}
