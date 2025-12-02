<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Floravegeu;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TCreatedAt;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'floravegeu.syntaxons_synonyms_versions')]
class SyntaxonsSynonymsVersions
{
    use TId;

    use TCreatedAt;

    #[Column(type: 'string')]
    protected(set) string $cpn;

    #[ManyToOne(targetEntity: SyntaxonsSynonyms::class, inversedBy: 'versions')]
    #[JoinColumn(name: 'synonymum', referencedColumnName: 'id')]
    protected(set) SyntaxonsSynonyms $synonymum;

    #[Column(type: 'string')]
    protected(set) string $codeRemark;

    #[Column(type: 'string')]
    protected(set) string $remark;

    #[Column(type: 'string')]
    protected(set) string $versionDescription;

    #[Column(type: 'string')]
    protected(set) string $nameShort;

    #[Column(type: 'string')]
    protected(set) string $nameAuthor;

    public function getFormatedOutput(): string
    {
        $text = $this->nameShort;
        if ($this->getCpn() != '') {
            $text .= " (" . $this->getCpn() . ")";
        }
        if ($this->codeRemark != null) {
            $text .= " – " . $this->codeRemark;
        }

        $text .= " " . $this->remark;
        return $text;
    }

    public function getCpn(): string
    {
        if (is_null($this->cpn)) {
            return "";
        }
        return $this->cpn;
    }

}
