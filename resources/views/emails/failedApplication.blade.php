<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Results</title>
</head>
<body>
    <p><strong>Xin chào {{ $body['candidate_name'] }}</strong>, <br>Cổng thông tin tuyển dụng Trường Công nghệ thông tin và Truyền thông chuyển thông báo từ phía nhà tuyển dụng <strong>{{$body['recruiter']['name']}}</strong> đến bạn về thông tin ứng tuyển của bạn đối với tin tuyển <strong>{{$body['post']['post_title']}}</strong>, như sau:</p>
    
    <div style="display: flex !important; align-items: center !important;">
        <p>Kết quả ứng tuyển: </p>&nbsp;<h4 class="text-success">{{$body['status']}}</h4>
    </div>

    <p>{!! $body['message'] !!}</p>

    <p>Cổng thông tin tuyển dụng Trường Công nghệ thông tin và Truyền thông và phía nhà tuyển dụng <strong>{{$body['recruiter']['name']}}</strong> chúc bạn sớm tìm được công việc phù hợp hơn.</p>
    <p>Chúc bạn thành công!</p>

    <p>Thân chuyển</p>
</body>
</html>