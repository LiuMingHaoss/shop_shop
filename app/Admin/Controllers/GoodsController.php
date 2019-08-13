<?php

namespace App\Admin\Controllers;

use App\Model\GoodsModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Post\Replicate;
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
        $grid->column('self_price', __('Self price'));
        $grid->column('market_price', __('Market price'));
        $grid->column('goods_num', __('Goods num'));

        $grid->column('is_up', __('Is up'));
        $grid->column('goods_img')->display(function($img){
            return '<img src="/goodsImg/'.$img.'" width="40" height="40">';
        });

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
        $show->field('self_price', __('Self price'));
        $show->field('market_price', __('Market price'));
        $show->field('goods_num', __('Goods num'));
        $show->field('goods_desc', __('Goods desc'));
        $show->field('is_up', __('Is up'));
        $show->field('goods_img', __('Goods img'));
        $show->field('create_time', __('Create time'));
        $show->field('status', __('Status'));

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

        $form->number('goods_id', __('Goods id'));
        $form->text('goods_name', __('Goods name'));
        $form->decimal('self_price', __('Self price'));
        $form->decimal('market_price', __('Market price'));
        $form->number('goods_num', __('Goods num'));
        $form->textarea('goods_desc', __('Goods desc'));
        $form->switch('is_up', __('Is up'));
        $form->text('goods_img', __('Goods img'));
        $form->number('create_time', __('Create time'));
        $form->number('status', __('Status'));

        return $form;
    }
}
