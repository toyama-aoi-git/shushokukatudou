<?php
/**
 * PH35 サンプル2 PHP DB Access Src13/14
 * Ch4-2 エンティティクラスその2。
 * 
 * @author Shinzo SAITO
 * 
 * ファイル名=Order.php
 * フォルダ=/ph35/phpdb/findmany/
 */

/**
 * 注文情報エンティティ。
 * ordersテーブルに対応するエンティティクラス。
 */
class Order {
    /**
     * @var integer 注文ID。
     */
    private ?int $orderId = null;
    /**
     * @var string 注文日時。
     */
    private ?string $orderDate = "";
    /**
     * @var string 注文経路。
     */
    private ?string $orderMode = "";
    /**
     * @var integer 注文顧客ID。
     */
    private ?int $customerId = null;
    /**
     * @var integer 注文状況。
     */
    private ?int $orderStatus = null;
    /**
     * @var float 注文合計。
     */
    private ?float $orderTotal = null;
    /**
     * @var integer 注文担当者ID。
     */
    private ?int $salesRepId = null;
    /**
     * @var integerプロモーションコード番号。
     */
    private ?int $promotionId = null;

    /**
     * 整形した注文日時を取得するメソッド。
     * 加工処理のメソッドをエンティティの中に書くことで、保守性が高くなる。
     * →今後はエンティティ内で完結させるようにする！！
     * 
     * @return string 「Y年n月j日H時i分s秒」で整形された注文日時文字列。注文日時データが存在しない場合は、空白文字列。
     */
    public function getOrderDateStr(): string {
        // プロパティがnullの場合を想定しておく。下のコードでは空文字を返すようにしている。
        $orderDateStr = "";
        if(!empty($this->orderDate)) {
            $orderDateStr = date("Y年n月j日 H時i分s秒", strtotime($this->orderDate));
        }
        return $orderDateStr;
    }
    /**
     * 整形した注文合計金額を取得するメソッド。
     * 
     * @return string 3桁ごとにカンマ区切りに整形された注文合計金額文字列。
     */
    public function getOrderTotalStr(): string {
        $orderTotalStr = "";
        if(!empty($this->orderTotal)) {
            $orderDateStr = number_format($this->orderTotal, 2);
        }
        return $orderDateStr;
    }

    //以下アクセサメソッド。

    public function getOrderId(): ?int {
        return $this->orderId;
    }
    public function setOrderId(?int $orderId): void {
        $this->orderId = $orderId;
    }
    public function getOrderDate(): ?string {
        return $this->orderDate;
    }
    public function setOrderDate(?string $orderDate): void {
        $this->orderDate = $orderDate;
    }
    public function getOrderMode(): ?string {
        return $this->orderMode;
    }
    public function setOrderMode(?string $orderMode): void {
        $this->orderMode = $orderMode;
    }
    public function getCustomerId(): ?int {
        return $this->customerId;
    }
    public function setCustomerId(?int $customerId): void {
        $this->customerId = $customerId;
    }
    public function getOrderStatus(): ?int {
        return $this->orderStatus;
    }
    public function setOrderStatus(?int $orderStatus): void {
        $this->orderStatus = $orderStatus;
    }
    public function getOrderTotal(): ?float {
        return $this->orderTotal;
    }
    public function setOrderTotal(?float $orderTotal): void {
        $this->orderTotal = $orderTotal;
    }
    public function getSalesRepId(): ?int {
        return $this->salesRepId;
    }
    public function setSalesRepId(?int $salesRepId): void {
        $this->salesRepId = $salesRepId;
    }
    public function getPromotionId(): ?int {
        return $this->promotionId;
    }
    public function setPromotionId(?int $promotionId): void {
        $this->promotionId = $promotionId;
    }
}