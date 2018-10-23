<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Pskli\Events\Model;

final class Location
{

	public function street(): string
	{
		return 'Musterstraße 2';
	}

	public function postalCode(): string
	{
		return '123456';
	}

	public function city(): string
	{
		return 'Musterhausen';
	}

	public function name(): string
	{
		return 'Muster City Hill';
	}
	
	public function country(): string
	{
		return 'Germany';
	}
}
