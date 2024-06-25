<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

function addLargeIntegers($a, $b) {
    // Chuyển đổi các số thành chuỗi để xử lý từng chữ số
    $aStr = strval($a);
    $bStr = strval($b);

    // Đảm bảo rằng $aStr luôn là chuỗi dài hơn hoặc bằng $bStr
    if (strlen($aStr) < strlen($bStr)) {
        $temp = $aStr;
        $aStr = $bStr;
        $bStr = $temp;
    }

    // Khởi tạo các biến
    $result = '';
    $carry = 0;
    $aLen = strlen($aStr);
    $bLen = strlen($bStr);

    // Bắt đầu từ chữ số cuối cùng và di chuyển ngược lên đầu chuỗi
    for ($i = 0; $i < $aLen; $i++) {
        $aDigit = intval($aStr[$aLen - 1 - $i]);
        $bDigit = $i < $bLen ? intval($bStr[$bLen - 1 - $i]) : 0;
//intval($bStr[$bLen - 1 - $i]) lấy chữ số từ phải sang trái của chuỗi $bStr nếu $i nhỏ hơn $bLen.
//Nếu $i lớn hơn hoặc bằng $bLen, nghĩa là chúng ta đã hết các chữ số của $bStr, chúng ta sử dụng 0 như một giá trị mặc định.

// intval($aStr[$aLen - 1 - $i]) lấy chữ số từ phải sang trái của chuỗi $aStr.
// $aLen - 1 - $i đảm bảo rằng chúng ta bắt đầu từ chữ số cuối cùng và di chuyển ngược lại về đầu chuỗi.

        // Tính tổng của hai chữ số và carry
        $sum = $aDigit + $bDigit + $carry;

        // Lưu chữ số cuối của tổng vào kết quả
        $result = ($sum % 10) . $result;

        // Cập nhật carry
        $carry = intdiv($sum, 10);
    }

    // Nếu còn carry, thêm nó vào đầu kết quả
    if ($carry > 0) {
        $result = $carry . $result;
    }

    return $result;
}

// Hàm để kiểm tra và debug
function testAddLargeIntegers() {
    $tests = [
        ['a' => '999999999999999', 'b' => '999999999999999', 'expected' => '1999999999999998'],
        ['a' => '123456789', 'b' => '987654321', 'expected' => '1111111110'],
        ['a' => '0', 'b' => '0', 'expected' => '0'],
        ['a' => '1', 'b' => '999999999999999', 'expected' => '1000000000000000'],
        ['a' => '999999999999999999999999999999', 'b' => '1', 'expected' => '1000000000000000000000000000000'],
        ['a' => '123', 'b' => '4567', 'expected' => '4690']
    ];

    foreach ($tests as $test) {
        $result = addLargeIntegers($test['a'], $test['b']);
        if ($result === $test['expected']) {
            echo "Test passed for adding {$test['a']} and {$test['b']}. Result: $result<br>";
        } else {
            echo "Test FAILED for adding {$test['a']} and {$test['b']}. Expected: {$test['expected']}, got: $result<br>";
        }
    }
}

// Chạy kiểm tra
testAddLargeIntegers();

?>





</body>
</html>