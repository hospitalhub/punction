<?php
namespace Punction\Entities;

use Hospitalplugin\DB\DoctrineBootstrap;
use Hospitalplugin\utils\Utils;

class PatientRaport
{

    public static function getRaport($wardId, $date)
    {
        $em = DoctrineBootstrap::getEntityManager();
        $em->getConfiguration()->addCustomDatetimeFunction('DATE', 'Hospitalplugin\DQLFunctions\DateFunction');
        
        $dql = "  SELECT p.kategoriaPacjenta as kategoria, DATE(p.dataKategoryzacji) as data, COUNT(p.kategoriaPacjenta) as suma ";
        $dql .= " FROM Punction\Entities\Patient p ";
        $dql .= " WHERE p.dataKategoryzacji BETWEEN ?1 AND ?2 AND p.oddzialId = ?3";
        $dql .= " GROUP BY data, p.kategoriaPacjenta";
        
        $startDate = $date . '-01';
        
        $result = $em->createQuery($dql)
            ->setParameter(1, $startDate)
            ->setParameter(2, date("Y-m-t", strtotime($startDate)))
            ->setParameter(3, $wardId)
            ->getResult();
        
        $table = array();
        foreach ($result as $row) {
            $table[$row['data']][$row['kategoria']] = $row['suma'];
        }
        return $table;
    }
}