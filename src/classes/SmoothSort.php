<?php

namespace App\classes;

class SmoothSort extends Sort{
	public $q; 
	public $r; 
	public $p; 
	public $b; 
	public $c; 
	public $r1; 
	public $b1; 
	public $c1;
	
	//Help Functions
	function IsAscending($A, $B)
	{
		return (strcmp($A, $B) <= 0);
	}

	function UP(&$IA, &$IB, &$temp)
	{
		$temp = $IA;
		$IA += $IB + 1;
		$IB = $temp;
	}

	function DOWN(&$IA, &$IB, &$temp)
	{
		$temp = $IB;
		$IB = $IA - $IB - 1;
		$IA = $temp;
	}
	
	//Main functions
	function Sift()
	{
		$temp = 0;
		$t = "";
		$this->r0 = $this->r1;
		$t = $this->array[$this->r0];

		while ($this->b1 >= 3)
		{
			$this->r2 = $this->r1 - $this->b1 + $this->c1;

			if (!$this->IsAscending($this->array[$this->r1 - 1], $this->array[$this->r2]))
			{
				$this->r2 = $this->r1 - 1;
				$this->DOWN($this->b1, $this->c1, $temp);
			}

			if ($this->IsAscending($this->array[$this->r2], $t))
			{
				$this->b1 = 1;
			}
			else
			{
				$this->array[$this->r1] = $this->array[$this->r2];
				$this->r1 = $this->r2;
				$this->DOWN($this->b1, $this->c1, $temp);
			}
		}

		if ($this->r1 - $this->r0)
			$this->array[$this->r1] = $t;
	}

	function Trinkle()
	{
		$temp = 0;
		$t = "";
		$this->p1 = $this->p;
		$this->b1 = $this->b;
		$this->c1 = $this->c;
		$this->r0 = $this->r1;
		$t = $this->array[$this->r0];

		while ($this->p1 > 0)
		{
			while (($this->p1 & 1) == 0)
			{
				$this->p1 >>= 1;
				$this->UP($this->b1, $this->c1, $temp);
			}

			$this->r3 = $this->r1 - $this->b1;

			if (($this->p1 == 1) || $this->IsAscending($this->array[$this->r3], $t))
			{
				$this->p1 = 0;
			}
			else
			{
				--$this->p1;

				if ($this->b1 == 1)
				{
					$this->array[$this->r1] = $this->array[$this->r3];
					$this->r1 = $this->r3;
				}
				else
				{
					if ($this->b1 >= 3)
					{
						$this->r2 = $this->r1 - $this->b1 + $this->c1;

						if (!$this->IsAscending($this->array[$this->r1 - 1], $this->array[$this->r2]))
						{
							$this->r2 = $this->r1 - 1;
							$this->DOWN($this->b1, $this->c1, $temp);
							$this->p1 <<= 1;
						}
						if ($this->IsAscending($this->array[$this->r2], $this->array[$this->r3]))
						{
							$this->array[$this->r1] = $this->array[$this->r3]; $this->r1 = $this->r3;
						}
						else
						{
							$this->array[$this->r1] = $this->array[$this->r2];
							$this->r1 = $this->r2;
							$this->DOWN($this->b1, $this->c1, $temp);
							$this->p1 = 0;
						}
					}
				}
			}
		}

		if ($this->r0 - $this->r1)
			$this->array[$this->r1] = $t;

		$this->Sift();
	}

	function SemiTrinkle()
	{
		$T = "";
		$this->r1 = $this->r - $this->c;
		if (!$this->IsAscending($this->array[$this->r1], $this->array[$this->r]))
		{
			$T = $this->array[$this->r];
			$this->array[$this->r] = $this->array[$this->r1];
			$this->array[$this->r1] = $T;
			$this->Trinkle();
		}
	}

	function order( )
	{
		$temp = 0;
		$this->array;
		$this->q = 1;
		$this->r = 0;
		$this->p = 1;
		$this->b = 1;
		$this->c = 1;
		while ($this->q < $this->array_size)
		{
			$this->r1 = $this->r;
			if (($this->p & 7) == 3)
			{
				$this->b1 = $this->b;
				$this->c1 = $this->c;
				$this->Sift();
				$this->p = ($this->p + 1) >> 2;
				$this->UP($this->b, $this->c, $temp);
				$this->UP($this->b, $this->c, $temp);
			}
			else if (($this->p & 3) == 1)
			{
				if ($this->q + $this->c < $this->array_size)
				{
					$this->b1 = $this->b;
					$this->c1 = $this->c;
					$this->Sift();
				}
				else
				{
					$this->Trinkle();
				}

				$this->DOWN($this->b, $this->c, $temp);
				$this->p <<= 1;

				while ($this->b > 1)
				{
					$this->DOWN($this->b, $this->c, $temp);
					$this->p <<= 1;
				}
				++$this->p;
			}
			++$this->q;
			++$this->r;
		}

		$this->r1 = $this->r;
		$this->Trinkle();

		while ($this->q > 1)
		{
			--$this->q;

			if ($this->b == 1)
			{
				--$this->r;
				--$this->p;

				while (($this->p & 1) == 0)
				{
					$this->p >>= 1;
					$this->UP($this->b, $this->c, $temp);
				}
			}
			else
			{
				if ($this->b >= 3)
				{
					--$this->p;
					$this->r = $this->r - $this->b + $this->c;
					if ($this->p > 0)
						$this->SemiTrinkle();

					$this->DOWN($this->b, $this->c, $temp);
					$this->p = ($this->p << 1) + 1;
					$this->r = $this->r + $this->c;
					$this->SemiTrinkle();
					$this->DOWN($this->b, $this->c, $temp);
					$this->p = ($this->p << 1) + 1;
				}
			}
		}
		
		return $this->array;
	}


	/**
	 * Funções para contagem de operações
	 */

	function Sift_count()
	{
		$temp = 0;
		$t = "";
		$this->r0 = $this->r1;
		$t = $this->array[$this->r0];

		while ($this->b1 >= 3)
		{
            $this->addCount();
            $this->r2 = $this->r1 - $this->b1 + $this->c1;

			if (!$this->IsAscending($this->array[$this->r1 - 1], $this->array[$this->r2]))
			{
                $this->addCount();
                $this->r2 = $this->r1 - 1;
				$this->DOWN($this->b1, $this->c1, $temp);
			}

			if ($this->IsAscending($this->array[$this->r2], $t))
			{
                $this->addCount();
                $this->b1 = 1;
			}
			else
			{
				$this->array[$this->r1] = $this->array[$this->r2];
				$this->r1 = $this->r2;
				$this->DOWN($this->b1, $this->c1, $temp);
			}
		}

		if ($this->r1 - $this->r0) {
            $this->addCount();
            $this->array[$this->r1] = $t;
        }
			
	}

	function Trinkle_count()
	{
		$temp = 0;
		$t = "";
		$this->p1 = $this->p;
		$this->b1 = $this->b;
		$this->c1 = $this->c;
		$this->r0 = $this->r1;
		$t = $this->array[$this->r0];

		while ($this->p1 > 0)
		{
            $this->addCount();
            while (($this->p1 & 1) == 0)
			{
                $this->addCount();
                $this->p1 >>= 1;
				$this->UP($this->b1, $this->c1, $temp);
			}

			$this->r3 = $this->r1 - $this->b1;

			if (($this->p1 == 1) || $this->IsAscending($this->array[$this->r3], $t))
			{
                $this->addCount();
                $this->p1 = 0;
			}
			else
			{
				--$this->p1;

				if ($this->b1 == 1)
				{
                    $this->addCount();
                    $this->array[$this->r1] = $this->array[$this->r3];
					$this->r1 = $this->r3;
				}
				else
				{
                    $this->addCount();
                    if ($this->b1 >= 3)
					{
                        $this->addCount();
                        $this->r2 = $this->r1 - $this->b1 + $this->c1;

						if (!$this->IsAscending($this->array[$this->r1 - 1], $this->array[$this->r2]))
						{
                            $this->addCount();
                            $this->r2 = $this->r1 - 1;
							$this->DOWN($this->b1, $this->c1, $temp);
							$this->p1 <<= 1;
						}
						if ($this->IsAscending($this->array[$this->r2], $this->array[$this->r3]))
						{
                            $this->addCount();
                            $this->array[$this->r1] = $this->array[$this->r3]; $this->r1 = $this->r3;
						}
						else
						{
                            $this->addCount();
                            $this->array[$this->r1] = $this->array[$this->r2];
							$this->r1 = $this->r2;
							$this->DOWN($this->b1, $this->c1, $temp);
							$this->p1 = 0;
						}
					}
				}
			}
		}

		if ($this->r0 - $this->r1) {
            $this->addCount();
            $this->array[$this->r1] = $t;
        }
			
		$this->Sift_count();
	}

	function SemiTrinkle_count()
	{
		$T = "";
		$this->r1 = $this->r - $this->c;
		if (!$this->IsAscending($this->array[$this->r1], $this->array[$this->r]))
		{
            $this->addCount();
            $T = $this->array[$this->r];
			$this->array[$this->r] = $this->array[$this->r1];
			$this->array[$this->r1] = $T;
			$this->Trinkle_count();
		}
	}

	function order_count( )
	{
		$temp = 0;
		$this->array;
		$this->q = 1;
		$this->r = 0;
		$this->p = 1;
		$this->b = 1;
		$this->c = 1;
		while ($this->q < $this->array_size)
		{
            $this->addCount();
            $this->r1 = $this->r;
			if (($this->p & 7) == 3)
			{
                $this->addCount();
                $this->b1 = $this->b;
				$this->c1 = $this->c;
				$this->Sift_count();
				$this->p = ($this->p + 1) >> 2;
				$this->UP($this->b, $this->c, $temp);
				$this->UP($this->b, $this->c, $temp);
			}
			else if (($this->p & 3) == 1)
			{
                $this->addCount();
                if ($this->q + $this->c < $this->array_size)
				{
                    $this->addCount();
                    $this->b1 = $this->b;
					$this->c1 = $this->c;
					$this->Sift_count();
				}
				else
				{
					$this->Trinkle_count();
				}

				$this->DOWN($this->b, $this->c, $temp);
				$this->p <<= 1;

				while ($this->b > 1)
				{
                    $this->addCount();
                    $this->DOWN($this->b, $this->c, $temp);
					$this->p <<= 1;
				}
				++$this->p;
			}
			++$this->q;
			++$this->r;
		}

		$this->r1 = $this->r;
		$this->Trinkle_count();

		while ($this->q > 1)
		{
            $this->addCount();
            --$this->q;

			if ($this->b == 1)
			{
                $this->addCount();
                --$this->r;
				--$this->p;

				while (($this->p & 1) == 0)
				{
                    $this->addCount();
                    $this->p >>= 1;
					$this->UP($this->b, $this->c, $temp);
				}
			}
			else
			{
				if ($this->b >= 3)
				{
                    $this->addCount();
                    --$this->p;
					$this->r = $this->r - $this->b + $this->c;
					if ($this->p > 0){
                        $this->addCount();
                        $this->SemiTrinkle_count();
                    }
					$this->DOWN($this->b, $this->c, $temp);
					$this->p = ($this->p << 1) + 1;
					$this->r = $this->r + $this->c;
					$this->SemiTrinkle_count();
					$this->DOWN($this->b, $this->c, $temp);
					$this->p = ($this->p << 1) + 1;
				}
			}
		}
		
		return $this->array;
	}
}