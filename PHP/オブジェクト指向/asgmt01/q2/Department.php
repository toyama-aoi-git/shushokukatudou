<?php

class Department
{
    // まずは宣言
    /**
     * @var integer 部門ID
     */
    private ?int $departmentId = null;

    /**
     * @var string 部門名
     */
    private ?string $departmentName = "";

    /**
     * @var integer マネージャーID
     */
    private ?int $managerId = null;

    /**
     * @var integer ロケーションID
     */
    private ?int $locationId = null;

    // こっからアクセサメソッド(ゲッター、セッターの順)

    // departmentId
    public function getDepartmentId(): ?int
    {
        return $this->departmentId;
    }
    public function setDepartmentId(?int $departmentId): void
    {
        $this->departmentId = $departmentId;
    }

    // departmentName
    public function getDepartmentName(): ?string
    {
        return $this->departmentName;
    }
    public function setDepartmentName(?string $departmentName): void
    {
        $this->departmentName = $departmentName;
    }

    // managerId
    public function getManagerId(): ?int
    {
        return $this->managerId;
    }
    public function setManagerId(?int $managerId): void
    {
        $this->managerId = $managerId;
    }

    // locationId
    public function getLocationId(): ?int
    {
        return $this->locationId;
    }
    public function setLocationId(?int $locationId): void
    {
        $this->locationId = $locationId;
    }
}
