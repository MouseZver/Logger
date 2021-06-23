<?php

declare ( strict_types = 1 );

namespace Nouvu\Logger;

use Nouvu\Database\QueryStorageBank;

final class Database implements LoggerInterface
{
	public function __construct ( 
		private string $group, 
		private QueryStorageBank $storage 
	) {}
	
	public function set( string | int | float ...$val ): LoggerInterface
	{
		if ( func_num_args () > 1 )
		{
			$this -> save( sprintf ( ...$val ) );
			
			return $this;
		}
		
		$this -> save( $val[0] );
		
		return $this;
	}
	
	private function save( string | int | float $message ): void
	{
		$this -> storage -> save( Database :: class, [ date ( 'Y-m-d H:i:s' ), $this -> group, $message ] );
	}
}