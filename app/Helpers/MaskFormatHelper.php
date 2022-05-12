<?php

function formatCpfCnpj($value)
{
    $cnpj_cpf = preg_replace("/\D/", '', $value);

    if (strlen($cnpj_cpf) === 11) {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
    } 
    
    return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
}

function formatNis($value)
{
    $nis = preg_replace("/\D/", '', $value);

    if (strlen($nis) === 11) {
        return preg_replace("/(\d{3})(\d{5})(\d{2})(\d{1})/", "\$1.\$2.\$3-\$4", $nis);
    } 

    return $value;
}

function formatSerieCtps($value)
{
    $ctps = preg_replace("/\D/", '', $value);

    if (strlen($ctps) === 4) {
        return preg_replace("/(\d{3})(\d{1})/", "\$1-\$2", $ctps);
    } 

    return $value;
}

function formatTelCel($value)
{
    $tel_cel = preg_replace("/\D/", '', $value);

    if (strlen($tel_cel) === 11) {
        return preg_replace("/(\d{2})(\d{5})(\d{4})/", "(\$1) \$2-\$3", $tel_cel);
    }

    return preg_replace("/(\d{2})(\d{4})(\d{4})/", "(\$1) \$2-\$3", $tel_cel);
}

function formatCep($value)
{
    $cep = preg_replace("/\D/", '', $value);

    if (strlen($cep) === 8) {
        return preg_replace("/(\d{2})(\d{3})(\d{3})/", "\$1.\$2-\$3", $cep);
    }

    return $value;
}

function formatMoeda($value)
{
    //$moeda = preg_replace("/\D/", '', $value);
    return number_format($value, 2, ',', '.');

}