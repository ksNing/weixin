<?php
namespace app\index\controller;
use think\Controller;
class Register extends Controller{
  public function register(){
    return $this->fetch();
  }
  //处理注册逻辑
  public function doRegister(){
    //接收前端表单提交的数据 
    $param=input('post.');
    $uname=$param['uname'];
    $upwd=$param['upwd'];
    
    //进行规则验证 
    $has = db('users')->where('user_name',$param['uname'])->find();
    if($has){
      $this->redirect('login/index','',3,'该用户已经注册，请直接登录');
    }
    //注册
    $data=array();
    $data['user_name']=$uname;
    $data['user_pwd']=md5($upwd);
    
    $insert=db('users')->insert($data);
    if($insert){
      session_start();
      $_SESSION['uname']=$uname;
      $_SESSION['upwd']=$upwd;
      $this->redirect('login/index','',2,'注册成功!');
    }
    else{
      echo "<script>alert('注册失败!');</script>";
    }
  }
}  
   
    
    

    