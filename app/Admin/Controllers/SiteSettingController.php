<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\SiteSettingForm;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Tab;
use Illuminate\Routing\Controller;

class SiteSettingController extends Controller
{
    public function index(Content $content): Content
    {
        return $content
            ->title($this->title())
            ->description(admin_trans_label('description'))
            ->body(function (Row $row) {
                $tab = new Tab();
                $tab->add(trans('main.site_setting'), new SiteSettingForm(), true);
                $tab->addLink(trans('main.site_ui'), admin_route('site.ui.index'));
                $tab->addLink(trans('main.site_ldap'), admin_route('site.ldap.index'));
                $row->column(12, $tab->withCard());
            });
    }

    public function title()
    {
        return admin_trans_label('title');
    }
}
