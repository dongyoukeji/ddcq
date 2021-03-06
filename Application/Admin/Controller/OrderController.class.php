<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 订单管理
 */
class OrderController extends BaseController {
  	/**
	 * [index 首页]
	 * @return [type] [description]
	 */
    public function index(){
		//$this->kefu=C('Kefu');
		$map=$this->_search();
		$this->list = $this->getlist(M('Order'),$map,'id asc');
    	$this->display();
    }
	public function add($id=0){
		if($id){
			$this->kefu=$kefu = M('Order')->find($id);
		}
		$this->display();
	}

	public function see($id=0){
		if($id){
			$this->kefu=$kefu = M('Order')->find($id);
		}
		$this->display();
	}
	public function addhd(){
		if(!IS_POST){
			$this->ajaxReturn(array('status'=>0,'msg'=>'错误的请求'));
		}
		$data = $_POST;
		$data['time']=time();

		if(empty($data['id'])){
			if(!M('Order')->add($data)){
				$this->ajaxReturn(array('status'=>0,'msg'=>'操作失败请稍后重试'));
			}
		}else{
			if(!M('Order')->save($data)){
				$this->ajaxReturn(array('status'=>0,'msg'=>'操作失败请稍后重试'));
			}
		}
		$this->ajaxReturn(array('status'=>1,'msg'=>'操作成功','redirect'=>U('index')));
	}

	public function del($id=0){
		if(!$id){
			$this->ajaxReturn(array('status'=>0,'msg'=>'参数错误'));
		}
		if(!M('Order')->delete($id)){
			$this->ajaxReturn(array('status'=>0,'msg'=>'操作失败请稍后重试'));
		}
		$this->ajaxReturn(array('status'=>1,'msg'=>'操作成功','redirect'=>U('index')));
	}

	public function status($id=0,$t=0){
		if(!$id){
			$this->error('参数错误');
		}
		if(!M('Order')->save(array('id'=>$id,'status'=>$t))){
			$this->error('操作失败');
		}
		$this->redirect('index');
	}

	protected function _search() {
		$map = array();
		//控制器名称
		($title = I('get.coupons_title','', 'trim')) && $map['username'] = array('like', '%' . $title . '%');
		//状态（正常，禁用）
		if ($_GET['coupons_type'] == null) {
			$status = -1;
		} else {
			$status = intval($_GET['coupons_type']);
		}
		$status >= 0 && $map['ordstatus'] = array('eq', $status);
		//输出
		$this->assign('search', array(
			'title' => $title,
			'status' => $status,
		));
		return $map;
	}
}