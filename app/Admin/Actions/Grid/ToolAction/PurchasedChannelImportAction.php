<?php

namespace App\Admin\Actions\Grid\ToolAction;

use App\Admin\Forms\PurchasedChannelImportForm;
use Dcat\Admin\Grid\Tools\AbstractTool;
use Dcat\Admin\Widgets\Modal;

class PurchasedChannelImportAction extends AbstractTool
{
    public function __construct()
    {
        parent::__construct();
        $this->title = admin_trans_label('Import');
    }

    /**
     * 渲染模态框.
     *
     * @return Modal|string
     */
    public function render()
    {
        return Modal::make()
            ->lg()
            ->body(new PurchasedChannelImportForm())
            ->button("<a class='btn btn-success' style='color: white;'><i class='feather icon-package'></i>&nbsp;$this->title</a>");
    }
}
