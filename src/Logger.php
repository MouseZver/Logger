<?php

declare ( strict_types = 1 );

namespace Nouvu;

final class Logger
{
	private array $lines;
	
	private string $file;
	
	public int $time;
	
	public function __construct ( string $name, int $time = null, bool $save = true )
	{
		$this -> file = $name;
		
		$this -> time = $time ?? time ();
		
		if ( $save )
		{
			register_shutdown_function ( [ $this, 'save' ] );
		}
	}
	
	public function set( ...$val ): self
	{
		if ( func_num_args () > 1 )
		{
			$this -> lines[] = sprintf ( ...$val );
			
			return $this;
		}
		
		$this -> lines[] = $val[0];
		
		return $this;
	}
	
	public function save(): void
	{
		if ( ! empty ( $this -> lines ) )
		{
			$start = date ( 'Y-m-d H:i:s - ', $this -> time );
			
			file_put_contents ( $this -> file . '.log', $start . implode ( PHP_EOL . $start, $this -> lines ) . PHP_EOL, FILE_APPEND );
			
			$this -> lines = [];
		}
	}
}