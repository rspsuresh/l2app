<link href="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/dropzone/dropzone.css" rel="stylesheet">
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    LOCKER AUTHORIZATION
                </h2>
            </div>
            <div class="body">
                <form action="uploadcld" id="frmFileUpload" class="dropzone dz-clickable" method="post
                 enctype="multipart/form-data">
                    <div class="dz-message">
                        <div class="drag-icon-cph">
                            <i class="material-icons">touch_app</i>
                        </div>
                        <h3>Drop files here or click to upload.</h3>
                        <em>(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</em>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/dropzone/dropzone.js"></script>