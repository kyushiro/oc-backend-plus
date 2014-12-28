<?php namespace Indikator\Backend;

use System\Classes\PluginBase;
use Event;
use Backend;
use BackendMenu;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'indikator.backend::lang.plugin.name',
            'description' => 'indikator.backend::lang.plugin.description',
            'author'      => 'indikator.backend::lang.plugin.author',
            'homepage'    => 'https://github.com/gergo85/oc-backend-plus'
        ];
    }

    public function registerReportWidgets()
    {
        return [
            'Indikator\Backend\ReportWidgets\Status' => [
                'label'   => 'indikator.backend::lang.widgets.system.label',
                'context' => 'dashboard'
            ],
            'Indikator\Backend\ReportWidgets\Version' => [
                'label'   => 'indikator.backend::lang.widgets.version.label',
                'context' => 'dashboard'
            ],
            'Indikator\Backend\ReportWidgets\Logs' => [
                'label'   => 'indikator.backend::lang.widgets.logs.label',
                'context' => 'dashboard'
            ],
            'Indikator\Backend\ReportWidgets\Admins' => [
                'label'   => 'indikator.backend::lang.widgets.admins.label',
                'context' => 'dashboard'
            ],
            'Indikator\Backend\ReportWidgets\Server' => [
                'label'   => 'indikator.backend::lang.widgets.server.label',
                'context' => 'dashboard'
            ],
            'Indikator\Backend\ReportWidgets\Php' => [
                'label'   => 'indikator.backend::lang.widgets.php.label',
                'context' => 'dashboard'
            ]
        ];
    }

    public function boot()
    {
        Event::listen('backend.form.extendFields', function($form)
        {
            if ($form->model instanceof Backend\Models\BackendPreferences)
            {
                $form->addFields([
                    'sidebar_description' => [
                        'label'   => 'indikator.backend::lang.settings.sidebar_description',
                        'type'    => 'switch',
                        'span'    => 'left',
                        'default' => 'false',
                        'comment' => 'indikator.backend::lang.settings.comment'
                    ]
                ]);
                $form->addFields([
                    'focus_searchfield' => [
                        'label'   => 'indikator.backend::lang.settings.focus_searchfield',
                        'type'    => 'switch',
                        'span'    => 'left',
                        'default' => 'false',
                        'comment' => 'indikator.backend::lang.settings.comment'
                    ]
                ]);
            }
        });

        BackendMenu::registerContextSidenavPartial(
            'October.System',
            'system',
            '@/plugins/indikator/backend/partials/_system_sidebar.htm'
        );
    }
}
