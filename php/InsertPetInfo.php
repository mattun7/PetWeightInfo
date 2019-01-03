<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require_once(dirname(__FILE__).'/Dto/InsertPetInfoDto.php');
    require_once(dirname(__FILE__).'/Dao/InsertPetInfoDao.php');
    require_once(dirname(__FILE__).'/Util/DbConnection.php');
    require_once(dirname(__FILE__).'/Util/FileUtil.php');
    require_once(dirname(__FILE__).'/Util/Json.php');

    if(isset($_POST['pet_name'])){

        // 画像データを保存するファイルパスを取得
        $image_path = Json::getJson('petImagePath');
        $pet_image = $_FILES['pet_image']['name'];
        
        // 画像アップロード
        if(empty($pet_image)){
            $image_path = '';
        } else {
            $image_path .= $pet_image;
        }

        $dto = new InsertPetInfoDto();
        $dto->setPetName($_POST['pet_name']);
        $dto->setBirthday($_POST['birthday']);
        $dto->setPetType($_POST['pet_type']);
        $dto->setColor($_POST['color']);
        $dto->setRemarks($_POST['remarks']);
        $dto->setImagePath($image_path);
        
        try{
            $pdo = DbConnection::getConnection();
            InsertPetInfoDao::insertPetInfo($pdo, $dto);
            FileUtil::imageUpload($image_path);
        } catch (PDOException $e) {
            echo '<script>alert("' + $e->getMessage() + '")</script>';
        } finally {
            $pdo = null;
        }
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ペット情報</title>
<link rel="stylesheet" href="../css/Element.css">
<link rel="stylesheet" href="../css/pet.css">
<script src="../js/InsertPetInfo.js"></script>
</head>
<body>
    <header>
        <h1>ペット一覧</h1>
    </header>
    <aside>
        <ul>
            <li><a href="Select.php">ペット一覧</a></li>
            <li><a href="InsertPetInfo.php">ペット情報登録</a></li>
        </ul>
    </aside>
    <form action="" method="post" enctype="multipart/form-data" >
        <article>
            <h2>
                ぺット情報登録
            </h2>
            <table class="insertPetInfoTable">
                <colgroup width="150"></colgroup>
                <colgroup width="300"></colgroup>
                <tr>
                    <th>
                        ぺット名
                    </th>
                    <td>
                        <input type="text" id="pet_name" name="pet_name" required />
                    </td>
                <tr>
                    <th>
                        誕生日
                    </th>
                    <td>
                        <input type="date" id="birthday" name="birthday" required />
                    </td>
                </tr>
                <tr>
                    <th>
                        品種
                    </th>
                    <td>
                        <input type="text" id="pet_type" name="pet_type" required />
                    </td>
                </tr>
                <tr>
                    <th>
                        カラー
                    </th>
                    <td>
                        <input type="text" id="color" name="color" required />
                    </td>
                </tr>
                <tr>
                    <th>
                        備考
                    </th>
                    <td>
                        <textarea id="remarks" name="remarks"></textarea>
                    </td>
                </tr>
                <tr>
                    <th>
                        画像
                    </th>
                    <td>
                        <input type="file" id="pet_image" name="pet_image" />
                    </td>
                </tr>
            </table>
            <div class="center">
                <input type="submit" id="insert" value="登録" onclick="checkMessage();"/>
            </div>
        </article>
    </form>
</body>
</html>