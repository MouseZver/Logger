<?php

declare ( strict_types = 1 );

namespace Nouvu\Logger;

use Nouvu\Database\QueryStorageBank;

final class Database
{
	private string $group;
	
	private QueryStorageBank $storage;
	
	public function __construct ( string $group, QueryStorageBank $storage )
	{
		$this -> group = $group;
		
		$this -> storage = $storage;
	}
	
	public function set( ...$val ): self
	{
		if ( func_num_args () > 1 )
		{
			$this -> save( sprintf ( ...$val ) );
			
			return $this;
		}
		
		$this -> save( $val[0] );
		
		return $this;
	}
	
	private function save( $message ): void
	{
		$this -> storage -> save( Database :: class, [ date ( 'Y-m-d H:i:s' ), $this -> group, $message ] );
	}
}