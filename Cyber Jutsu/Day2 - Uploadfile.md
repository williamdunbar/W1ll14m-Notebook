#hackTrick Burpsuit mở tab Render sẽ hạn chế việc dùng browser
#hackTrick Hạn chế mới khai thác đã dùng các lệnh system

# BrainStorm Board
- Hack = Solve Puzzle = Chơi ghép hình
=> Phải có đầy đủ các mảnh ghép và biết cách phải ghép như thế nào

#### Ta có: 
	1. Untrusted Data(file) bị user upload vào /upload/ trong DocumentRoot
	2. Ta hoàn toàn có thể truy cập vào http://192.168.133.155:12002/upload/{session_id}/
	3. Biết được rằng nguyên tắc của htttd là nhìn vào đuôi file cuối cùng của `{filename}.php` để xác định eanwgf đây có phải là tập tin PHP và đưa cho mod-php xử lý không?
	4. Nếu tìm được cách upload file có đuôi `.php` thì httpd thì httpd sẽ thực thi được code ngay

#### Vì sao không làm giống level 1
1. Dev đã sàng lọc (filter) không cho phép upload đuôi file `.php` bằng cách nào? Bằng cách `explode` để nổ dấu `.` trong filename rồi lấy phần tử có index[1] 
	```php
	$filename = $_FILES["file"]["name"];
            $extension = explode(".", $filename)[1];
            if ($extension === "php") {
                die("Hack detected");
	
```

#### Hướng giải quyết
1. Sẽ ra sao nếu đuôi .php nằm ở phần tử có index khác 1 sau khi explode
