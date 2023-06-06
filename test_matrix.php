<?php

function findMinimumJumps($start, $end, $boardSize)
{
    // Verificar si el punto de inicio y el punto final están dentro del rango del tablero
    if (
        $start[0] < 0 || $start[0] >= $boardSize || $start[1] < 0 || $start[1] >= $boardSize ||
        $end[0] < 0 || $end[0] >= $boardSize || $end[1] < 0 || $end[1] >= $boardSize
    ) {
        return -1; // Puntos fuera de rango
    }

    // Matriz de visitados para realizar el seguimiento de los nodos visitados
    $visited = array_fill(0, $boardSize, array_fill(0, $boardSize, false));

    // Cola para almacenar los nodos a visitar
    $queue = new SplQueue();

    // Agregar el punto de inicio a la cola
    $queue->enqueue([$start, 0]); // [coordenada, saltos]

    // Marcar el punto de inicio como visitado
    $visited[$start[0]][$start[1]] = true;

    // Direcciones posibles: arriba, abajo, izquierda, derecha
    $directions = [[-1, 0], [1, 0], [0, -1], [0, 1]];

    // Bucle principal del BFS
    while (!$queue->isEmpty()) {
        // Obtener el siguiente nodo de la cola
        [$current, $jumps] = $queue->dequeue();

        // Verificar si hemos llegado al punto final
        if ($current[0] == $end[0] && $current[1] == $end[1]) {
            return $jumps; // Devolver el número de saltos
        }

        // Explorar las direcciones adyacentes
        foreach ($directions as $dir) {
            $nextX = $current[0] + $dir[0];
            $nextY = $current[1] + $dir[1];

            // Verificar si la siguiente posición es válida y no ha sido visitada
            if (
                $nextX >= 0 && $nextX < $boardSize && $nextY >= 0 && $nextY < $boardSize &&
                !$visited[$nextX][$nextY]
            ) {
                // Marcar la siguiente posición como visitada y agregarla a la cola
                $visited[$nextX][$nextY] = true;
                $queue->enqueue([[$nextX, $nextY], $jumps + 1]);
            }
        }
    }

    return -1; // No se encontró un camino válido
}

// Ejemplo de uso
$start = [5, 5];
$end = [6, 6];
$boardSize = 10;

$minJumps = findMinimumJumps($start, $end, $boardSize);
echo $minJumps;
