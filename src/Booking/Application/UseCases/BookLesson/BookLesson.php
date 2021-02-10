<?php

declare(strict_types=1);

namespace App\Booking\Application\UseCases\BookLesson;

use App\Booking\Application\UseCases\Contracts\BookingRepository;
use App\Booking\Application\UseCases\Contracts\MemberRepository;
use App\Lesson\Application\UseCases\Contracts\LessonRepository;
use App\Shared\Exceptions\AppValidationException;
use DateTimeImmutable;
use DateTimeInterface;

final class BookLesson
{
    private MemberRepository $memberRepository;
    private LessonRepository $lessonRepository;
    private BookLessonValidator $validator;
    private BookingRepository $bookingRepository;

    public function __construct(
        BookLessonValidator $validator,
        MemberRepository $memberRepository,
        LessonRepository $lessonRepository,
        BookingRepository $bookingRepository
    ) {
        $this->validator = $validator;
        $this->memberRepository = $memberRepository;
        $this->lessonRepository = $lessonRepository;
        $this->bookingRepository = $bookingRepository;
    }

    public function handle(InputBoundary $input): OutputBoundary
    {
        $errors = $this->validator->validate($input);

        if (count($errors) > 0) {
            throw new AppValidationException($errors, 'An error occurred while booking your class.');
        }

        $member = $this->memberRepository->findMemberById($input->getMemberId());
        $lesson = $this->lessonRepository->findLessonById($input->getLessonId());
        $date = new DateTimeImmutable($input->getDate());

        if ($date < $lesson->getStartDate() || $date > $lesson->getEndDate()) {
            throw new AppValidationException(
                ['date' => 'out-of-range'],
                'The date informed is out of range the class.'
            );
        }

        if (!$this->bookingRepository->haveVacancyAvailable($lesson)) {
            throw new AppValidationException(
                ['capacity' => 'sold-out'],
                'Vacancies sold out for this class'
            );
        }

        $this->bookingRepository->bookLesson($member, $lesson, $date);

        return OutputBoundary::build([
            'member' => $member->toArray(),
            'date' => $date->format(DateTimeInterface::ATOM)
        ]);
    }
}
