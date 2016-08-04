<?php

namespace ItWorks;

/**
 * Граф
 */
class Graph {
	
	private $graph = [];

	public function __construct(array $graph) {
		$this->graph = $this->normalize($graph);
	}

	public function resolvePath(Path $path, $pathFinder = '\ItWorks\Graph::findPath') {
		$allnodes = [];
		$path->eachInterval(function ($a, $aParams, $b, $bParams) use(&$allnodes, $pathFinder) {
			$nodes = call_user_func($pathFinder, $this->graph, $a, $b);
			$last = count($nodes) - 1;
			$i = 0;
			foreach ($nodes as $node) {
				if ( ! empty($allnodes) && $i === 0) {
					++$i;
					continue;
				}

				if ($i === 0) {
					$params = $aParams;
				} elseif ($i === $last) {
					$params = $bParams;
				} else {
					$params = [];
				}

				$allnodes[] = [$node, $params];
				++$i;
			}
		});

		return $allnodes;
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

	private function normalize(array $graph) {
		// todo
		return $graph;
	}

}