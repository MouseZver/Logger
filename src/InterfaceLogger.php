<?php

declare ( strict_types = 1 );

namespace Nouvu\Logger;

interface InterfaceLogger
{
	public function set( string | int | float ...$val ): InterfaceLogger;
}