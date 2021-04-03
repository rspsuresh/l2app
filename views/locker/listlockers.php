<link href="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<div class="container-fluid">
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
Locker Users
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Customer Id</th>
                                <th>Locker Unlock/lock</th>
                                <th>Change Status</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Customer Id</th>
                                <th>Locker Unlock/lock</th>
                                <th>Change Status</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php foreach ($usermodel as $key=>$val) { ?>
                                <tr>
                                    <td><?=$val['first_name']." ".$val['last_name']?></td>
                                    <td><?=$val['email_id']?></td>
                                    <td><?=$val['customer_id']?></td>
                                    <td>
                                        <?php
                                          $LoclerMdl=\app\models\LockerTracker::find()->where('created_by=:by and locker_id=:locker',
                                              [':by'=>$val['id'],':locker'=>$val['locker_id']])->one();

                                        ?>
                                        <?php if(empty($LoclerMdl) || $LoclerMdl->locker_status=='OFF') { ?>
                                            <button type="button"
                                                    onclick="locktrack('<?=base64_encode($val['id'])?>',
                                                            '<?=base64_encode($val['locker_id'])?>','ON',
                                                            '<?=$val['locker_channel_api']?>')"
                                                    data-color="cyan" class="btn bg-cyan waves-effect">Unlock</button>
                                            <button type="button" disabled
                                                    data-color="red" class="btn bg-red waves-effect">Lock</button>
                                        <?php } else { ?>
                                            <button type="button" disabled
                                                    data-color="cyan" class="btn bg-cyan waves-effect">Unlock</button>
                                            <button type="button"
                                                    onclick="locktrack('<?=base64_encode($val['id'])?>',
                                                            '<?=base64_encode($val['locker_id'])?>','OFF',
                                                            '<?=$val['locker_channel_api']?>')"
                                                    data-color="red" class="btn bg-red waves-effect">Lock</button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div class="demo-switch">
                                            <div class="switch">
                                                <label>OFF<input type="checkbox"
                                                        <?=$val['user_status']=="A"?'checked':''?>
                                                                 onchange="statuschange('<?=base64_encode($val['id'])?>',event)">
                                                    <span class="lever"></span>
                                                    ON</label>
                                            </div>
                                        </div>
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

<script src="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
    $(function () {
        $('.js-basic-example').DataTable({
            responsive: true
        });
    });
    function statuschange(id,event){
        $.ajax({
            type: 'GET',
            url: '<?=Yii::$app->urlManager->createUrl('locker/changestatus')?>?id='+id,
            success:function(data){
                var obj = JSON.parse(data);
                if (obj.flag === "S") {
                    swal("Success", obj.msg, "success");
                }else{
                    swal("Error", obj.msg, "Error");
                }
            }
        });
    }
    function locktrack(user,locker,status,channel){
        $.ajax({
            type: 'GET',
            url: '<?=Yii::$app->urlManager->createUrl('locker/lockertracker')?>?user='+user+'&locker='+locker,
            success:function(data) {
                var obj = JSON.parse(data);
                if (obj.flag === "S") {
                    swal("Success", obj.msg, "success");
                } else {
                    swal("Error", obj.msg, "Error");
                }

                let extraquestr=status =="ON"?'field2=1':'field2=0'
                let url =`https://api.thingspeak.com/update?api_key=${channel}&${extraquestr}`;
                var myWindow =window.open(url, "myWindow", "width=200,height=100");
                myWindow.close();
                location.reload();
            }
            })
    }
</script>