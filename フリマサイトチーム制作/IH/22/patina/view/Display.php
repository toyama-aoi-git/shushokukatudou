<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- css -->
<link rel="stylesheet" href="./css/destyle.css">
<link rel="stylesheet" type="text/css" href="./css/headerFooter.css">
<link rel="stylesheet" href="./css/display.css">
<link rel="stylesheet" href="./css/style.css">
<!-- google font -->
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&family=Old+Standard+TT:wght@700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@300&display=swap" rel="stylesheet">
<!-- <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@300&display=swap" rel="stylesheet"> -->
<title>Document</title>
</head>
<body>
    <main>
        <section>
            <h1>出品</h1>
            <div id="send_item">
                <form action="./Display.php" method="post" enctype="multipart/form-data">
                    <div id="productImg">
                        <table>
                            <tr>
                                <th>商品画像</th>
                                <td><input type="file" name="itemImage"><span class="error"><?php echo isset($imageErroe)?"画像を選択してください":"" ?></span></td>
                            </tr>
                        </table>
                    </div>
                    <div id="productSituation">
                        <h2>商品の詳細</h2>
                        <table>
                            <tr>
                                <th>商品の状態</th>
                                <td>
                                    <select name="itemState">
                                        <option value="select">商品の状態を選択してください</option>
                                        <option value="1">目立った傷汚れなし</option>
                                        <option value="2">傷汚れあり</option>
                                        <option value="3">破損あり</option>
                                        <option value="4">状態が悪い</option>            
                                    </select>
                                    <span class="error"><?php echo isset($_POST['itemDisplay'])?"商品の状態を選択してください":"" ?></span>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <th>ジャンル</th>
                                <td>
                                    <select name="genre">
                                    <option value="select">商品のジャンルを選択してください</option>
                                        <option value="1">ナチュラル</option>
                                        <option value="2">和モダン</option>
                                        <option value="3">レトロ</option>
                                        <option value="4">ミッドセンチュリー</option>
                                        <option value="5">ジャンク</option>
                                        <option value="6">ミックススタイル</option>            
                                        <option value="7">エレガント</option>
                                        <option value="8">シャビーシック</option>
                                        <option value="9">大正ロマン</option>
                                        <option value="10">その他</option>
                                    </select>
                                    <span class="error"><?php echo isset($_POST['itemDisplay'])?"ジャンルを選択してください":"" ?></span>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <th>家具種</th>
                                <td>
                                    <select name="kinds">
                                    <option value="select">商品の家具種を選択してください</option>
                                        <option value="1">チェア</option>
                                        <option value="2">ソファ</option>
                                        <option value="3">ベンチ</option>
                                        <option value="4">食器棚</option>
                                        <option value="5">収納棚</option>
                                        <option value="6">本棚</option>            
                                        <option value="7">ドロワー</option>
                                        <option value="8">サイドボード</option>
                                        <option value="9">ローボード</option>
                                        <option value="10">デスク</option>
                                        <option value="11">カウンター</option>
                                        <option value="12">ガラスケース</option>
                                        <option value="13">ベッド</option>
                                        <option value="14">ダイニングテーブル</option>
                                        <option value="15">センター・サイドテーブル</option>
                                        <option value="16">和箪笥</option>
                                        <option value="17">建具</option>
                                    </select>
                                    <span class="error"><?php echo isset($_POST['itemDisplay'])?"家具種を選択してください":"" ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="productDiscribe">
                        <h2>商品名と説明</h2>
                        <table>
                            <tr class="borber_non">
                                <th>商品名</th>
                                <td><input type="text" name="itemName" id="" value="<?php echo isset($_POST['itemName'])?$_POST['itemName']:"";?>"><span class="error"><?php echo isset($nameError)?"商品名を入力してください":"" ?></span></td>
                            </tr>
                            <tr>
                                <th>商品の説明(1000字以内)</th>
                                <td><input type="text" name="itemExplanation" id="" value="<?php echo isset($_POST['itemExplanation'])?$_POST['itemExplanation']:"";?>"><span class="error"><?php echo isset($explanationError)?"説明を1000文字以内で入力してください":"" ?></span></td>
                            </tr>
                        </table>
                    </div>
                    <div id="productDate">
                        <table>
                            <tr>
                                <th>発送までの日時</th>
                                <td>
                                    <select name="shippingTime">
                                        <option id="select" value="select">発送までの日時を選択してください</option>
                                        <option value="1">2~3日で発送</option>
                                        <option value="2">4~6日で発送</option>
                                        <option value="3">1週間以上かかる</option>
                                    </select>
                                    <span class="error"><?php echo isset($_POST['itemDisplay'])?"日時を選択してください":"" ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="productPrice">
                        <h2>販売価格</h2>
                        <table>
                            <tr class="borber_non">
                                <th>販売価格(¥101~100,000,000)</th>
                                <td><span>¥</span><input class="yen" type="text" name="itemPrice" value="<?php echo isset($_POST['itemPrice'])?$_POST['itemPrice']:"";?>"><span class="error"><?php echo isset($priceError)?$priceError:"" ?></span></td>
                            </tr>
                            <tr class="borber_non">
                                <th>販売手数料</th>
                                <td class="fee">￥100</td>
                            </tr>
                        </table>
                        <p>※販売価格から販売手数料を引かせていただきます</p>
                    </div>
                    <div class="nextbtn">
                        <a href="./index.php">TOPへ戻る</a>
                        <button type="submit" name="itemDisplay">出品する</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <!-- <main>
        <section>
            <h1>出品</h1>
            <div>
                <form action="./Display.php">
                    <div id="productImg">
                        <p>商品画像</p>
                        <input type="file" name="itemImage">
                    </div>
                    <div id="productSituation">
                        <h2>商品の詳細</h2>
                        <label>商品の状態</label>
                        <select name="itemState">
                            <option value="1">よい</option>
                            <option value="2">傷み有</option>
                            <option value="3">ぼろい</option>
                            <option value="4">汚れ有</option>            
                        </select>
                    </div>
                    <div id="productDiscribe">
                        <h2>商品名と説明</h2>
                        <p>商品名</p>
                        <input type="text" name="itemName" id="">
                        <p>商品の説明(1000字以内)</p>
                        <input type="text" name="itemExplanation" id="">
                    </div>
                    <div id="productDelivery">
                        <h2>配送について</h2>
                        <select name="itemDelivery">
                            <option value="1">ゆうパック</option>
                            <option value="2">佐川</option>
                            <option value="3">クロネコヤマト</option>
                        </select>
                    </div>
                    <div id="productDate">
                        <p>発送までの日時</p>
                        <select name="shippingTime">
                            <option value="1">2~3日で発送</option>
                            <option value="2">4~6日で発送</option>
                            <option value="3">1週間以上かかる</option>
                        </select>
                    </div>
                    <div id="productPrice">
                        <h2>販売価格</h2>
                        <p>販売価格(¥100~1億)</p>
                        ¥<input type="text" name="itemPrice">
                        <p>販売手数料</p>
                        <p>販売利益</p>
                    </div>
                    <button type="submit" name="itemDisplay">出品する</button>
                </form>
            </div>
        </section>
    </main> -->
</body>
</html>