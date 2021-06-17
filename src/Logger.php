<?php

declare ( strict_types = 1 );

namespace Nouvu\Logger;

final class Logger implements InterfaceLogger
{
	private array $lines;
	
	public function __construct ( private string $file, public int $time = null )
	{
		$this -> time ??= time ();
		
		if ( $save )
		{
			register_shutdown_function ( [ $this, 'save' ] );
		}
	}
	
	public function set( string | int | float ...$val ): InterfaceLogger
	{
		if ( func_num_args () > 1 )
		{
			$this -> lines[] = sprintf ( ...$val );
			
			return $this;
		}
		
		$this -> lines[] = $val[0];
		
		return $this;
	}
	
	private function save(): void
	{
		if ( ! empty ( $this -> lines ) )
		{
			$start = date ( 'Y-m-d H:i:s - ', $this -> time );
			
			file_put_contents ( $this -> file . '.log', $start . implode ( PHP_EOL . $start, $this -> lines ) . PHP_EOL, FILE_APPEND );
		}
	}
}