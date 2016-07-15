<?php

namespace ItWorks;

/**
 * Система -- граф состояний
 */
class System {
	
	private $states = [];

	public function addState(State $state) {
		$this->states[] = $state;
	}

	public function resolvePath(Path $path, callable $pathFinder = '\ItWorks\System::findPath') {
		$graph = [];
		foreach ($this->states as $state) {
			$graph[$state->getId()] = $state->getLinks();
		}

		$allStates = [];
		$path->eachInterval(function ($a, $aParams, $b, $bParams) use(&$allStates, $graph, $pathFinder) {
			$states = call_user_func($pathFinder, $graph, $a, $b);
			$last = count($states) - 1;
			foreach ($states as $state) {
				if ( ! empty($allStates) && $i === 0) {
					continue;
				}

				if ($i === 0) {
					$params = $aParams;
				} elseif ($i === $last) {
					$params = $bParams;
				} else {
					$params = [];
				}

				$allStates[] = [$state, $params];
				++$i;
			}
		});

		return $allStates;
	}

	/**
	 * Поиск кратчайшего пути
	 * @param array $graph граф, список узлов вида [узел1 => [узел2, узел3, ...], узел2 => ...]
	 * @param string $from
	 * @param string $to
	 * @return array
	 */
	public static function findPath(array $graph, $from, $to) {
		$nodes = array_fill_keys(
			array_keys($graph),
			INF
		);
		$nodes[$from] = 0;
		$p = [$from => null];
		$min = INF;

		while (count($nodes) > 0) {
			$mins = array_keys($nodes, min($nodes));
			$current = reset($mins);
			if ($current === $to || $nodes[$current] === INF) {
				break;
			} elseif ($nodes[$current] < $min) {
				foreach ($graph[$current] as $neighbor) {
					if ( ! isset($nodes[$neighbor])) {
						continue;
					}
					$w = $nodes[$current] + 1;
					if ($nodes[$neighbor] > $w) {
						$nodes[$neighbor] = $w;
						$p[$neighbor] = $current;
					}

					if ($neighbor === $to) {
						$min = min($nodes[$neighbor], $min);
					}
				}
			}

			unset($nodes[$current]);
		}

		$path = [];
		$current = $to;
		while (array_key_exists($current, $p)) {
			$path[] = $current;
			$current = $p[$current];
		}

		return array_reverse($path);
	}

}