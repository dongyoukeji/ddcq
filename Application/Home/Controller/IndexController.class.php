<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index() {
        //$this->get_redwine_list=$this->get_redwine_list();
        $this->display();
    }
    /**
     * [get_article_list 获取推荐公告]
     * @param  integer $cid [栏目id]
     * @param  integer $s   [读取条数]
     * @return [json]       [description]
     */
    public function get_article_list($cid=3,$s=5){
        if(!$cid){
            $this->ajaxReturn(array('msg'=>0,'msg'=>'栏目ID不能为空'));
        }
        $cols = M('column')->where('status=0')->select();
        $child = \Tool\Category::getChildrenForIds($cols,$cid);
        $child.=",".$cid;

        $map['status']=0;
        $map['column_id']=array('in',$child);
        $list = M('article')->field('id,title,date')->where($map)->limit($s)->select();
        foreach ($list as $k => $v) {
            $v['date']=date('Y-m-d',$v['date']);
            $list1[] = $v;
        }
        $this->list = $list1;
        $list = $this->fetch('gonggao_list');

        $this->ajaxReturn(array('status'=>1,'list'=>$list));
    }
    /**
     * [get_detals 获取公告详情]
     * @param  integer $id [公告id]
     * @return [type]      [description]
     */
    public function notice($id=0){
        if($id==0){
            $this->ajaxReturn(array('status'=>0,'msg'=>'文章id不能为空'));
        }

        $article = M('article')->field('id,column_id,title,author,keywords,description,image,content,hits,date')->find($id);
        $cols = M('column')->field('id,title')->where('status=0')->find($article['column_id']);
        $article['column_title']=$cols['title'];

        if(empty($article)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'输入的id有误'));
        }
        $article['content']= htmlspecialchars_decode($article['content']);
        ksort($article);
        M('article')->execute('update think_article set hits=hits+1');
        $this-> vo = $article;
        $this->display();
    }

    public function notice_list(){
        $map['column_id']=3;
        $map['status']=0;
        $this->list = $this->getlist(M('article'),$map);
        $this->display();
    }

}