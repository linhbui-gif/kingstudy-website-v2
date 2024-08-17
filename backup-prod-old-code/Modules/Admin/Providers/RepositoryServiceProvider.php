<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $models = [
            'Banner',
            'BannerPosition',
            'News',
			'Room',
            'Level',
            'Majors',
            'Country',
            'Ranking',
            'School',
            'Students',
            'CategoryQuestion',
            'Question',
            'Teachers',
            'Setting',
            'Course',
            'CategoryCourse',
            'Chapter',
            'Lesson',
            'Contacts',
            'Vimeos',
            'StudyAbroad',
            'Widget',
            'City'
        ];

        foreach ($models as $model) {
            $this->app->bind(
                "Modules\\Admin\\Repositories\\{$model}\\{$model}RepositoryInterface",
                "Modules\\Admin\\Repositories\\{$model}\\{$model}Repository"
            );
        }
    }
}
