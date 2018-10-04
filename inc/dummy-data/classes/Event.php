<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Inpsyde\Events\Model;

final class Event
{

	public static function fromPost(\WP_Post $post): Event
	{
		return new static($post);
	}

	public function id(): int
	{
		return 0;
	}

	public function startDate(): \DateTimeImmutable
	{
		return new \DateTimeImmutable('now + 1 month');
	}

	public function endDate(): \DateTimeImmutable
	{
		return new \DateTimeImmutable('now + 35 days');
	}
	
	public function registrationEnd(): \DateTimeImmutable
	{
		return new \DateTimeImmutable('now + 25 days');
	}

	public function includedInPrice(): array
	{
		return [
			'drinks',
			'food',
		];
	}

	public function subscribedMin(): int
	{
		return 1;
	}

	public function subscribedMax(): int
	{
		return 5;
	}
	

	public function additionalNotes(): string
	{
		return 'Additional information about this event can be found on tour website www.example.com';
	}

	public function location(): Location
	{
		return new Location();
	}

	public function contactPerson(): ContactPerson
	{
		return new ContactPerson();
	}
}
