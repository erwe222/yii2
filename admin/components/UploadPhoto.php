<?php
namespace admin\components;
use Yii;
class UploadPhoto {
    
    #管理员id
    private $admin_id;
    
    /**
     * 文件上传根路径
     * @var type 
     */
    private $dir_name = '/web/upload/PhotoAlbums/';

    private $user_dir_name = '';

    /**
     * 待上传文件
     * @var type 
     */
    private $array = [];
    
    private $success_file = [];


    /**
     * 允许上传文件的类型
     * @var type 
     */
    private $ext_arr = [
        'image' => ['gif', 'jpg', 'jpeg', 'png', 'bmp'],
        'flash' => ['swf', 'flv'],
        'media' => ['swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'],
        'file'  => ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'],
    ];
    
    /**
     * 上传状态码
     * @var type 
     */
    private $code = 200;
    
    /**
     * 错误提示信息
     * @var type 
     */
    private $message = '';

    public function __construct($admin_id,$array) {
        $this->admin_id = $admin_id;
        $this->array = $array;
        $this->dir_name = Yii::$app->basePath.$this->dir_name;
        $this->user_dir_name = 'Image-'.$admin_id.'-ADMIN';
        $this->save_dir = $this->dir_name.$this->user_dir_name;
    }
    
    /**
     * 文件上传验证
     */
    public function uploadVerify(){
        //检查目录
	if (@is_dir($this->dir_name) === false) {
            $this->setCode(404);
            $this->setMessage('上传目录不存在');
            return false;
	}

	//检查目录写权限
	if (@is_writable($this->dir_name) === false) {
            $this->setCode(403);
            $this->setMessage('上传目录没有写权限');
            return false;
	}
        
        if(count($this->array) > 0){
            foreach($this->array as $key=>$v){
                //检查是否已上传
                if (@is_uploaded_file($v['tmp_name']) === false) {
                    $this->setMessage("[{$v['name']}]文件上传失败");
                    return false;
                }

                //获得文件扩展名
                $file_ext = pathinfo($v['name'], PATHINFO_EXTENSION);

                $is_true = false;

                //检查扩展名
                foreach($this->ext_arr as $_val){
                    if(in_array($file_ext, $_val) === false){
                        $this->setMessage("上传文件扩展名是不允许的({$file_ext})扩展名。");
                    }else{
                        $is_true = true;
                        goto jumpForeach;
                    }
                }
                jumpForeach:

                if($is_true == false){
                    return false;
                }
                
                //新文件名
                $this->array[$key]['new_name'] = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
                $this->array[$key]['move_dir'] = $this->save_dir.'/'.$this->array[$key]['new_name'];
                $this->array[$key]['save_dir'] = '/upload/PhotoAlbums/'.$this->user_dir_name.'/'.$this->array[$key]['new_name'];
            }
        }

        return true;
    }

    /**
     * 文件上传操作
     */
    public function upload(){
        if(!$this->uploadVerify()){
            return false;
        }

        if(!file_exists($this->save_dir)){
            mkdir($this->save_dir, 0777);
            chmod($this->save_dir, 0777);     #修改linux下没有写入的权限
        }

        foreach ($this->array as $key => $value) {
            if (move_uploaded_file($value['tmp_name'], $value['move_dir']) === false) {
                $this->setMessage("上传文件失败。");
                return false;
            }
            
            $this->success_file[] = [
                'old_name'=>$this->array[$key]['name'],
                'new_name'=>$this->array[$key]['new_name'],
                'save_url'=>$this->array[$key]['save_dir'],
            ];
        }
        return true;
    }
    
    /**
     * 设置提示信息
     */
    public function setCode($code){
        $this->code = $code;
    }

    /**
     * 设置提示信息
     */
    public function setMessage($message){
        $this->message = $message;
    }
    
    public function getCode(){
        return $this->code;
    }

    /**
     * 获取上传错误信息
     */
    public function getErrorMsg(){
        return $this->message;
    }
    
    /**
     * 获取文件后缀名
     */
    public function getSuffixName($file_name){
        return pathinfo($file_name, PATHINFO_EXTENSION);
    }
    
    public function getSuccessFile(){
        return $this->success_file;
    }
}
