<?php

namespace App\Admin\Controllers;

use App\Model\SkuModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SkuController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Model\SkuModel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SkuModel);

        $grid->column('id', __('Id'));
        $grid->column('goods_id', __('商品id'));
        $grid->column('goods_sn', __('sku编号'));
        $grid->column('self_price', __('本店价格'));
        $grid->column('market_price', __('市场价格'));
        $grid->column('goods_num', __('库存'));
        $grid->column('created_at', __('添加时间'));
        $grid->column('updated_at', __('修改时间'));
        $grid->column('color', __('颜色'));

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
        $show = new Show(SkuModel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('goods_id', __('Goods id'));
        $show->field('goods_sn', __('Goods sn'));
        $show->field('self_price', __('Self price'));
        $show->field('market_price', __('Market price'));
        $show->field('goods_num', __('Goods num'));
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
        $form = new Form(new SkuModel);

        $form->number('goods_id', __('Goods id'));
        $form->text('goods_sn', __('Goods sn'));
        $form->text('self_price', __('Self price'));
        $form->text('market_price', __('Market price'));
        $form->number('goods_num', __('Goods num'));

        return $form;
    }
}
