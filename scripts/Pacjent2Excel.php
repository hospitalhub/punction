<?php
/**
 * Pacjent2Excel
 *
 * THIS MATERIAL IS PROVIDED AS IS, WITH ABSOLUTELY NO WARRANTY EXPRESSED
 * OR IMPLIED. ANY USE IS AT YOUR OWN RISK.
 *
 * Permission is hereby granted to use or copy this program
 * for any purpose, provided the above notices are retained on all copies.
 * Permission to modify the code and to distribute modified code is granted,
 * provided the above notices are retained, and a notice that the code was
 * modified is included with the above copyright notice.
 *
 * @category  Wp
 * @package   Punction
 * @author    Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license   MIT http://opensource.org/licenses/MIT
 * @link      http://
 * @since     File available since Release 1.0.0
 * PHP Version 5
 */
if (! defined('ABSPATH')) {
    define('WP_USE_THEMES', false);
    require (__DIR__ . '/../../wp/wp-load.php');
}
// require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../../config/bootstrap.php";
use Doctrine\ORM\Query\ResultSetMapping;

$pacjent2Excel = new Pacjent2Excel();
$pacjent2Excel->main();

/**
 * Pacjent2Excel
 *
 * @category  Wp
 * @package   Punction
 * @author    Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license   MIT http://opensource.org/licenses/MIT
 * @version   1.0 $Id: 5fa39cb8382fc4d44afb012d41750f9499ccc82b $ $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 *       
 */
class Pacjent2Excel
{

    /**
     *
     * @var PHPExcel
     */
    public $objPHPExcel;

    /**
     *
     * @var array id 2 name
     */
    public $oddzialy_id2name;

    /**
     * Contructor
     */
    public function __construct()
    {
        $this->objPHPExcel = new PHPExcel();
        $this->oddzialy_id2name = Pacjent2Excel::loadOddzialy();
    }

    /**
     * main function
     */
    public function main()
    {
        $this->sheet(0, "miesiąc");
        $this->stats("month");
        $this->column_autowidths();
        $this->sheet(1, "dzień");
        $this->stats("date");
        $this->column_autowidths();
        $this->sheet(2, "pacjent");
        $this->patients();
        $this->column_autowidths();
        $this->write_excel();
    }

    /**
     * @return multitype:NULL
     */
    public static function loadOddzialy()
    {
        $oddzialy_id2name = array();
        $params = array(
            'limit' => - 1
        );
        
        $oddzialy = new Pod('oddzial', $params);
        while ($oddzialy->fetch()) {
            $oddzialy_id2name[$oddzialy->field('ID')] = $oddzialy->field('title');
        }
        return $oddzialy_id2name;
    }

    /**
     * excel autow
     */
    function column_autowidths()
    {
        foreach (range('A', 'N') as $columnID) {
            $this->objPHPExcel->getActiveSheet()
                ->getColumnDimension($columnID)
                ->setAutoSize(true);
        }
    }

    /**
     * add sheet
     * 
     * @param $index id index
     * @param $title string title
     */
    function sheet($index, $title)
    {
        $this->objPHPExcel->createSheet(NULL, $index);
        $this->objPHPExcel->setActiveSheetIndex($index);
        $this->objPHPExcel->getActiveSheet()->setTitle($title);
    }

    /**
     * fill patients
     */
    function patients()
    {
        global $entityManager;
        $patientRepository = $entityManager->getRepository('Patient');
        $patients = $patientRepository->findAll();
        $rowCount = 1;
        foreach ($patients as $patient) {
            $this->objPHPExcel->getActiveSheet()->setCellValue("A" . $rowCount, $patient->getName());
            $this->objPHPExcel->getActiveSheet()->setCellValue("B" . $rowCount, $patient->getDataKategoryzacji()
                ->format("Y-m-d"));
            $this->objPHPExcel->getActiveSheet()->setCellValue("C" . $rowCount, $patient->getPesel());
            $this->objPHPExcel->getActiveSheet()->setCellValue("D" . $rowCount, $patient->getKategoriaPacjenta());
            $this->objPHPExcel->getActiveSheet()->setCellValue("E" . $rowCount, $patient->getAktywnoscFizyczna());
            $this->objPHPExcel->getActiveSheet()->setCellValue("F" . $rowCount, $patient->getHigiena());
            $this->objPHPExcel->getActiveSheet()->setCellValue("G" . $rowCount, $this->oddzialy_id2name[$patient->getOddzialId()]);
            $rowCount ++;
        }
    }

    /**
     *
     * @param string $period            
     */
    function stats($period = "date")
    {
        global $entityManager;
        $sql = "SELECT count(*) as count1, p.kategoriaPacjenta, ${period}(p.dataKategoryzacji) as dataKategoryzacji, p.oddzialId FROM Patient p GROUP BY p.kategoriaPacjenta,${period}(p.dataKategoryzacji),p.oddzialId ORDER BY 4,3";
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('count1', 'count1');
        $rsm->addScalarResult('kategoriaPacjenta', 'kategoriaPacjenta');
        $rsm->addScalarResult('dataKategoryzacji', 'dataKategoryzacji');
        $rsm->addScalarResult('oddzialId', 'oddzialId');
        $query = $entityManager->createNativeQuery($sql, $rsm);
        $users = $query->getResult();
        
        $i = 1;
        $prev_oddz = "";
        $prev_data = "";
        $col = array(
            1 => 'C',
            2 => 'D',
            3 => 'E',
            0 => 'F'
        );
        foreach ($users as $user) {
            $kat = $user['kategoriaPacjenta'];
            $count = $user['count1'];
            $data = $user['dataKategoryzacji'];
            $oddz = $user['oddzialId'];
            if ($oddz != $prev_oddz) {
                $this->objPHPExcel->getActiveSheet()->setCellValue("A${i}", $this->oddzialy_id2name[$oddz]);
            }
            if ($prev_data != $data) {
                $this->objPHPExcel->getActiveSheet()->setCellValue("B${i}", $data);
                $i ++;
            }
            $column = $col[$kat];
            $this->objPHPExcel->getActiveSheet()->setCellValue("${column}${i}", $count);
            $prev_oddz = $oddz;
            $prev_data = $data;
        }
    }

    /**
     * write file
     */
    function write_excel()
    {
        $this->objPHPExcel->getProperties()
            ->setCreator("user")
            ->setLastModifiedBy("user")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="output.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }
}