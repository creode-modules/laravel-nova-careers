<?php

namespace Creode\LaravelNovaCareers\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Http\Requests\NovaRequest;

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

            \Laravel\Nova\Fields\DateTime::make('Published At')
                ->fillUsing(function ($request, $model, $attribute, $requestAttribute) {
                    // No value, don't format it.
                    if (empty($request->input($requestAttribute))) {
                        $model->{$attribute} = null;
                        return;
                    }

                    // Format the value into a timestamp.
                    $model->{$attribute} = (new \DateTime($request->input($requestAttribute)))->format('Y-m-d H:i:s');
                })
                ->sortable()
                ->help(__('Any date in the future will not be published until that date. Any date in the past will be published immediately. If left blank, the job will be unpublished.')),

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
                ->options([
                    'Full Time' => 'Full Time',
                    'Part Time' => 'Part Time',
                    'Contract' => 'Contract',
                    'Freelance' => 'Freelance',
                    'Internship' => 'Internship',
                    'Temporary' => 'Temporary',
                ])
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
            \Laravel\Nova\Fields\Textarea::make('Description')
                ->rules('required'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function label()
    {
        return 'Careers';
    }
}
