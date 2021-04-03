<link href="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<div class="container-fluid">
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                    Activity Log
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>S.no</th>
                                <th>App Name</th>
                                <th>Public Id</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>S.no</th>
                                <th>App Name</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php foreach ($AuthImgModel as $key=>$val) { ?>
                                <tr>
                                    <td><?=$key+1?></td>
                                    <td>L2App</td>
                                    <td><?=$val->auth_img?></td>
                                    <td>
                                        <button onclick="placesrc(this)" data-src="<?=$val->img_url?>" class="btn btn-primary" data-toggle="modal"
                                                data-target="#defaultModal">View</button>
                                        <button class="btn btn-danger" onclick="deleteclodinary('<?=$val->public_id?>')">Delete</button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Basic Examples -->
</div>
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Public Id :</h4>
            </div>
            <div class="modal-body">
              <img id="imgsrc" src="" alt="" width="100%" height="50%">
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

<script type="text/javascript">
    $(function () {
        $('.js-basic-example').DataTable({
            responsive: true
        });
    });
    function placesrc(a){
        $("#imgsrc").attr('src',$(a).attr('data-src'))
    }
    function deleteclodinary(ref){
        if(confirm('Are You Sure want to delete?')){
            $.ajax({
                url: '<?=Yii::$app->urlManager->createUrl('locker/clouddelete')?>?id='+ref,
                type: "get",
                success: function (result) {
                    var obj = JSON.parse(result);
                    if (obj.flag === "S") {
                        swal("Success", obj.msg, "success");
                    }else{
                        swal("Error", obj.msg, "Error");
                    }
                    window.location.reload();
                }
            });
        }
    }
</script>