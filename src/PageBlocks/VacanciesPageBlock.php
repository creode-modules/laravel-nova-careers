<?php

namespace Creode\LaravelNovaCareers\PageBlocks;

use Laravel\Nova\Fields\Number;
use Creode\NovaPageBuilder\Abstracts\PageBlockAbstract;
use Creode\LaravelCareers\Repositories\CareerRepository;

class VacanciesPageBlock extends PageBlockAbstract
{
    protected $label = 'Vacancies';
    protected $name = 'vacancies';
    protected $view = 'nova-careers::page-blocks.vacancies';

    /**
     * Constructor for class.
     *
     * @param CareerRepository $careerRepository
     */
    public function __construct(private CareerRepository $careerRepository)
    {
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function fields()
    {
        return [
            Number::make('Limit')
                ->nullable()
                ->help('The maximum number of vacancies that can be shown.')
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function attributes(array $attributes): array
    {
        return [
            'vacancies' => $this->getVacancies($attributes),
        ];
    }

    /**
     * Runs a query to get all published vacancies.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getVacancies($attributes)
    {
        $vacancies = $this->careerRepository->published();
        if (!empty($attributes['limit'])) {
            $vacancies->limit($attributes['limit']);
        }

        return $vacancies->get();
    }
}
