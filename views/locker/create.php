<title>User Create</title>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    User Creation
                </h2>
            </div>
            <div class="body">
                <form id="createUser" method="post" enctype="multipart/form-data">
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="firstname" name="firstname"
                                           class="form-control"
                                           placeholder="First Name">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text"
                                           id="lastname"
                                           name="lastname"
                                           class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text"
                                           id="username"
                                           name="username"
                                           class="form-control"
                                           placeholder="User Name">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="email" id="email" name="email"  class="form-control" placeholder="Email-id">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="password"
                                            name="password"
                                           class="form-control"
                                           placeholder="Password">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="confirmpassword"

                                           name="confirmpassword"
                                           class="form-control" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-6">
                        <select class="form-control" name="locker" id="licker">
                            <option value="">-- Please select --</option>
                            <option value="1">1</option>
                        </select>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="file" id="profile" name="profile" class="form-control">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="userid">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo Yii::$app->request->baseUrl; ?>/css/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript">
    $(function () {
        $("#createUser").on("submit", function (event) {
            event.preventDefault();
        }).validate({
            rules: {
                firstname: 'required',
                lastname: 'required',
                username: 'required',
                email: 'required',
                locker: 'required',
                password: "required",
                confirmpassword : {
                    minlength : 5,
                    equalTo : "#password"
                }
            },
            messages: {
                firstname: 'First Name Cannot be blank',
                lastname: 'Last Name Cannot be blank',
                username: 'UserName Cannot be blank',
                email: 'Email Cannot be blank',
                password: 'Password Cannot be blank',
                locker: 'locker Cannot be blank',
            },
            submitHandler: function (form, event) {
                event.preventDefault();
                var formData = new FormData($('#createUser')[0]);
                var url='<?=Yii::$app->urlManager->createUrl(['locker/create'])?>'
                $.ajax({
                    url: url,
                    type: "post",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (result) {
                        var obj = JSON.parse(result);
                        if (obj.flag === "S") {
                            swal("Success", obj.msg, "success");
                            <?php if($_SESSION['usertype'] =='A') { ?>
                            window.location.href="<?=Yii::$app->urlManager->createUrl(['locker/lockerusers?flag='])?>"+obj.flag;
                            <?php } else { ?>
                            window.location.href="<?=Yii::$app->urlManager->createUrl(['locker/index?flag='])?>"+obj.flag;
                            <?php } ?>
                        }else{
                            swal("Error", obj.msg, "error");
                            $("#createUser")[0].reset();
                        }
                    }
                });
                return false;
            }
        });
    });
</script>