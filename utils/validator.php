<?php

namespace App\Utils;

class Validator
{
    public static function validarTransacao(array $data): bool
    {
        // Verifica se todos os campos obrigatórios existem
        if (!isset($data['id'], $data['valor'], $data['dataHora'])) {
            return false;
        }

        if (!self::isUUID($data['id'])) {
            return false;
        }

        if (!is_numeric($data['valor']) || $data['valor'] < 0) {
            return false;
        }

        if (!self::isISO8601($data['dataHora'])) {
            return false;
        }

        $dataHora = strtotime($data['dataHora']);
        if ($dataHora === false || $dataHora > time()) {
            return false;
        }

        return true;
    }

    private static function isUUID(string $uuid): bool
    {
        return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i', $uuid);
    }

    private static function isISO8601(string $date): bool
    {
        return (bool) \DateTime::createFromFormat(\DateTime::ATOM, $date);
    }
}
