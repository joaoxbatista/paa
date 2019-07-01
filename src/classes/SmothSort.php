<?php

namespace App\classes;

class SmoothSort {

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

	$q; $r; $p; $b; $c; $r1; $b1; $c1;
	$A = array();

	function Sift()
	{
		global $r1, $b1, $c1, $A;
		
		$r0; $r2; $temp = 0;
		$t = "";
		$r0 = $r1;
		$t = $A[$r0];

		while ($b1 >= 3)
		{
			$r2 = $r1 - $b1 + $c1;

			if (!IsAscending($A[$r1 - 1], $A[$r2]))
			{
				$r2 = $r1 - 1;
				DOWN($b1, $c1, $temp);
			}

			if (IsAscending($A[$r2], $t))
			{
				$b1 = 1;
			}
			else
			{
				$A[$r1] = $A[$r2];
				$r1 = $r2;
				DOWN($b1, $c1, $temp);
			}
		}

		if ($r1 - $r0)
			$A[$r1] = $t;
	}

	function Trinkle()
	{
		global $p, $b, $c, $r1, $b1, $c1, $A;
		$p1; $r2; $r3; $r0; $temp = 0;
		$t = "";
		$p1 = $p;
		$b1 = $b;
		$c1 = $c;
		$r0 = $r1;
		$t = $A[$r0];

		while ($p1 > 0)
		{
			while (($p1 & 1) == 0)
			{
				$p1 >>= 1;
				UP($b1, $c1, $temp);
			}

			$r3 = $r1 - $b1;

			if (($p1 == 1) || IsAscending($A[$r3], $t))
			{
				$p1 = 0;
			}
			else
			{
				--$p1;

				if ($b1 == 1)
				{
					$A[$r1] = $A[$r3];
					$r1 = $r3;
				}
				else
				{
					if ($b1 >= 3)
					{
						$r2 = $r1 - $b1 + $c1;

						if (!IsAscending($A[$r1 - 1], $A[$r2]))
						{
							$r2 = $r1 - 1;
							DOWN($b1, $c1, $temp);
							$p1 <<= 1;
						}
						if (IsAscending($A[$r2], $A[$r3]))
						{
							$A[$r1] = $A[$r3]; $r1 = $r3;
						}
						else
						{
							$A[$r1] = $A[$r2];
							$r1 = $r2;
							DOWN($b1, $c1, $temp);
							$p1 = 0;
						}
					}
				}
			}
		}

		if ($r0 - $r1)
			$A[$r1] = $t;

		Sift();
	}

	function SemiTrinkle()
	{
		global $r, $c, $r1, $A;
		$T = "";
		$r1 = $r - $c;

		if (!IsAscending($A[$r1], $A[$r]))
		{
			$T = $A[$r];
			$A[$r] = $A[$r1];
			$A[$r1] = $T;
			Trinkle();
		}
	}

	function SmoothSort($Aarg, $N)
	{
		global $q, $r, $p, $b, $c, $r1, $b1, $c1, $A;

		$temp = 0;
		$A = $Aarg;
		$q = 1;
		$r = 0;
		$p = 1;
		$b = 1;
		$c = 1;

		while ($q < $N)
		{
			$r1 = $r;
			if (($p & 7) == 3)
			{
				$b1 = $b;
				$c1 = $c;
				Sift();
				$p = ($p + 1) >> 2;
				UP($b, $c, $temp);
				UP($b, $c, $temp);
			}
			else if (($p & 3) == 1)
			{
				if ($q + $c < $N)
				{
					$b1 = $b;
					$c1 = $c;
					Sift();
				}
				else
				{
					Trinkle();
				}

				DOWN($b, $c, $temp);
				$p <<= 1;

				while ($b > 1)
				{
					DOWN($b, $c, $temp);
					$p <<= 1;
				}

				++$p;
			}

			++$q;
			++$r;
		}

		$r1 = $r;
		Trinkle();

		while ($q > 1)
		{
			--$q;

			if ($b == 1)
			{
				--$r;
				--$p;

				while (($p & 1) == 0)
				{
					$p >>= 1;
					UP($b, $c, $temp);
				}
			}
			else
			{
				if ($b >= 3)
				{
					--$p;
					$r = $r - $b + $c;
					if ($p > 0)
						SemiTrinkle();

					DOWN($b, $c, $temp);
					$p = ($p << 1) + 1;
					$r = $r + $c;
					SemiTrinkle();
					DOWN($b, $c, $temp);
					$p = ($p << 1) + 1;
				}
			}
		}

		return $A;
	}
}