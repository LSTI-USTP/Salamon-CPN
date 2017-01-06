<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PrintTable
 *
 * @author AhmedJorge
 */
class PrintTable {

    public static function createArray($valores) {
        $val = explode(";", $valores);
        $prinArray = array();
        foreach ($val as $va) {
            $newArr = explode(":", $va);
            if (count($newArr) == 2) {
                $prinArray[$newArr[1]] = $newArr[0];
            }
        }
        return $prinArray;
    }

    public static function exist(array $arrP, $value) {
        foreach ($arrP as $key => $val) {
            if ($key == $value) {
                return " st='true' style='background-color: #09f; color: #fff;'";
            }
        }
        return "st=''";
    }

    public static function printResult(array $arr, array $arrP, $pes) {
        if (count($arr) > 0 || $pes == TRUE) {
            PrintTable::returnRowTable($arr, $arrP);
        } else {
            PrintTable::returnRowTable($arrP, $arrP);
        }
    }

    public static function returnRowTable(array $arr, array $arrP) {
        foreach ($arr as $key => $value) {
            $re = PrintTable::exist($arrP, $key);
            echo "<tr class='$key' onclick=\"getValueLine($('.$key'))\" >";
            echo "<td " . $re . " class='Line$key'>" . $value . "</td>";
            echo '</tr>';
        }
    }

    public static function arrayForBD($valores) {
        $val = explode(";", $valores);
        $string = "";
        $prinArray = array();
        $q = 0;
        foreach ($val as $va) {
            $newArr = explode(":", $va);
            if (count($newArr) == 2) {
                $prinArray[$q] = $newArr[1];
                $q++;
            }
        }
        for ($index = 0; $index < count($prinArray); $index++) {
            if ($index == 0 && $index + 1 == count($prinArray)) {
                $string .= "{" . $prinArray[$index] . "}";
            } else if ($index == 0) {
                $string .= "{" . $prinArray[$index];
            } else if ($index + 1 == count($prinArray)) {
                $string .= "," . $prinArray[$index] . "}";
            } else {
                $string .= "," . $prinArray[$index];
            }
        }
        return $string;
    }

    public static function createTablePHP($string, $patter1 = ";", $patter2 = NULL) {
        if ($string != "") {
            $newArray = explode($patter1, $string);
            foreach ($newArray as $value) {
                echo '<tr>';
                if ($patter2 != NULL) {
                    $outherArray = explode($patter2, $value);
                    foreach ($outherArray as $value1) {
                        echo "<td>" . $value1 . "</td>";
                    }
                } else {
                    echo "<td>" . $value1 . "</td>";
                }
                echo '</tr>';
            }
        }
    }

    public static function loadBDTable(array $remane = array(), $cabecario = FALSE, array $acao = array(), $id = "", $forTable = "") {
//        echo "<table $forTable >";
        $i = 0;
        while ($array = CallPgSQL::getValors()) {
            if ($i == 0) {
                if ($cabecario == TRUE) {
                    echo '<thead>';
                    echo '<tr>';
                    foreach ($array as $colunm => $value1) {
                        $find = FALSE;
                        foreach ($remane as $key => $value) {
                            if ($colunm == $key) {
                                echo '<th>' . $value . '</th>';
                                $find = TRUE;
                            }
                        }
                    }
                }
                if (count($acao) > 0) {
                    echo '<th>Ação</th>';
                }
                echo '</tr>';
                echo '</thead>';
            }
            if ($i == 0) {
                echo '<tbody ' . $forTable . ' >';
            }
            echo '<tr class="linhaTable" var="'.$array[$id].'" >';
            foreach ($array as $colunm => $valuePrint) {
                foreach ($remane as $key => $value) {
                    if ($colunm == $key) {
                        echo '<td>' . $valuePrint . '</td>';
                    }
                }
            }
            /**
             * testa se existe acao definidas
             */
            if (count($acao) > 0) {
                echo '<td>';
            }

            foreach ($acao as $key => $value) {
                $forLabel = explode(";", $key);
                $envento = str_replace("?", $array[$id], $value);
                echo "<i class=\"$forLabel[0]\" onclick=\"$envento\" title=\"$forLabel[1]\" ></i>";
            }

            if (count($acao) > 0) {
                echo '</td>';
            }
            echo '</tr>';
            $i++;
        }
        if ($i > 0) {
            echo '</tbody>';
        }
        if ($i == 0) {
            echo '<thead>';
            echo '<tr>';
            foreach ($remane as $key => $value) {
                echo '<th>' . $value . '</th>';
            }
            echo '</tr>';
            echo '</thead>';
        }
//        echo '</table>';
    }

    const typeFuncTable = "FuncTable";
    const typeSelect = "Select";

    public static function PrintTableShearch($veiwName, $valueShearch, array $array, $type = "Select",array $listParam = array()) {
        $listShearch = array();
        $i = 1;
        foreach ($array as $key => $value) {
            if ($i == 1) {
                $listShearch[ $key . ";like"]  = "%" . $valueShearch . "%";
            } else {
                $listShearch[ $key .";or;like"] = "%" . $valueShearch . "%";
            }
            $i = 2;
        }
    
        if (PrintTable::typeFuncTable == $type) {
            CallPgSQL::functionTable ( $veiwName, "*", $listParam, $listShearch);
        } else if (PrintTable::typeSelect == $type) {
            CallPgSQL::simplesSelect($veiwName, "*", $listShearch);
        }
        
//        echo CallPgSQL::getSql();
    }

}
