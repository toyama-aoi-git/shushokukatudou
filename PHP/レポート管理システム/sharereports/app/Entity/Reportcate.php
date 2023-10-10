<?php

namespace App\Entity;

//レポートエンティティクラス

class Reportcate
{
    //作業種類ID
    private ?int $id = null;

    //種類名
    private ?string $rcName = "";

    //備考
    private ?string $rcNote = "";

    //リスト表示の有無 : 0=非表示 1=表示
    private ?int $rcListFlg = 1;

    //表示順序
    private ?int $rcOrder = 0;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getRcName(): ?string
    {
        return $this->rcName;
    }
    public function setRcName(?string $rcName): void
    {
        $this->rcName = $rcName;
    }

    public function getRcNote(): ?string
    {
        return $this->rcNote;
    }
    public function setRcNote(?string $rcNote): void
    {
        $this->rcNote = $rcNote;
    }

    public function getRcListFlg(): ?int
    {
        return $this->rcListFlg;
    }
    public function setRcListFlg(?int $rcListFlg): void
    {
        $this->rcListFlg = $rcListFlg;
    }

    public function getRcOrder(): ?int
    {
        return $this->rcOrder;
    }
    public function setRcOrder(?int $rcOrder): void
    {
        $this->rcOrder = $rcOrder;
    }
}
