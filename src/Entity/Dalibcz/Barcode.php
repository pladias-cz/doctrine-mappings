<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Dalibcz;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'dalibcz.barcode')]
class Barcode
{
    use Tid;

    #[Column]
    protected(set) string $taxon;
    #[Column]
    protected(set) string $itemId;
    #[Column]
    protected(set) string $country;
    #[Column]
    protected(set) string $source;
    #[Column(name: 'accession_its')]
    protected(set) ?string $accessionITS;
    #[Column(name: 'accession_mtssu')]
    protected(set) ?string $accessionMTSSU;
    #[Column(name: 'seq_its')]
    protected(set) ?string $seqITS;
    #[Column(name: 'seq_mtssu')]
    protected(set) ?string $seqMTSSU;
    #[Column(name: 'method_its')]
    protected(set) ?string $methodITS;
    #[Column(name: 'method_mtssu')]
    protected(set) ?string $methodMTSSU;


    public function getSeqITS_HTML(): string
    {
        if ($this->seqITS == '') {
            return "";
        }
        $text = ">ITS_" . str_replace(" ", "_", $this->taxon) . "_" . $this->country . "_" . $this->accessionITS . "_" . $this->itemId . "_" . $this->source . "\n";
        $text .= "<pre>" . $this->seqITS . "</pre>";
        return $text;
    }

    public function getSeqMTSSU_HTML(): string
    {
        if ($this->seqMTSSU == '') {
            return "";
        }
        $text = ">mtSSU_" . str_replace(" ", "_", $this->taxon) . "_" . $this->country . "_" . $this->accessionMTSSU . "_" . $this->itemId . "_" . $this->source . "\n";
        $text .= "<pre>" . $this->seqMTSSU . "</pre>";

        return $text;
    }

}
