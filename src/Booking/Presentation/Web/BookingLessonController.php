<?php

declare(strict_types=1);

namespace App\Booking\Presentation\Web;

use App\Booking\Application\UseCases\BookLesson\BookLesson;
use App\Booking\Application\UseCases\BookLesson\InputBoundary;
use App\Shared\Presentation\ControllerBase;

final class BookingLessonController extends ControllerBase
{
    private BookLesson $useCase;

    public function __construct(BookLesson $useCase)
    {
        $this->useCase = $useCase;
    }

    protected function handle(): array
    {
        $input = InputBoundary::build($this->body);

        return $this->useCase
            ->handle($input)
            ->toArray();
    }
}
