<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Test Intern PHP </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
</head>

<body>
    <section class="contact-section" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="titie-section wow fadeInDown animated ">
                        <h1>Thông tin</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 wow fadeInDown animated">
                    <form action="{{route('sendContact')}}" method="POST" class="contact-form" id="createForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="full_name" id="nameContact"
                                        placeholder="Họ tên" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="email" class="form-control" name="email" id="emailContact"
                                        placeholder="Email" maxlength="255" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="phone" class="form-control" name="phone" id="phoneContact"
                                        placeholder="Số điện thoại" minlength="10" maxlength="10" pattern="^[0-9]*$"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="address" id="addressContact"
                                        placeholder="Địa chỉ" maxlength="255" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <textarea name="introduce_yourself" id="introduceYourselfContact"
                                        class="form-control" cols="30" rows="5" maxlength="1000"
                                        placeholder="Giới thiệu bản thân" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="button" id="submitBtn" class="contact-submit" value="Gửi thông tin" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('submitBtn').addEventListener('click', function () {
            if(validateForm())
            {
                var form = document.getElementById('createForm');
                var formData = new FormData(form);
                $.ajax({
                    type: form.method,
                    url: form.action,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.success) {
                            alertify.success('Đã lưu thông tin thành công!');
                            $('#nameContact').val('');
                            $('#emailContact').val('');
                            $('#phoneContact').val('');
                            $('#addressContact').val('');
                            $('#introduceYourselfContact').val('');
                        } else {
                            alertify.error('Đã xảy ra lỗi: ' + response.errors);
                        }
                    },
                    error: function (error) {
                        alertify.error('Xảy ra lỗi!!!');
                        console.error(error);
                    }
                });
            }
        });
    </script>
    <script>
        function validateForm() {
            var name = $('#nameContact').val();
            var email = $('#emailContact').val();
            var phone = $('#phoneContact').val();
            var address = $('#addressContact').val();
            var introduceYourself = $('#introduceYourselfContact').val();
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!name || !email || !phone || !address || !introduceYourself) {
                alertify.error('Vui lòng nhập đầy đủ thông tin.');
                return false;
            }
            if(!(/^[0-9]*$/.test(phone)) || !(phone.length === 10)){
                alertify.error('Vui lòng nhập đúng số điện thoại.');
                return false;
            }
            if(!emailRegex.test(email)){
                alertify.error('Vui lòng nhập đúng địa chỉ email.');
                return false;
            }
            return true;
        }
    </script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{asset('assets/frontend/js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/wow.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/custom.js')}}"></script>
</body>

</html>
