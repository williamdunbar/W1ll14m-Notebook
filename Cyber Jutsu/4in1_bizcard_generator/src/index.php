<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BizCard Generator</title>
    <link rel=stylesheet href=style.css>
</head>
<body>
    <div class="column">
        <h1>Business card generator!</h1>
        <i style="color:gray; font-size:0.5em">Fun fact: CyberJutsu vẫn chưa có business card nào :D</i>
        <img src='demo.png' width=200 height=200 />
    </div>
    <div class="column">
        <form method=get action="index.php">
            <div class="resp-textbox">
            <input type=text name=username placeholder="Enter your username here" />
            <label for="level">Chọn level:</label>
            <select name="level" id="level">
                <option value="1" selected>Easy</option>
                <option value="2">Medium</option>
                <option value="3">Hard</option>
                <option value="4">Legend</option>
            </select>
            <fieldset style="text-align: left">
                <legend>Chọn kiểu bizcard nhé:</legend>
                <input type="radio" name="type" value="eyes"><label>eyes</label><br>
                <input type="radio" name="type" value="turtle"><label>turtle</label><br>
                <input type="radio" name="type" value="dragon"><label>dragon</label><br>
                <input type="radio" name="type" value="figlet"><label>figlet</label><br>
                <input type="radio" name="type" value="toilet"><label>toilet</label><br>
                <input type="radio" name="type" value="inception"><label>inception</label><br>
                <input type="radio" name="type" value="tenet"><label>tenet</label><br>
                <input type="radio" name="type" value="random" checked><label>random</label><br>
            </fieldset>
            <input type=submit value="Generate for free!">
            </div>
        </form>
        ------------------ 


<?php
// Challenge starts here

function validate_username($input, $level){

    // Đây là thử thách "bao cát" 4 trong 1.
    // Nhiệm vụ: tìm ra flag ở thư mục gốc /
    // Yêu cầu: Bạn phải cung cấp 04 payload lấy flag,
    // ở cả 4 level bên dưới và gửi đáp án cho giảng viên.

    switch($level){
        default:
        case 1:
            $input = addslashes($input);
            return $input;
        case 2:
            $input = substr($input,0,10);
            $input = addslashes($input);
            return $input;
        case 3:
            // Bad characters, please remove
            $input = preg_replace("/[\x{20}-\x{29}\x{2f}]/","",$input);
            $input = addslashes($input);
            return $input;
        case 4:
            // Bad characters (and more), please remove
            $input = preg_replace("/[\x{20}-\x{29}\x{2f}]/","",$input);
            $input = preg_replace("/[\x{3b}-\x{40}]/","",$input);
            $input = addslashes($input);
            return $input;
    } 
}

$level      = $_GET['level']; // show hình con cheems to dần theo levle ))
$type       = $_GET['type'];
$username   = $_GET['username'];
$username   = validate_username($username,$level);

echo "<pre>"; // tag này giúp in ra font monospace để có thể biểu diễn ascii art
echo "[DEBUG] Level: $level\n";
echo "[DEBUG] Username: $username\n";


// Tùy vào type mà ta sẽ in ra ASCII art khác nhau. tuyệt vời

switch($type){
    case 'eyes':
        $cowsay = <<<EOF
        echo 'Hello $username' | cowsay -f eyes -n 
        EOF;
        break;
    case 'turtle':
        $cowsay = <<<EOF
        echo 'Hello $username' | cowsay -f turtle -n 
        EOF;
        break;
    case 'dragon':
        $cowsay = <<<EOF
        echo 'Hello $username' | cowsay -f dragon -n 
        EOF;
        break;   
    case 'figlet':
        $cowsay = <<<EOF
        echo 'Hello $username' | cowsay -n ; figlet "Hello $username"
        EOF;
        break;
    case 'toilet':
        $cowsay = <<<EOF
        echo 'Hello $username' | cowsay -n ; toilet 'Hello $username'
        EOF;
        break;  
    case 'inception':
        $cowsay = <<<EOF
        echo 'Hello $username' | cowsay -n | cowthink -n
        EOF;
        break; 
    case 'tenet':
        $cowsay = <<<EOF
        echo 'Hello $username' | cowsay -n | cowthink -n | cowsay -n 
        EOF;
        break;              
    case 'random':
    default:
        $cowsay = <<<EOF
        fortune | cowsay -n | cowthink -n
        EOF;
}
echo "[DEBUG] Command: $cowsay\n\n\n";

passthru($cowsay);
echo "</pre>";

?>
    </div>
</body>

</html>