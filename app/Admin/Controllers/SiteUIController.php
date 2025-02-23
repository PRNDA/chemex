<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\SiteUIForm;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Tab;
use Illuminate\Routing\Controller;

class SiteUIController extends Controller
{
    public function index(Content $content): Content
    {
        return $content
            ->title($this->title())
            ->description(admin_trans_label('description'))
            ->body(function (Row $row) {
                $tab = new Tab();
                $tab->addLink(trans('main.site_setting'), admin_route('site.setting.index'));
                $tab->add(trans('main.site_ui'), new SiteUIForm(), true);
                $tab->addLink(trans('main.site_ldap'), admin_route('site.ldap.index'));
                $row->column(12, $tab->withCard());
            });
    }

    public function title()
    {
        return admin_trans_label('title');
    }
}
