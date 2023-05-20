<?php

declare(strict_types=1);

namespace Growpro\Exercise\Application;

class Regex
{
    private const REGEX = "/@\[(\w+)]\(user-gpe-(\d+)\)/";

    /**
     * Devolver un array con los identificadores numéricos ordenados por orden,
     * para el patrón @[Franklin](user-gpe-{{id}}),
     * donde {{id}} será el identificador.
     *
     * NOTA: La función retorna el arreglo tal como se anuncia en el ejemplo,
     * pero en caso de que sea necesario aplicar algun orden en especificio,
     * sería descomentar la función correspondiente (ascendente=>sort, descendente=>rsort)
     *
     * @param string $text
     * @return array
     */
    public function getIdentificationsByText(string $text): array
    {
        preg_match_all(self::REGEX, $text, $matches);

        $ids = $matches[2] ?? [];
        //sort($ids); ordena los valores ascendentemente
        //rsort($ids); ordena los valores descendentemente

        return array_map('intval', $ids);
    }

    /**
     * Devolver el texto reemplazando el patrón @[NameUser](user-gpe-identificador) por @NameUser.
     *
     * @param string $text
     * @return string
     */
    public function transformText(string $text): string
    {
        return preg_replace(self::REGEX, '@$1', $text);
    }
}
