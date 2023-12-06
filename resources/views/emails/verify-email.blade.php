<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
</head>
<body>
    <div style="
            height: auto !important;
            max-width: 600px !important;
            font-family: Helvetica, Arial, sans-serif !important;
            margin-bottom: 40px;
            margin-left: auto;
            margin-right: auto;
          ">
    <div style="margin-bottom: 100px">
        <div style="
                border-top-left-radius: 30px;
                border-top-right-radius: 30px;
                background-image: linear-gradient(#c07f00,#fefff4);
                display: flex;
                justify-content: center;
                color: blue;
                text-shadow: 2px 3px 4px #ffffff;
                font-size: 1.1rem;
                text-align: center;
        ">
        </div>
        <table style="
                max-width: 600px;
                background-color: #fdffdefd;
                border: 2px;
                border-collapse: separate !important;
                border-bottom-left-radius: 30px;
                border-bottom-right-radius: 30px;
                border-spacing: 0;
                color: #4e4e4e;
                margin: 0;
                padding: 32px;
                padding-top: 1rem;
                font-size: 14px;
                font-weight: 400;
                line-height: 1.5;
                box-shadow: 0px 10px 30px rgba(239, 231, 143, 0.715) !important;
              ">
            <tbody>
                <tr>
                    <td>
                        <img src="https://yu.ctu.edu.vn/images/upload/article/2020/03/0305-logo-ctu.png" alt="logo" style="width: 200px; margin-bottom: 15px; clear: both; display: inline-block; margin-left: 31%;" />
                        <br />
                        <h6 style="width: 536px; display: inline-block; font-size: 20px; margin: 10px 0; font-weight: 500; text-align: center;">
                            <b>Thông tin đăng ký gói</b>
                        </h6>
                        <div>
                            <p style=" display: inline-block; font-size: 15px; margin: 10px 0; font-weight: 500; ">
                                Xin chào bạn,
                            </p>
                            <p>Cổng thông tin tuyển dụng Trường Công nghệ thông tin và Truyền thông cảm ơn bạn đã sử dụng gói đăng ký tài khoản với tư cách nhà tuyển dụng của Trường. Chúng tôi thông báo đến bạn thông tin về gói đăng ký bạn đã thực hiện thanh toán:</p>

                            <h1>{{$checkout['checkout_status']}}</h1>

                            @if ($checkout['checkout_type'] != '')
                            <p>{!! $checkout['checkout_type'] !!}</p>
                            <p>Thời gian bắt đầu sử dụng gói: <?php echo date('d/m/Y H:i:s', strtotime($checkout['checkout_date'])); ?></p>
                            <p>Thời gian hết hạn sử dụng gói: <?php echo date('d/m/Y H:i:s', strtotime($checkout['checkout_expired_time'])); ?></p>

                            @endif
                            <p>Đăng nhập vào hệ thống quản trị của nhà tuyển dụng: <a href="http://127.0.0.1:8000/admin/login" class="text-decoration-none">Tại đây</a></p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
