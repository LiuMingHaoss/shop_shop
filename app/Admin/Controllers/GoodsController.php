<?php

namespace App\Admin\Controllers;

use App\Model\GoodsModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Post\Replicate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class GoodsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Model\GoodsModel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GoodsModel);

        $grid->column('goods_id', __('Goods id'));
        $grid->column('goods_name', __('Goods name'));
        $grid->column('goods_desc', __('Goods desc'));
        $grid->column('is_up', __('Is up'));
        $grid->column('goods_img')->display(function($img){
            return '<img src=/storage/'.$img.' weith="40" height="40">';
        });

        $grid->column('status', __('Status'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->actions(function ($actions) {
            $actions->add(new Replicate);
        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(GoodsModel::findOrFail($id));
        $show->field('goods_id', __('Goods id'));
        $show->field('goods_name', __('Goods name'));
        $show->field('goods_desc', __('Goods desc'));
        $show->field('is_up', __('Is up'));
        $show->field('goods_img', __('Goods img'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new GoodsModel);
        $form->text('goods_name', __('Goods name'));
        $form->textarea('goods_desc', __('Goods desc'));
        $form->switch('is_up', __('Is up'));
        $form->file('goods_img', __('Goods img'));
        $form->number('status', __('Status'));

        return $form;
    }

    public function store()
    {
        $data=$_POST;
        unset($data['_previous_']);
        unset($data['_token']);
        if($data['is_up']=='on'){
            $data['is_up']=1;
        }else{
            $data['is_up']=2;
        }

        $goods_id=GoodsModel::insertGetId($data);
        $key="h:phpinfo:goods:".$goods_id;
        Redis::hMset($key,$data);

    }

    public function update($id)
    {
        $data=$_POST;
        unset($data['_method']);
        unset($data['_token']);
        unset($data['_previous_']);
        if($data['is_up']=='on'){
            $data['is_up']=1;
        }else{
            $data['is_up']=2;
        }
        $res=GoodsModel::where('goods_id',$id)->update($data);
        $key="h:phpinfo:goods:".$id;
        Redis::hMset($key,$data);

    }
}
