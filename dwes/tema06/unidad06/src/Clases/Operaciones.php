<?php
class Operaciones
{
    /**
     * @soap
     * @param float $a
     * @param float $b
     * @return float
     */
    public function resta(float $a, float $b):float{
        return $a - $b;
    }

    /**
     * @soap
     * @param float $a
     * @param float $b
     * @return float
     */
    public function suma(float $a, float $b):float{
        return $a + $b;
    }

    /**
     * @soap
     * @param string $texto
     * @return string
     */
    public function saludo(string $texto):string{
        return "Hola $texto";
    }
}