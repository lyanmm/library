<?php
function form()
{
    $id = $_COOKIE["id"];
    $userName = $_COOKIE["userName"];
    $password = $_COOKIE["password"];
    $email = $_COOKIE["email"];
    print <<<EOT
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">修改信息</h4>
                        </div>
                        <form action="editPersonalInfo.php" method="post">
                            <div class="modal-body container-fluid">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label for="userName" class="control-label col-sm-2 col-sm-offset-1">用户名</label>
                                        <div class="col-sm-7">
                                           <input id="userName" name="userName" type="text" class="form-control" value='$userName'>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="control-label col-sm-2 col-sm-offset-1">密码</label>
                                        <div class="col-sm-7">
                                            <input id="password" name="password" type="text" class="form-control" value='$password'>
                                           

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="control-label col-sm-2 col-sm-offset-1">邮箱</label>
                                        <div class="col-sm-7">
                                            <input id="email" name="email" type="email" class="form-control"  value='$email'>
                                        </div>
                                    </div>
                                
                                       
                                            <input id="id" name="id" class="form-control  sr-only"  value='$id'>
                               
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                <button type="submit" class="btn btn-primary">提交修改</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

EOT;
}