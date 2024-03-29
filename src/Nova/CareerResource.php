<?php

namespace Creode\LaravelNovaCareers\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\FormData;
use Creode\NovaPublishable\Published;
use Laravel\Nova\Http\Requests\NovaRequest;
use Creode\NovaPublishable\Nova\PublishAction;
use Creode\NovaPublishable\Nova\UnpublishAction;

class CareerResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Creode\LaravelCareers\Models\Career::class;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
        'location',
        'salary',
        'meta_description',
        'type',
    ];

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * {@inheritdoc}
     */
    public function fields(NovaRequest $request)
    {
        return [
            \Laravel\Nova\Fields\ID::make(),

            \Laravel\Nova\Fields\Text::make('Title')
                ->sortable()
                ->rules('required', 'max:255'),

            Published::make('Published', 'published_at')
                ->help(__('Should this career be visible on the website?')),

            new \Laravel\Nova\Panel('SEO', $this->seoFields()),

            new \Laravel\Nova\Panel('Job Metafields', $this->jobMetaFields()),

            new \Laravel\Nova\Panel('Job Description', $this->jobDescriptionFields()),
        ];
    }

    /**
     * SEO fields.
     *
     * @return array|null
     */
    protected function seoFields(): ?array
    {
        return [
            \Laravel\Nova\Fields\Slug::make('Slug')
                ->sortable()
                ->rules('required', 'max:255')
                ->from('Title')
                ->help(__('The slug is used to generate the URL for this job.')),

            \Laravel\Nova\Fields\Text::make('Meta Description')
                ->hideFromIndex()
                ->rules('required', 'max:160')
                ->help(__('The meta description is used to generate the meta description for this job.')),
        ];
    }

    /**
     * Job Meta fields.
     *
     * @return array|null
     */
    protected function jobMetaFields(): ?array
    {
        return [
            \Laravel\Nova\Fields\Text::make('Location')
                ->sortable()
                ->rules('required', 'max:255')
                ->help(__('The location is used to display the location of the job.')),

            \Laravel\Nova\Fields\Text::make('Salary')
                ->sortable()
                ->rules('max:255')
                ->help(__('The salary is used to display the salary of the job.')),

            \Laravel\Nova\Fields\Select::make('Type')
                ->options(config('nova-careers.job_types'))
                ->rules('required', 'max:255')
                ->help(__('The type is used to display the type of the job.')),

            \Laravel\Nova\Fields\Text::make('Duration')
                ->hide()
                ->dependsOn('type', function (Text $field, NovaRequest $request, FormData $formData) {
                    // dd($formData->type);
                    if ($formData->type === 'Temporary') {
                        $field->show()->rules(['max:255']);
                    }
                })
                ->rules('max:255')
                ->help(__('The duration is used to display the duration of the job.')),

            \Laravel\Nova\Fields\Text::make('Application Email')
                ->rules('max:255')
                ->default(config('nova-careers.email'))
                ->help(__('The application email is used to display the application email of the job.')),
        ];
    }

    /**
     * List of job description fields.
     *
     * @return array|null
     */
    protected function jobDescriptionFields(): ?array
    {
        return [
            \Creode\NovaPageBuilder\Nova\Fields\PageBuilder::make('Description')
                ->rules('required')
                ->exclude(config('nova-careers.excluded_blocks')),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function label()
    {
        return 'Careers';
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            (new PublishAction)
                ->confirmText('Are you sure you want to publish these items?')
                ->confirmButtonText('Publish')
                ->cancelButtonText("Don't Publish"),

            (new UnpublishAction)
                ->confirmText('Are you sure you want to unpublish these items?')
                ->confirmButtonText('Unpublish')
                ->cancelButtonText("Don't Unpublish")
        ];
    }
}
