# lazyforest
Midterm assignment

使用方式
1. 先git clone 把檔案放到xampp/htdocs
2. 自己建一個分支改自己的功能 (不要merge到MAIN!!)
3. 檔案因為是從我電腦傳上來整合過的，部分路徑及檔名跟你們電腦的不同(請依自己電腦的路徑或檔名修改)
4. db_connect.php 因為是讀PHPMyAdmin的資料表，每個人電腦的設定不同((請依自己的資料庫修改)
  $servername = "localhost";
  $username = "admin";
  $password = "12345";
  $dbname = "my_test_db";  =>請改成自己的dbname
5. 下面有進度追蹤
   
   --------以上---------



進度

紫妤  整合OK
1. create-camp-YU.php 的camp_id 是自己填還是會預設?
2. update-camp-YU.php 的更新照片 是否需要丟回camp_img 不然路徑不同會吃不到圖
3. update-camp-YU.php 更新時間沒有變
<hr>

昶霆   整合OK
1. 刪除類別會從第五個開始刪 (需調整)
<hr>

歆語   整合OK
1. SIGN IN 改成LIAO ver(to do)
<hr>

子云   整合ING
1. js.php 沒給(if need)
2. product-picture.php 沒給
3. 照片不要有中文->會死圖 (須重新改檔名)
4. DB brand_intro ->varchar(1500)改text
5. 有bug
<hr>

千僖   整合ING
1. 排序目前是DESC  應該要ASC?
2. 沒有sort、search
3. table 格式要修
4. 圖片有空白 ex:第一筆poler20.png > DB是poler20.png  img檔名是poler20 .png 檔名有空白，DB內沒有，所以圖片跑不出來
5. 有BUG
<hr>



