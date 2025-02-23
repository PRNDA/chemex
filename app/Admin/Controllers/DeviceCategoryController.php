<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Tree\ToolAction\DeviceCategoryImportAction;
use App\Admin\Repositories\DeviceCategory;
use App\Models\DepreciationRule;
use App\Support\Data;
use App\Support\Support;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Tree;
use Dcat\Admin\Widgets\Tab;
use Illuminate\Http\Request;

class DeviceCategoryController extends AdminController
{
    public function index(Content $content): Content
    {
        return $content
            ->title($this->title())
            ->description(admin_trans_label('description'))
            ->body(function (Row $row) {
                $tab = new Tab();
                $tab->addLink(Data::icon('record') . trans('main.record'), admin_route('device.records.index'));
                $tab->add(Data::icon('category') . trans('main.category'), $this->treeView(), true);
                $tab->addLink(Data::icon('track') . trans('main.track'), admin_route('device.tracks.index'));
                $tab->addLink(Data::icon('statistics') . trans('main.statistics'), admin_route('device.statistics'));
                $tab->addLink(Data::icon('column') . trans('main.column'), admin_route('device.columns.index'));
                $row->column(12, $tab);
            });
    }

    public function title()
    {
        return admin_trans_label('title');
    }

    /**
     * 模型树构建.
     *
     * @return Tree
     */
    protected function treeView(): Tree
    {
        return new Tree(new \App\Models\DeviceCategory(), function (Tree $tree) {
            $tree->disableCreateButton();

            /**
             * 工具按钮.
             */
            $tree->tools(function (Tree\Tools $tools) {
                // @permissions
                if (Admin::user()->can('device.category.import')) {
                    $tools->add(new DeviceCategoryImportAction());
                }
            });

            /**
             * 按钮控制.
             */
            // @permissions
            if (!Admin::user()->can('device.category.create')) {
                $tree->disableQuickCreateButton();
            }
            // @permissions
            if (!Admin::user()->can('device.category.update')) {
                $tree->disableEditButton();
                $tree->disableQuickEditButton();
            }
            // @permissions
            if (!Admin::user()->can('device.category.delete')) {
                $tree->disableDeleteButton();
            }
            $tree->disableCreateButton();
        });
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function selectList(Request $request)
    {
        $q = $request->get('q');

        return \App\Models\DeviceCategory::where('name', 'like', "%$q%")
            ->paginate(null, ['id', 'name as text']);
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        return Form::make(new DeviceCategory(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->text('description');

            if (Support::ifSelectCreate()) {
                $form->selectCreate('parent_id')
                    ->options(\App\Models\DeviceCategory::class)
                    ->ajax(admin_route('selection.device.categories'))
                    ->url(admin_route('device.categories.create'));
                $form->selectCreate('depreciation_rule_id')
                    ->options(DepreciationRule::class)
                    ->ajax(admin_route('selection.depreciation.rules'))
                    ->url(admin_route('depreciation.rules.create'));
            } else {
                $form->select('parent_id')
                    ->options(\App\Models\DeviceCategory::pluck('name', 'id'));
                $form->select('depreciation_rule_id')
                    ->options(DepreciationRule::pluck('name', 'id'));
            }

            $form->display('created_at');
            $form->display('updated_at');

            /**
             * 按钮控制.
             */
            $form->disableCreatingCheck();
            $form->disableEditingCheck();
            $form->disableViewCheck();
        });
    }
}
