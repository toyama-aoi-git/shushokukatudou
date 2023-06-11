<?php
/**
 * PH35 サンプル2 PHP DB Access Src11/14
 * Ch4-1 エンティティクラスその1。
 * 
 * @author Shinzo SAITO
 * 
 * ファイル名=Order.php
 * フォルダ=/ph35/phpdb/findone/
 */

/**
 * 注文情報エンティティ。
 * ordersテーブルに対応するエンティティクラス。
 * ある程度定型化されている。
 * エンティティクラスには、必ず対応するテーブルが存在する。
 * まずはテーブルの構造を理解する必要あり。
 */

// クラス名は必ず対応するテーブル名に対応したものにする(分かりやすい)。
class Order {

    // カラム名に対応するprivateプロパティを付ける(必ずカラム数と同じ量を作る)。
    // nullが入る可能性があるため、データ型の宣言は「?データ型」の形にする。
    // 初期値：文字列は空文字、それ以外はnullを記述する。
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

    //以下アクセサメソッド
    // プロパティの数だけ、ゲッターとセッターを作る。
    // データ型は、プロパティと同一のものになる。
    public function getOrderId(): ?int {
        return $this->orderId;
    }
    // void:戻り値無し
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

