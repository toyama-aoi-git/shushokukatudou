drop tables m_book;

CREATE TABLE `m_book` (
  `id` int(11) NOT NULL COMMENT '主キー',
  `title` varchar(255) NOT NULL COMMENT '本のタイトル',
  `volume` int(11) NOT NULL COMMENT '巻数',
  `price` int(11) NOT NULL COMMENT '価格',
  `release_date` date NOT NULL COMMENT '発売日',
  `purchase_date` date DEFAULT NULL COMMENT '購入日：購入していない場合はnull',
  `del_date` date DEFAULT NULL COMMENT '削除日：削除していない場合はnull'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `m_book`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `m_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主キー';

INSERT INTO m_book
(id,title,volume,price,release_date,purchase_date)
VALUES
(1,'ハイキュー',41,484,'2020-01-04','2020-01-10'),
(2,'約束のネバーランド',17,484,'2020-01-04','2020-01-06'),
(3,'ワンピース',95,484,'2019-12-28','2020-01-08'),
(4,'名探偵コナン',97,454,'2019-12-18','2020-01-10')
;

INSERT INTO m_book
(title,volume,price,release_date,purchase_date)
VALUES
('銀魂',41,484,'2020-01-04','2020-01-10');

INSERT INTO m_book
(title,volume,price,release_date,purchase_date,del_date)
VALUES
('バキ',41,484,'2020-01-04','2020-01-10','2020-01-12');

INSERT INTO m_book
(title,volume,price,release_date,purchase_date)
VALUES
('バキ道',42,484,'2020-01-05',NULL);

select * from m_book;





-- INSERT INTO m_book
-- (title,volume,price,release_date,purchase_date)
-- VALUES
-- ('テスト',8,55,'2020-06-06',NULL);


-- INSERT INTO m_book 
-- (title,volume,price,release_date,purchase_date) 
-- VALUES 
-- ('a',4,7,'2020-09-08',NULL);