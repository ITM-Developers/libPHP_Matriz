<?php

class Matriz
{
    private $ROWS;          // Numero de Filas en la Matriz
    private $COLS;          // Numero de Columnas en la matriz
    private $cells;         // Celdas de la matriz

    public function __construct( $rows, $cols )
    {
        $this->cells = array();

        if( is_int($rows) && is_int($cols))
        {
            $this->ROWS = $rows;
            $this->COLS = $cols;

            // Por cada Fila
            for($row = 0; $row < $rows; $row++)
            {
                $this->cells[$row] = array();

                // Por cada columna
                for($col = 0; $col < $cols; $col++)
                {
                    // inicializamos con 0 todas las casillas
                    $text = ($row+1).",".($col+1);
                    array_push($this->cells[$row], 0);
                }
            }
        }
    }

    /**
     * Devuelve el valor de la casilla indicada en los parametros.
     *
     * @param int $row      Fila
     * @param int $col      Columna
     * @return float el valor de la posicion indicada.
     */
    public function get( $row, $col )
    {
        if($row >= 0 && $row < $this->ROWS)
        {
            if($col >= 0 && $col < $this->COLS)
            {
                return $this->cells[$row][$col];
            }
            else
            {
                print "FILA ({$col} not in ({$this->COLS}) )FUERA DE RANGO";
            }
        }
        else
        {
            print "FILA ({$row} not in ({$this->ROWS}) )FUERA DE RANGO";
        }
    }

    /**
     * Asigna un valor a una posicion en la matriz, solo se permiten valores int o float.
     * 
     * @param int $row
     * @param int $col
     * @param int,float $value
     * @return void
     */
    public function set( $row, $col, $value )
    {
        if($row >= 0 && $row < $this->ROWS)
        {
            if($col >= 0 && $col < $this->COLS)
            {
                $this->cells[$row][$col] = floatval($value);
            }
            else
            {
                print "FILA ({$col} not in ({$this->COLS}) )FUERA DE RANGO";
            }
        }
        else
        {
            print "FILA ({$row} not in ({$this->ROWS}) )FUERA DE RANGO";
        }
    }

    /**
     * @return int Devuelve un entero que indica el numero de Filas en la matriz
     */
    public function getRowsSize()
    {
        return $this->ROWS;
    }

    /**
     * @return int Devuelve un entero que indica el numero de columnas en la matriz
     */
    public function getColsSize()
    {
        return $this->COLS;
    }

    /**
     * Realiza la suma de dos matrices las cuales son pasadas como argumentos.
     *
     * @param Matriz $a
     * @param Matriz $b
     * @return Matriz Retorna una nueva matriz la cual es el resultado de la suma.
     */
    public static function Sumar( &$a, &$b )
    {
        // Primero validamos que los parametros sean del tipo Matriz
        if( $a instanceof Matriz && $b instanceof Matriz )
        {
            // Para sumar dos matrices es necesario que sean del mismo orden, es decir, que tengan el mismo numero de filas
            // que de columnas.
            $numeroDeFilasDeLaMatrizA = $a->getRowsSize();
            $numeroDeFilasDeLaMatrizB = $b->getRowsSize();
            $numeroDeColumnasDeLaMatrizA = $a->getColsSize();
            $numeroDeColumnasDeLaMatrizB = $b->getColsSize();

            if(    $numeroDeFilasDeLaMatrizA == $numeroDeFilasDeLaMatrizB
                                             &&
                $numeroDeColumnasDeLaMatrizA == $numeroDeColumnasDeLaMatrizB )
            {
                // creamos la nueva matriz que es el resultado de la suma
                $rows = $numeroDeFilasDeLaMatrizA;
                $cols = $numeroDeColumnasDeLaMatrizA;
                $matrizResultante = new Matriz( $rows, $cols );

                // Procedemos a realizar la suma de todos los elemtnos de la matriz A con B
                for($row = 0; $row < $rows; $row++)
                {
                    for($col = 0; $col < $cols; $col++)
                    {
                        $value = $a->get($row,$col) + $b->get($row,$col);
                        $matrizResultante->set($row, $col, $value);
                    }
                }

                return $matrizResultante;
            }
            else
            {
                print "No es posible sumar las matrices por que son de diferente orden";
            }
        }
        else
        {
            print "no son instancia de Matriz";
        }
    }

    public static function Escalar( &$A, $escalar )
    {
        // Convertimos a float, es necesario ya que el usaurio puede pasar un int, o un string,
        $escalar = floatval($escalar);

        // validamos que los parametros son del tipo correcto
        if($A instanceof Matriz && is_float($escalar) )
        {
            $rows = $A->getRowsSize();
            $cols = $A->getColsSize();

            // inicializamos la matriz que vamos a devolver como resultado
            $matrizResultante = new Matriz( $rows, $cols );

            for($row = 0; $row < $rows; $row++)
            {
                for($col = 0; $col < $cols; $col++)
                {
                    $value = $escalar * $A->get($row,$col);
                    $matrizResultante->set($row, $col, $value);
                }
            }

            return $matrizResultante;
        }
        else
        {
            print "parametro incoreecto";
        }
    }
}

/*
$matriz = new Matriz(3,3);

for($row = 0; $row < 3; $row++)
{
    for($col = 0; $col < 3; $col++)
    {
        $matriz->set( $row, $col, $row + (0.1*$col));
    }
}

for($row = 0; $row < 3; $row++)
{
    for($col = 0; $col < 3; $col++)
    {
        print $matriz->get( $row, $col ) . "\n";
    }
}
*/

$a = new Matriz(2,2);
$b = new Matriz(2,2);

$a->set(0,0, 11);
$a->set(0,1,  3);
$a->set(1,0,  0);
$a->set(1,1, -3);

$b->set(0,0, -6);
$b->set(0,1, -2);
$b->set(1,0,  4);
$b->set(1,1,  3);

/*
$c = Matriz::Sumar($a,$b);
for($row = 0; $row < 2; $row++)
{
    for($col = 0; $col < 2; $col++)
    {
        print "({$row},{$col})=".$c->get( $row, $col ) . "\n";
    }
}
*/

// EJEMPLPO ESCALAR
$aEscalar = Matriz::Escalar($a, 3);
$bEscalar = Matriz::Escalar($b, -2);
for($row = 0; $row < 2; $row++)
{
    for($col = 0; $col < 2; $col++)
    {
        print "({$row},{$col})=".$aEscalar->get( $row, $col ) . "\n";
    }
}
for($row = 0; $row < 2; $row++)
{
    for($col = 0; $col < 2; $col++)
    {
        print "({$row},{$col})=".$bEscalar->get( $row, $col ) . "\n";
    }
}