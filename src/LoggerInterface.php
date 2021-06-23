<?php

declare ( strict_types = 1 );

namespace Nouvu\Logger;

interface LoggerInterface
{
	public function set( string | int | float ...$val ): LoggerInterface;
}