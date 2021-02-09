<?php

declare(strict_types=1);

namespace App\Lesson\Presentation\Web;

use App\Lesson\Application\UseCases\Create\Create;
use App\Lesson\Application\UseCases\Create\InputBoundary;
use App\Shared\Presentation\ControllerBase;

final class LessonCreateController extends ControllerBase
{
    private Create $useCase;

    public function __construct(Create $useCase)
    {
        $this->useCase = $useCase;
    }

    protected function handle(): array
    {
        $this->body['capacity'] = (int)$this->body['capacity'];
        $input = InputBoundary::build($this->body);

        return $this->useCase
            ->handle($input)
            ->toArray();
    }
}
