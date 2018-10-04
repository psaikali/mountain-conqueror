<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Inpsyde\Events\Model;

final class ContactPerson
{

	public function firstName(): string
	{
		return 'Max';
	}

	public function lastName(): string
	{
		return 'Mustermann';
	}

	public function email(): string
	{
		return 'max@mustermann.com';
	}

	public function position(): string
	{
		return 'Chief of Organization';
	}

	public function telephone(): string
	{
		return '+49 1234 567 89';
	}
}
