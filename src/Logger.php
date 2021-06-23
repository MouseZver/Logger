<?php

declare ( strict_types = 1 );

namespace Nouvu\Logger;

final class Logger implements LoggerInterface
{
	private array $lines;
	
	public function __construct ( private string $file )
	{
		register_shutdown_function ( function (): void
		{
			if ( ! empty ( $this -> lines ) )
			{
				file_put_contents ( $this -> file . '.log', implode ( PHP_EOL, $this -> lines ) . PHP_EOL, FILE_APPEND );
			}
		} );
	}
	
	public function set( string | int | float ...$val ): LoggerInterface
	{
		if ( func_num_args () > 1 )
		{
			$this -> lines[] = date ( 'Y-m-d H:i:s - ' ) . sprintf ( ...$val );
			
			return $this;
		}
		
		$this -> lines[] = date ( 'Y-m-d H:i:s - ' ) . $val[0];
		
		return $this;
	}
}