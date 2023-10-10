<?php

namespace App\Entity;

//レポートエンティティクラス

class User
{
    //ユーザID
    private ?int $id = null;

    //メールアドレス
    private ?string $usMail = "";

    //名前
    private ?string $usName = "";

    //パスワード
    private ?string $usPassword = "";


    //権限 : 0=終了 1=管理者 2=一般
    private ?int $usAuth = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getUsMail(): ?string
    {
        return $this->usMail;
    }
    public function setUsMail(?string $usMail): void
    {
        $this->usMail = $usMail;
    }

    public function getUsName(): ?string
    {
        return $this->usName;
    }
    public function setUsName(?string $usName): void
    {
        $this->usName = $usName;
    }

    public function getUsPassword(): ?string
    {
        return $this->usPassword;
    }
    public function setUsPassword(?string $usPassword): void
    {
        $this->usPassword = $usPassword;
    }

    public function getUsAuth(): ?int
    {
        return $this->usAuth;
    }
    public function setUsAuth(?int $usAuth): void
    {
        $this->usAuth = $usAuth;
    }
}
