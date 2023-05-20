<?php

declare(strict_types=1);

namespace Growpro\Exercise\Application;

class Arrays
{
    public const ASC = 'ASC';
    public const DESC = 'DESC';

    private function sortArrayIfAnyKeyDoesNotExist(array $sortCriteria, array &$array): void
    {
        foreach ($sortCriteria as $key => $direction) {
            foreach ($array as $index => $values) {
                if (!array_key_exists($key, $values)) {
                    unset($array[$index]);
                    if ($direction === self::ASC) {
                        array_unshift($array, $values);

                        continue;
                    }

                    $array[] = $values;
                }
            }
        }
    }

    /**
     * Implementar una función PHP que ordene un array de arrays. La función recibirá dos parámetros,
     * el primero con el array a ordenar, y el segundo parámetro será otro array con el criterio de ordenación,
     * donde la key de cada elemento de este segundo array indicará sobre que propiedad hay que ordenar,
     * y el valor de cada elemento indicará la dirección de ordenamiento (ascendente(ASC) o descendente (DESC)).
     *
     * Si alguno de los elementos del array a ordenar no contiene la key por la que se pide ordenar,
     * el valor para esa key se considerará null y el elemento se devolverá al principio de la lista
     * si el orden es ASC o al final si el orden es DESC.
     *
     * La función que desarrolles permitirá que el segundo parámetro puede ser null,
     * pero en ese caso devolverá el resultado sin ningún tipo de reordenación.
     *
     * @param array $array
     * @param array|null $sortCriteria
     * @return array
     */
    public function sortArrayOfArrays(array $array, array $sortCriteria = null): array
    {
        if (empty($sortCriteria)) {
            return $array;
        }

        $this->sortArrayIfAnyKeyDoesNotExist($sortCriteria, $array);

        usort($array, static function ($a, $b) use ($sortCriteria) {
            foreach ($sortCriteria as $key => $direction) {
                if (!array_key_exists($key, $a) || !array_key_exists($key, $b)) {
                    continue;
                }

                if (count($a) !== count($b)) {
                    continue;
                }

                if ($a[$key] === $b[$key]) {
                    continue;
                }

                if ($direction === self::DESC) {
                    return $b[$key] <=> $a[$key];
                }

                return $a[$key] <=> $b[$key];
            }

            return 0;
        });

        return $array;
    }
}
